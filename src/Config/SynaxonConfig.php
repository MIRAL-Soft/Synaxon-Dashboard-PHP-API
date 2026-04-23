<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Config;

use InvalidArgumentException;

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

    public const DEFAULT_USER_AGENT = 'miralsoft-synaxon-api/1.0';

    /**
     * @param string|null $bearerToken HTTP bearer token (mutually exclusive with basic credentials).
     * @param string|null $basicUser HTTP basic auth user.
     * @param string|null $basicPass HTTP basic auth password.
     * @param string $baseUri Base URI of the API, without trailing slash.
     * @param int $timeout Request timeout in seconds (>= 1).
     * @param int $connectTimeout Connection timeout in seconds (>= 1).
     * @param int $maxRetries Number of retries on 429/5xx (>= 0).
     * @param string $userAgent User agent string sent with each request.
     */
    public function __construct(
        private readonly ?string $bearerToken = null,
        private readonly ?string $basicUser = null,
        private readonly ?string $basicPass = null,
        private readonly string $baseUri = self::DEFAULT_BASE_URI,
        private readonly int $timeout = 30,
        private readonly int $connectTimeout = 10,
        private readonly int $maxRetries = 3,
        private readonly string $userAgent = self::DEFAULT_USER_AGENT,
    ) {
        if ($this->timeout < 1) {
            throw new InvalidArgumentException('timeout must be >= 1 second');
        }
        if ($this->connectTimeout < 1) {
            throw new InvalidArgumentException('connectTimeout must be >= 1 second');
        }
        if ($this->maxRetries < 0) {
            throw new InvalidArgumentException('maxRetries must be >= 0');
        }
        if ($this->baseUri === '') {
            throw new InvalidArgumentException('baseUri must not be empty');
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
     */
    public static function fromEnv(): self
    {
        return new self(
            bearerToken:    self::envString('SYNAXON_BEARER_TOKEN'),
            basicUser:      self::envString('SYNAXON_BASIC_USER'),
            basicPass:      self::envString('SYNAXON_BASIC_PASS'),
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
            bearerToken:    isset($cfg['bearerToken'])    ? (string) $cfg['bearerToken']    : null,
            basicUser:      isset($cfg['basicUser'])      ? (string) $cfg['basicUser']      : null,
            basicPass:      isset($cfg['basicPass'])      ? (string) $cfg['basicPass']      : null,
            baseUri:        isset($cfg['baseUri'])        ? (string) $cfg['baseUri']        : self::DEFAULT_BASE_URI,
            timeout:        isset($cfg['timeout'])        ? (int)    $cfg['timeout']        : 30,
            connectTimeout: isset($cfg['connectTimeout']) ? (int)    $cfg['connectTimeout'] : 10,
            maxRetries:     isset($cfg['maxRetries'])     ? (int)    $cfg['maxRetries']     : 3,
            userAgent:      isset($cfg['userAgent'])      ? (string) $cfg['userAgent']      : self::DEFAULT_USER_AGENT,
        );
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
            $auth = 'basic:' . $this->basicUser . ':***';
        }

        return [
            'baseUri'        => $this->getBaseUri(),
            'auth'           => $auth,
            'timeout'        => $this->timeout,
            'connectTimeout' => $this->connectTimeout,
            'maxRetries'     => $this->maxRetries,
            'userAgent'      => $this->userAgent,
        ];
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
