<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests;

use miralsoft\synaxon\api\Config\SynaxonConfig;

/**
 * Central helper for resolving the SynaxonConfig used by integration tests.
 */
final class testConfig
{
    public static function isIntegrationEnabled(): bool
    {
        return getenv('SYNAXON_INTEGRATION') === '1';
    }

    public static function fromEnv(): SynaxonConfig
    {
        return SynaxonConfig::fromEnv();
    }

    public static function hasCredentials(): bool
    {
        $bearer = getenv('SYNAXON_BEARER_TOKEN');
        $user   = getenv('SYNAXON_BASIC_USER');
        $pass   = getenv('SYNAXON_BASIC_PASS');

        return ($bearer !== false && $bearer !== '')
            || ($user !== false && $user !== '' && $pass !== false && $pass !== '');
    }
}
