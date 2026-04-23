<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests;

use miralsoft\synaxon\api\Config\SynaxonConfig;
use miralsoft\synaxon\api\Tests\Support\TokenCache;

/**
 * Central helper for resolving the SynaxonConfig used by integration tests.
 *
 * Resolution order:
 *  1. SYNAXON_BEARER_TOKEN — used directly.
 *  2. SYNAXON_BASIC_USER / SYNAXON_BASIC_PASS — exchanged for a bearer token
 *     via POST /v1/auth/token (cached on disk by TokenCache).
 *  3. Otherwise: returns null and the calling test is skipped.
 */
final class testConfig
{
    public static function hasCredentials(): bool
    {
        $bearer = getenv('SYNAXON_BEARER_TOKEN');
        $user   = getenv('SYNAXON_BASIC_USER');
        $pass   = getenv('SYNAXON_BASIC_PASS');

        return ($bearer !== false && $bearer !== '')
            || ($user !== false && $user !== '' && $pass !== false && $pass !== '');
    }

    /**
     * Build a ready-to-use bearer-authenticated config, using the on-disk
     * token cache when basic credentials are supplied.
     */
    public static function resolveBearerConfig(): ?SynaxonConfig
    {
        $bearer = getenv('SYNAXON_BEARER_TOKEN');
        if ($bearer !== false && $bearer !== '') {
            return new SynaxonConfig(
                bearerToken: $bearer,
                baseUri:     self::baseUri(),
            );
        }

        $user = getenv('SYNAXON_BASIC_USER');
        $pass = getenv('SYNAXON_BASIC_PASS');
        if ($user === false || $user === '' || $pass === false || $pass === '') {
            return null;
        }

        $basicConfig = new SynaxonConfig(
            basicUser: $user,
            basicPass: $pass,
            baseUri:   self::baseUri(),
        );

        $token = TokenCache::resolve($basicConfig);
        if ($token === null) {
            return null;
        }

        return new SynaxonConfig(
            bearerToken: $token,
            baseUri:     self::baseUri(),
        );
    }

    private static function baseUri(): string
    {
        $base = getenv('SYNAXON_BASE_URI');
        if ($base !== false && $base !== '') {
            return $base;
        }
        return SynaxonConfig::DEFAULT_BASE_URI;
    }
}
