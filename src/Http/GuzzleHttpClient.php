<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Http;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface as GuzzleClientInterface;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\GuzzleException;
use InvalidArgumentException;
use JsonException;
use miralsoft\synaxon\api\Config\SynaxonConfig;
use miralsoft\synaxon\api\Exception\AuthenticationException;
use miralsoft\synaxon\api\Exception\NotFoundException;
use miralsoft\synaxon\api\Exception\RateLimitException;
use miralsoft\synaxon\api\Exception\ServerException;
use miralsoft\synaxon\api\Exception\SynaxonApiException;
use miralsoft\synaxon\api\Exception\TransportException;
use miralsoft\synaxon\api\Exception\ValidationException;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Throwable;

/**
 * Guzzle-based HttpClient implementation.
 *
 * Responsibilities:
 *  - Add Authorization header from configured credentials.
 *  - Enforce TLS verification and sensible timeouts.
 *  - Map HTTP status codes to typed exceptions.
 *  - Retry transient failures (429/5xx/connect errors) with exponential backoff + jitter.
 *  - Log request metadata via PSR-3, with sensitive headers redacted.
 */
final class GuzzleHttpClient implements HttpClientInterface
{
    /** @var list<string> */
    private const REDACTED_HEADERS = ['authorization', 'cookie', 'x-api-key', 'x-api-token'];

    /**
     * Headers a caller is never allowed to override via the request options.
     * Anything matching here (case-insensitive) is silently dropped from the
     * caller-supplied $options['headers'] before being merged with the
     * library-managed defaults.
     */
    private const RESERVED_HEADERS = ['authorization', 'host'];

    /**
     * Hard upper bound on a single backoff sleep, in seconds. Protects
     * against pathological Retry-After values from the server and keeps
     * exponential backoff from blowing the call wallclock at high attempt
     * counts.
     */
    private const MAX_BACKOFF_SECONDS = 30;

    /**
     * Maximum number of bytes from a non-decoded error body to retain in the
     * exception context. Prevents an oversized 5xx HTML page from balloning
     * the in-memory exception payload (and any logger that serialises it).
     */
    private const MAX_ERROR_BODY_BYTES = 4096;

    private readonly GuzzleClientInterface $client;

    private readonly LoggerInterface $logger;

    public function __construct(
        private readonly SynaxonConfig $config,
        ?GuzzleClientInterface $client = null,
        ?LoggerInterface $logger = null,
    ) {
        $this->client = $client ?? new Client([
            'base_uri'        => $config->getBaseUri() . '/',
            'timeout'         => $config->getTimeout(),
            'connect_timeout' => $config->getConnectTimeout(),
            'http_errors'     => false,
            'verify'          => true,
        ]);
        $this->logger = $logger ?? new NullLogger();
    }

    public function request(string $method, string $path, array $options = []): array|null
    {
        $method = strtoupper($method);
        $headers = $this->defaultHeaders();

        if (isset($options['headers']) && is_array($options['headers'])) {
            /** @var array<string, string> $extra */
            $extra = $options['headers'];
            // Strip any caller-supplied header that would override our
            // managed defaults (Authorization, Host). The library owns
            // authentication — a resource method must never be able to
            // smuggle a different credential through.
            foreach ($extra as $name => $value) {
                if (in_array(strtolower((string) $name), self::RESERVED_HEADERS, true)) {
                    continue;
                }
                $headers[$name] = $value;
            }
        }

        $requestOptions = ['headers' => $headers];

        if (isset($options['query']) && is_array($options['query']) && $options['query'] !== []) {
            $requestOptions['query'] = $options['query'];
        }

        if (array_key_exists('body', $options) && $options['body'] !== null) {
            $requestOptions['json'] = $options['body'];
        }

        $uri = ltrim($path, '/');

        $attempt = 0;
        $maxAttempts = $this->config->getMaxRetries() + 1;

        while (true) {
            $attempt++;
            try {
                $response = $this->client->request($method, $uri, $requestOptions);
            } catch (ConnectException $e) {
                $this->logAttempt($method, $uri, $attempt, null, $e);
                if ($attempt >= $maxAttempts) {
                    throw new TransportException(
                        'HTTP connection failed: ' . $e->getMessage(),
                        0,
                        $e
                    );
                }
                $this->sleepBackoff($attempt);
                continue;
            } catch (GuzzleException $e) {
                $this->logAttempt($method, $uri, $attempt, null, $e);
                throw new TransportException(
                    'HTTP request failed: ' . $e->getMessage(),
                    0,
                    $e
                );
            }

            $status = $response->getStatusCode();
            $this->logAttempt($method, $uri, $attempt, $status);

            if ($status >= 200 && $status < 300) {
                return $this->decodeBody($response);
            }

            if ($this->isRetryable($status) && $attempt < $maxAttempts) {
                $this->sleepBackoff($attempt, $response);
                continue;
            }

            throw $this->mapError($response, $method, $uri);
        }
    }

    /**
     * @return array<string, string>
     */
    private function defaultHeaders(): array
    {
        $headers = [
            'Accept'     => 'application/json',
            'User-Agent' => $this->config->getUserAgent(),
        ];

        $bearer = $this->config->getBearerToken();
        $user = $this->config->getBasicUser();
        $pass = $this->config->getBasicPass();

        if ($bearer !== null && $bearer !== '') {
            $headers['Authorization'] = 'Bearer ' . $bearer;
        } elseif ($user !== null && $pass !== null) {
            $headers['Authorization'] = 'Basic ' . base64_encode($user . ':' . $pass);
        } else {
            throw new InvalidArgumentException(
                'SynaxonConfig has no credentials: set bearerToken or basicUser/basicPass.'
            );
        }

        return $headers;
    }

