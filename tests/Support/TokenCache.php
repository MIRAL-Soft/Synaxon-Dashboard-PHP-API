<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Support;

use JsonException;
use miralsoft\synaxon\api\Client\SynaxonClient;
use miralsoft\synaxon\api\Config\SynaxonConfig;
use RuntimeException;

/**
 * Test-only helper that exchanges Basic credentials for a bearer token via
 * POST /v1/auth/token and caches the result on disk so subsequent test runs
 * skip the round-trip until the token expires.
 *
 * The cache file (tests/.bearer-token.cache) is gitignored. It only ever
 * exists on developer machines.
 *
 * This helper is part of the test suite, not of the public library API.
 * The library itself is auth-agnostic — it is the consumer's responsibility
 * to acquire and rotate tokens.
 */
final class TokenCache
{
    private const CACHE_FILE = __DIR__ . '/../.bearer-token.cache';

    /**
     * Safety margin: refresh the token if it expires in less than this many
     * seconds, so a long-running test suite never trips a mid-run expiry.
     */
    private const REFRESH_LEEWAY_SECONDS = 60;

    /**
     * Resolve a usable bearer token. Returns null if neither cache nor basic
     * credentials are available.
     */
    public static function resolve(SynaxonConfig $basicConfig): ?string
    {
        $cached = self::readCache($basicConfig->getBaseUri());
        if ($cached !== null) {
            return $cached;
        }

        return self::fetchAndCache($basicConfig);
    }

    /**
     * Force-refresh the cached token, e.g. after a 401 response.
     */
    public static function refresh(SynaxonConfig $basicConfig): ?string
    {
        @unlink(self::CACHE_FILE);

        return self::fetchAndCache($basicConfig);
    }

    private static function readCache(string $baseUri): ?string
    {
        if (!is_file(self::CACHE_FILE)) {
            return null;
        }
        $raw = file_get_contents(self::CACHE_FILE);
        if ($raw === false || $raw === '') {
            return null;
        }
        try {
            /** @var array{access_token?: string, expires_at?: int, base_uri?: string} $data */
            $data = json_decode($raw, true, 8, JSON_THROW_ON_ERROR);
        } catch (JsonException) {
            return null;
        }

        $token = $data['access_token'] ?? null;
        $expires = $data['expires_at'] ?? null;
        $cachedBase = $data['base_uri'] ?? null;

        if (!is_string($token) || $token === '') {
            return null;
        }
        if (!is_int($expires) || $expires - self::REFRESH_LEEWAY_SECONDS <= time()) {
            return null;
        }
        if ($cachedBase !== $baseUri) {
            // Different environment cached — never reuse cross-environment.
            return null;
        }

        return $token;
    }

    private static function fetchAndCache(SynaxonConfig $basicConfig): ?string
    {
        if ($basicConfig->getBasicUser() === null || $basicConfig->getBasicPass() === null) {
            return null;
        }

        $client = new SynaxonClient($basicConfig);

        // The upstream spec omits the request body for POST /v1/auth/token,
        // but the API rejects empty bodies with HTTP 400. Supply the OAuth2
        // client-credentials parameters the backend expects.
        $scope = getenv('SYNAXON_SCOPE');
        if ($scope === false || $scope === '') {
            $scope = 'sys-app';
        }

        /** @var array<string, mixed>|null $response */
        $response = $client->auth()->getApiToken([
            'grant_type' => 'client_credentials',
            'scope' => $scope,
        ]);

        if (!is_array($response)) {
            throw new RuntimeException('POST /v1/auth/token returned no JSON body');
        }

        $token = $response['access_token'] ?? null;
        $expires = $response['expires_in'] ?? 3600;

        if (!is_string($token) || $token === '') {
            throw new RuntimeException('POST /v1/auth/token returned no access_token field');
        }

        $expiresIn = is_numeric($expires) ? (int) $expires : 3600;

        $payload = [
            'access_token' => $token,
            'expires_at' => time() + $expiresIn,
            'base_uri' => $basicConfig->getBaseUri(),
        ];

        $dir = dirname(self::CACHE_FILE);
        if (!is_dir($dir) && !@mkdir($dir, 0o755, true) && !is_dir($dir)) {
            throw new RuntimeException('Could not create cache directory: ' . $dir);
        }

        $encoded = json_encode($payload, JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR);

        // Write with an exclusive lock so concurrent test runs don't truncate
        // each other's payload, then lock down permissions to the owner only
        // — the cached bearer token is a credential and must not be readable
        // by other users on the machine.
        $written = @file_put_contents(self::CACHE_FILE, $encoded, LOCK_EX);
        if ($written === false) {
            throw new RuntimeException('Could not write token cache: ' . self::CACHE_FILE);
        }
        @chmod(self::CACHE_FILE, 0o600);

        return $token;
    }
}
