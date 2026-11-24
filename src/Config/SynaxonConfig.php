<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Config;

use InvalidArgumentException;
use miralsoft\synaxon\api\Version;

/**
 * Immutable configuration for the SYNAXON Marketplace API client.
 *
 * The configuration carries network, retry, and authentication settings.
 * It is intentionally immutable so it can be shared safely between
 * multiple clients without coordination.
 *
 * Authentication may be supplied either as a bearer token or as HTTP basic
 * credentials. Authentication is not required at construction time, but a
 * request that needs authentication will fail with an InvalidArgumentException
 * if neither is configured.
 */
final class SynaxonConfig
{
    public const DEFAULT_BASE_URI = 'https://api.synaxon.com/marketplace';

    /** Derived from Version::VERSION so the two cannot drift apart. */
    public const DEFAULT_USER_AGENT = 'miralsoft-synaxon-api/' . Version::VERSION;

    /** Upper bound for any timeout to prevent accidental indefinite hangs. */
    public const MAX_TIMEOUT_SECONDS = 600;

    /** Upper bound for retry count; exponential backoff blows up beyond this. */
    public const MAX_RETRIES = 10;

    /**
     * @param string|null $bearerToken HTTP bearer token (mutually exclusive with basic credentials).
     * @param string|null $basicUser HTTP basic auth user.
     * @param string|null $basicPass HTTP basic auth password.
     * @param string $baseUri Base URI of the API. https, or http for a loopback host; no
     *                        user info, query or fragment.
     * @param int $timeout Request timeout in seconds (1..600).
     * @param int $connectTimeout Connection timeout in seconds (1..600).
     * @param int $maxRetries Number of retries on 429/5xx (0..10).
     * @param string $userAgent User agent string sent with each request.
     */
    public function __construct(
        #[\SensitiveParameter]
        private readonly ?string $bearerToken = null,
        #[\SensitiveParameter]
        private readonly ?string $basicUser = null,
        #[\SensitiveParameter]
        private readonly ?string $basicPass = null,
        private readonly string $baseUri = self::DEFAULT_BASE_URI,
        private readonly int $timeout = 30,
        private readonly int $connectTimeout = 10,
        private readonly int $maxRetries = 3,
        private readonly string $userAgent = self::DEFAULT_USER_AGENT,
    ) {
        if ($this->timeout < 1 || $this->timeout > self::MAX_TIMEOUT_SECONDS) {
            throw new InvalidArgumentException(sprintf(
                'timeout must be between 1 and %d seconds',
                self::MAX_TIMEOUT_SECONDS
            ));
        }
        if ($this->connectTimeout < 1 || $this->connectTimeout > self::MAX_TIMEOUT_SECONDS) {
            throw new InvalidArgumentException(sprintf(
                'connectTimeout must be between 1 and %d seconds',
                self::MAX_TIMEOUT_SECONDS
            ));
        }
        if ($this->maxRetries < 0 || $this->maxRetries > self::MAX_RETRIES) {
            throw new InvalidArgumentException(sprintf(
                'maxRetries must be between 0 and %d',
                self::MAX_RETRIES
            ));
        }
        if ($this->baseUri === '') {
            throw new InvalidArgumentException('baseUri must not be empty');
        }
        if (filter_var($this->baseUri, FILTER_VALIDATE_URL) === false) {
            throw new InvalidArgumentException('baseUri must be a valid URL');
        }
        $scheme = strtolower((string) parse_url($this->baseUri, PHP_URL_SCHEME));
        if ($scheme !== 'http' && $scheme !== 'https') {
            throw new InvalidArgumentException('baseUri must use http or https scheme');
        }
        // Every request carries the credential in the Authorization header,
        // so plain http would send it readable over the network. It is only
        // accepted for a loopback host, for local mocks and proxies.
        if ($scheme === 'http' && !self::isLoopbackHost((string) parse_url($this->baseUri, PHP_URL_HOST))) {
            throw new InvalidArgumentException(
                'baseUri must use https; plain http is only accepted for localhost, 127.0.0.1 and [::1]'
            );
        }
        // Credentials belong in the Authorization header, never in the URI,
        // where they would end up in logs and __debugInfo(). A query or
        // fragment would be dropped silently when paths are resolved.
        foreach ([PHP_URL_USER => 'user info', PHP_URL_QUERY => 'a query string', PHP_URL_FRAGMENT => 'a fragment'] as $part => $label) {
            if (parse_url($this->baseUri, $part) !== null) {
                throw new InvalidArgumentException(sprintf('baseUri must not contain %s', $label));
            }
        }
        foreach (['bearerToken' => $this->bearerToken, 'basicUser' => $this->basicUser, 'basicPass' => $this->basicPass] as $name => $value) {
            if ($value === '') {
                throw new InvalidArgumentException(sprintf(
                    '%s must not be an empty string; pass null to leave it unset',
                    $name
                ));
            }
            // A trailing newline from a secrets file would make the HTTP layer
            // reject the header with the full value in its message. Refuse it
            // here, where the message names the field and not the value.
            if ($value !== null && preg_match('/[\x00-\x1F\x7F]/', $value) === 1) {
                throw new InvalidArgumentException(sprintf('%s must not contain control characters', $name));
            }
        }
        if (preg_match('/[\x00-\x1F\x7F]/', $this->userAgent) === 1) {
            throw new InvalidArgumentException('userAgent must not contain control characters');
        }
        if ($this->bearerToken !== null && $this->basicUser !== null) {
            throw new InvalidArgumentException('Set either bearerToken or basicUser/basicPass, not both');
        }
        if ($this->basicUser !== null && $this->basicPass === null) {
            throw new InvalidArgumentException('basicPass is required when basicUser is set');
        }
        if ($this->basicPass !== null && $this->basicUser === null) {
            throw new InvalidArgumentException('basicUser is required when basicPass is set');
        }
    }