    /**
     * @return array<string, mixed>|list<mixed>|null
     */
    private function decodeBody(ResponseInterface $response): array|null
    {
        $body = (string) $response->getBody();
        if ($body === '') {
            return null;
        }

        // Content-Type-based fallback: for binary / textual non-JSON payloads
        // (CSV exports, PDF documents, etc.) we wrap the raw body into an
        // array so the resource methods keep returning array|null. Callers
        // that expect binary output can access $result['_raw'] and
        // $result['_contentType'].
        $contentType = strtolower(trim(explode(';', $response->getHeaderLine('Content-Type'))[0] ?? ''));
        if ($contentType !== '' && !str_contains($contentType, 'json')) {
            return [
                '_raw'         => $body,
                '_contentType' => $contentType,
            ];
        }

        try {
            $decoded = json_decode($body, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            throw new SynaxonApiException('Invalid JSON response: ' . $e->getMessage(), 0, $e);
        }

        if ($decoded === null) {
            return null;
        }

        if (is_array($decoded)) {
            /** @var array<string, mixed>|list<mixed> $decoded */
            return $decoded;
        }

        // JSON scalar (bool, int, float, string) at the root — wrap it so
        // the resource method contract stays array-shaped. Consumers can
        // read $result['value'].
        return ['value' => $decoded];
    }

    private function isRetryable(int $status): bool
    {
        if ($status === 429) {
            return true;
        }

        return $status >= 500 && $status < 600;
    }

    private function sleepBackoff(int $attempt, ?ResponseInterface $response = null): void
    {
        if ($response !== null && $response->getStatusCode() === 429) {
            $retryAfter = $response->getHeaderLine('Retry-After');
            if ($retryAfter !== '' && is_numeric($retryAfter)) {
                $seconds = max(0.0, min((float) $retryAfter, (float) self::MAX_BACKOFF_SECONDS));
                usleep((int) ($seconds * 1_000_000));

                return;
            }
        }

        // Exponential backoff with jitter, capped to MAX_BACKOFF_SECONDS so
        // the call cannot block indefinitely if maxRetries is set high.
        $baseMs   = 200 * (2 ** min($attempt - 1, 10));
        $jitterMs = random_int(0, 100);
        $totalMs  = min($baseMs + $jitterMs, self::MAX_BACKOFF_SECONDS * 1000);
        usleep($totalMs * 1000);
    }

    private function mapError(ResponseInterface $response, string $method, string $uri): SynaxonApiException
    {
        $status = $response->getStatusCode();
        $body   = (string) $response->getBody();
        $decoded = [];

        if ($body !== '') {
            try {
                /** @var mixed $parsed */
                $parsed = json_decode($body, true, 512, JSON_THROW_ON_ERROR);
                if (is_array($parsed)) {
                    /** @var array<string, mixed> $decoded */
                    $decoded = $parsed;
                }
            } catch (JsonException) {
                // ignore, truncated body will be in context as raw string below
            }
        }

        $message = sprintf('%s %s failed with HTTP %d', $method, $uri, $status);
        if (isset($decoded['message']) && is_string($decoded['message'])) {
            $message .= ': ' . $decoded['message'];
        }

        // Truncate raw body before stowing it in the exception context to
        // avoid attaching a multi-megabyte 5xx HTML page to every error.
        $bodyForContext = $decoded !== [] ? $decoded : self::truncateBody($body);

        $context = [
            'method'    => $method,
            'uri'       => $uri,
            'status'    => $status,
            'body'      => $bodyForContext,
        ];

        return match (true) {
            $status === 401 || $status === 403 => new AuthenticationException($message, $status, null, $context),
            $status === 404                    => new NotFoundException($message, $status, null, $context),
            $status === 429                    => new RateLimitException($message, $status, null, array_merge($context, [
                'retry_after' => (int) $response->getHeaderLine('Retry-After'),
            ])),
            $status === 400 || $status === 422 => new ValidationException($message, $status, null, array_merge($context, [
                'errors' => $decoded['errors'] ?? $decoded['error'] ?? [],
            ])),
            $status >= 500 && $status < 600    => new ServerException($message, $status, null, $context),
            default                            => new SynaxonApiException($message, $status, null, $context),
        };
    }

    private static function truncateBody(string $body): string
    {
        if (strlen($body) <= self::MAX_ERROR_BODY_BYTES) {
            return $body;
        }
        return substr($body, 0, self::MAX_ERROR_BODY_BYTES) . '... [truncated]';
    }

    private function logAttempt(
        string $method,
        string $uri,
        int $attempt,
        ?int $status,
        ?Throwable $error = null,
    ): void {
        $this->logger->debug('synaxon.request', [
            'method'  => $method,
            'uri'     => $uri,
            'attempt' => $attempt,
            'status'  => $status,
            'error'   => $error?->getMessage(),
        ]);
    }

    /**
     * Redact sensitive headers (Authorization, Cookie, X-API-*) for any
     * caller that wants to surface request headers in their own logs
     * without leaking credentials.
     *
     * @param array<string, string> $headers
     * @return array<string, string>
     */
    public static function redactHeaders(array $headers): array
    {
        $out = [];
        foreach ($headers as $name => $value) {
            $out[$name] = in_array(strtolower($name), self::REDACTED_HEADERS, true) ? '***' : $value;
        }

        return $out;
    }
}
