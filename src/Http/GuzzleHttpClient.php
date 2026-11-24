<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Http;

use DateTimeImmutable;
use DateTimeZone;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface as GuzzleClientInterface;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Query;
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
use Psr\Http\Message\StreamInterface;
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
 *  - Retry transient failures with exponential backoff + jitter: 429 for every
 *    method (the server refused the request, so nothing was processed), 5xx and
 *    connection errors only for idempotent methods, because a POST or PATCH that
 *    timed out or failed upstream may already have taken effect.
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

    /** Request body encodings, chosen per operation from its declared content type. */
    public const BODY_JSON = 'json';

    public const BODY_FORM = 'form';

    public const BODY_MULTIPART = 'multipart';

    /**
     * Methods that may be repeated after a 5xx or a connection error without
     * risking a second side effect (RFC 9110, section 9.2.2). POST and PATCH are
     * deliberately absent: repeating them could create a duplicate record.
     */
    private const IDEMPOTENT_METHODS = ['GET', 'HEAD', 'OPTIONS', 'PUT', 'DELETE'];

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
            'base_uri' => $config->getBaseUri() . '/',
            'timeout' => $config->getTimeout(),
            'connect_timeout' => $config->getConnectTimeout(),
            'http_errors' => false,
            'verify' => true,
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
            // authentication; a resource method must never be able to
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
            $requestOptions['query'] = self::buildQuery($options['query']);
        }

        if (array_key_exists('body', $options) && $options['body'] !== null) {
            $requestOptions += self::bodyOptions($options['body'], $options['bodyFormat'] ?? self::BODY_JSON);
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
                if ($attempt >= $maxAttempts || !$this->isIdempotent($method)) {
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
                // Guzzle's interface declares only GuzzleException, but PSR-7
                // throws this while building the request, so the catch is not
                // dead (see testInvalidHeaderValueDoesNotLeakIntoException).
                // @phpstan-ignore catch.neverThrown
            } catch (\InvalidArgumentException $e) {
                // PSR-7 rejects an invalid header or URI with a message that
                // quotes the offending value, which can be the Authorization
                // header. Neither the message nor the exception is passed on.
                throw new TransportException(sprintf(
                    'HTTP request could not be built for %s %s: an option, header or URI value is invalid',
                    $method,
                    $uri
                ));
            }

            $status = $response->getStatusCode();
            $this->logAttempt($method, $uri, $attempt, $status);

            if ($status >= 200 && $status < 300) {
                return $this->decodeBody($response);
            }

            if ($this->isRetryable($status, $method) && $attempt < $maxAttempts) {
                $this->sleepBackoff($attempt, $response);
                continue;
            }

            throw $this->mapError($response, $method, $uri);
        }
    }

    /**
     * Encode query parameters the way the OpenAPI document declares them:
     * form style with explode, so a list becomes repeated keys
     * (`status=a&status=b`), and booleans become `true` / `false` rather than
     * PHP's `1` / `0`, which a server may read as truthy strings.
     *
     * @param array<array-key, mixed> $query
     */
    private static function buildQuery(array $query): string
    {
        $normalised = [];
        foreach ($query as $key => $value) {
            if ($value === null) {
                continue;
            }
            $normalised[(string) $key] = is_array($value)
                ? array_values(array_map(self::queryScalar(...), $value))
                : self::queryScalar($value);
        }

        return Query::build($normalised, PHP_QUERY_RFC3986);
    }

    private static function queryScalar(mixed $value): string
    {
        if (is_bool($value)) {
            return $value ? 'true' : 'false';
        }
        if (is_scalar($value) || $value instanceof \Stringable) {
            return (string) $value;
        }

        throw new InvalidArgumentException(sprintf(
            'Query values must be scalars or lists of scalars, %s given',
            get_debug_type($value)
        ));
    }

    /**
     * Guzzle request options for a body in the format the operation declares.
     *
     * @param array<array-key, mixed> $body
     *
     * @return array<string, mixed>
     */
    private static function bodyOptions(array $body, string $format): array
    {
        return match ($format) {
            // An empty PHP array would encode as `[]`; every JSON request body
            // in the API is an object, so it is sent as `{}`.
            self::BODY_JSON => ['json' => $body === [] ? new \stdClass() : $body],
            self::BODY_FORM => ['form_params' => $body],
            self::BODY_MULTIPART => ['multipart' => self::multipartParts($body)],
            default => throw new InvalidArgumentException(sprintf('Unknown bodyFormat "%s"', $format)),
        };
    }

    /**
     * Each field becomes one part. A field can be a scalar, a stream or
     * resource (a file), or an array with `contents` and optional
     * `filename` / `headers`, as Guzzle's multipart option expects.
     *
     * @param array<array-key, mixed> $body
     *
     * @return list<array<string, mixed>>
     */
    private static function multipartParts(array $body): array
    {
        $parts = [];
        foreach ($body as $name => $value) {
            if (is_array($value) && array_key_exists('contents', $value)) {
                $parts[] = ['name' => (string) $name] + $value;
                continue;
            }
            if (is_resource($value) || $value instanceof StreamInterface) {
                $parts[] = ['name' => (string) $name, 'contents' => $value];
                continue;
            }
            $parts[] = ['name' => (string) $name, 'contents' => self::queryScalar($value)];
        }

        return $parts;
    }

    /**
     * @return array<string, string>
     */
    private function defaultHeaders(): array
    {
        $headers = [
            'Accept' => 'application/json',
            'User-Agent' => $this->config->getUserAgent(),
        ];

        $language = $this->config->getAcceptLanguage();
        if ($language !== null) {
            $headers['Accept-Language'] = $language;
        }

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
                '_raw' => $body,
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

        // JSON scalar (bool, int, float, string) at the root: wrap it so
        // the resource method contract stays array-shaped. Consumers can
        // read $result['value'].
        return ['value' => $decoded];
    }

    private function isRetryable(int $status, string $method): bool
    {
        if ($status === 429) {
            return true;
        }

        return $status >= 500 && $status < 600 && $this->isIdempotent($method);
    }

    private function isIdempotent(string $method): bool
    {
        return in_array($method, self::IDEMPOTENT_METHODS, true);
    }

    private function sleepBackoff(int $attempt, ?ResponseInterface $response = null): void
    {
        if ($response !== null && $response->getStatusCode() === 429) {
            $retryAfter = self::parseRetryAfter($response);
            if ($retryAfter !== null) {
                $seconds = (float) min($retryAfter, self::MAX_BACKOFF_SECONDS);
                usleep((int) ($seconds * 1_000_000));

                return;
            }
        }

        // Exponential backoff with jitter, capped to MAX_BACKOFF_SECONDS so
        // the call cannot block indefinitely if maxRetries is set high.
        $baseMs = 200 * (2 ** min($attempt - 1, 10));
        $jitterMs = random_int(0, 100);
        $totalMs = min($baseMs + $jitterMs, self::MAX_BACKOFF_SECONDS * 1000);
        usleep($totalMs * 1000);
    }

    private function mapError(ResponseInterface $response, string $method, string $uri): SynaxonApiException
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
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
            'method' => $method,
            'uri' => $uri,
            'status' => $status,
            'body' => $bodyForContext,
            'correlation_id' => self::extractCorrelationId($response, $decoded),
        ];

        return match (true) {
            $status === 401 || $status === 403 => new AuthenticationException($message, $status, null, $context),
            $status === 404 => new NotFoundException($message, $status, null, $context),
            $status === 429 => new RateLimitException($message, $status, null, array_merge($context, [
                'retry_after' => self::parseRetryAfter($response),
            ])),
            $status === 400 || $status === 422 => new ValidationException($message, $status, null, array_merge($context, [
                'errors' => $decoded['errors'] ?? $decoded['error'] ?? [],
            ])),
            $status >= 500 && $status < 600 => new ServerException($message, $status, null, $context),
            default => new SynaxonApiException($message, $status, null, $context),
        };
    }

    /**
     * Retry-After as whole seconds from now (RFC 9110, section 10.2.3): either
     * delay-seconds or an HTTP-date. Null when the header is absent or
     * unreadable, so a caller can tell "no advice" apart from "retry now".
     */
    private static function parseRetryAfter(ResponseInterface $response): ?int
    {
        $value = trim($response->getHeaderLine('Retry-After'));
        if ($value === '') {
            return null;
        }
        if (ctype_digit($value)) {
            return (int) $value;
        }
        $date = DateTimeImmutable::createFromFormat(DATE_RFC7231, $value, new DateTimeZone('GMT'));
        if ($date === false) {
            return null;
        }

        return max(0, $date->getTimestamp() - time());
    }

    private static function truncateBody(string $body): string
    {
        if (strlen($body) <= self::MAX_ERROR_BODY_BYTES) {
            return $body;
        }
        return substr($body, 0, self::MAX_ERROR_BODY_BYTES) . '... [truncated]';
    }

    /**
     * Extract Synaxon's correlation ID from an error response. Synaxon sends
     * it both as a "correlationId" field in the JSON body and (sometimes)
     * as an "X-Correlation-Id" header. We probe both.
     *
     * @param array<string, mixed> $decoded
     */
    private static function extractCorrelationId(ResponseInterface $response, array $decoded): ?string
    {
        $fromBody = $decoded['correlationId'] ?? null;
        if (is_string($fromBody) && $fromBody !== '') {
            return $fromBody;
        }
        foreach (['X-Correlation-Id', 'X-Request-Id'] as $headerName) {
            $value = $response->getHeaderLine($headerName);
            if ($value !== '') {
                return $value;
            }
        }
        return null;
    }

    private function logAttempt(
        string $method,
        string $uri,
        int $attempt,
        ?int $status,
        ?Throwable $error = null,
    ): void {
        $context = [
            'method' => $method,
            'uri' => $uri,
            'attempt' => $attempt,
            'status' => $status,
            'error' => $error?->getMessage(),
        ];

        // Authentication and authorization failures are security-relevant
        // events and are logged above debug level. The context never carries
        // a credential: headers are not part of it.
        if ($status === 401 || $status === 403) {
            $this->logger->warning('synaxon.request.unauthorized', $context);

            return;
        }

        $this->logger->debug('synaxon.request', $context);
    }

    /**
     * Redact sensitive headers (Authorization, Cookie, X-API-*) for any
     * caller that wants to surface request headers in their own logs
     * without leaking credentials.
     *
     * @param array<string, string> $headers
     *
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