    /**
     * Build a configuration from environment variables.
     *
     * Recognised variables:
     *  - SYNAXON_BEARER_TOKEN
     *  - SYNAXON_BASIC_USER
     *  - SYNAXON_BASIC_PASS
     *  - SYNAXON_BASE_URI
     *  - SYNAXON_TIMEOUT
     *  - SYNAXON_CONNECT_TIMEOUT
     *  - SYNAXON_MAX_RETRIES
     *  - SYNAXON_USER_AGENT
     *
     * When SYNAXON_BEARER_TOKEN is set, the basic variables are ignored.
     */
    public static function fromEnv(): self
    {
        $bearer = self::envString('SYNAXON_BEARER_TOKEN');

        return new self(
            bearerToken:    $bearer,
            basicUser:      $bearer === null ? self::envString('SYNAXON_BASIC_USER') : null,
            basicPass:      $bearer === null ? self::envString('SYNAXON_BASIC_PASS') : null,
            baseUri:        self::envString('SYNAXON_BASE_URI') ?? self::DEFAULT_BASE_URI,
            timeout:        self::envInt('SYNAXON_TIMEOUT', 30),
            connectTimeout: self::envInt('SYNAXON_CONNECT_TIMEOUT', 10),
            maxRetries:     self::envInt('SYNAXON_MAX_RETRIES', 3),
            userAgent:      self::envString('SYNAXON_USER_AGENT') ?? self::DEFAULT_USER_AGENT,
        );
    }

    /**
     * Build a configuration from an associative array.
     *
     * @param array<string, mixed> $cfg
     */
    public static function fromArray(array $cfg): self
    {
        return new self(
            bearerToken:    self::cfgString($cfg, 'bearerToken'),
            basicUser:      self::cfgString($cfg, 'basicUser'),
            basicPass:      self::cfgString($cfg, 'basicPass'),
            baseUri:        self::cfgString($cfg, 'baseUri') ?? self::DEFAULT_BASE_URI,
            timeout:        self::cfgInt($cfg, 'timeout', 30),
            connectTimeout: self::cfgInt($cfg, 'connectTimeout', 10),
            maxRetries:     self::cfgInt($cfg, 'maxRetries', 3),
            userAgent:      self::cfgString($cfg, 'userAgent') ?? self::DEFAULT_USER_AGENT,
        );
    }

    /**
     * @param array<string, mixed> $cfg
     */
    private static function cfgString(array $cfg, string $key): ?string
    {
        if (!isset($cfg[$key])) {
            return null;
        }
        $v = $cfg[$key];
        if (!is_string($v) && !is_int($v) && !is_float($v)) {
            return null;
        }
        $s = (string) $v;
        return $s === '' ? null : $s;
    }

    /**
     * @param array<string, mixed> $cfg
     */
    private static function cfgInt(array $cfg, string $key, int $default): int
    {
        if (!isset($cfg[$key]) || !is_numeric($cfg[$key])) {
            return $default;
        }
        return (int) $cfg[$key];
    }

    public function getBearerToken(): ?string
    {
        return $this->bearerToken;
    }

    public function getBasicUser(): ?string
    {
        return $this->basicUser;
    }

    public function getBasicPass(): ?string
    {
        return $this->basicPass;
    }

    public function getBaseUri(): string
    {
        return rtrim($this->baseUri, '/');
    }

    public function getTimeout(): int
    {
        return $this->timeout;
    }

    public function getConnectTimeout(): int
    {
        return $this->connectTimeout;
    }

    public function getMaxRetries(): int
    {
        return $this->maxRetries;
    }

    public function getUserAgent(): string
    {
        return $this->userAgent;
    }

    public function hasAuth(): bool
    {
        return $this->bearerToken !== null || ($this->basicUser !== null && $this->basicPass !== null);
    }

    /**
     * Mask credentials when serialised for diagnostics or logs.
     *
     * @return array{baseUri:string,auth:string,timeout:int,connectTimeout:int,maxRetries:int,userAgent:string}
     */
    public function __debugInfo(): array
    {
        $auth = 'none';
        if ($this->bearerToken !== null) {
            $auth = 'bearer:***';
        } elseif ($this->basicUser !== null) {
            // Never expose the basic user: in an OAuth2 client-credentials
            // setup the user IS half of the secret. Both halves stay masked.
            $auth = 'basic:***';
        }

        return [
            'baseUri' => $this->getBaseUri(),
            'auth' => $auth,
            'timeout' => $this->timeout,
            'connectTimeout' => $this->connectTimeout,
            'maxRetries' => $this->maxRetries,
            'userAgent' => $this->userAgent,
        ];
    }

    private static function isLoopbackHost(string $host): bool
    {
        return in_array(strtolower(trim($host, '[]')), ['localhost', '127.0.0.1', '::1'], true);
    }

    private static function envString(string $key): ?string
    {
        $raw = getenv($key);
        if ($raw === false || $raw === '') {
            return null;
        }

        return $raw;
    }

    private static function envInt(string $key, int $default): int
    {
        $raw = getenv($key);
        if ($raw === false || $raw === '' || !is_numeric($raw)) {
            return $default;
        }

        return (int) $raw;
    }
}
