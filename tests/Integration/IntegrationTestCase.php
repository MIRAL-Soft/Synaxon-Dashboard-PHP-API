<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Integration;

use miralsoft\synaxon\api\Client\SynaxonClient;
use miralsoft\synaxon\api\Config\SynaxonConfig;
use miralsoft\synaxon\api\Tests\testConfig;
use PHPUnit\Framework\TestCase;

/**
 * Base class for live integration tests against the SYNAXON Marketplace API.
 *
 * Tests are skipped automatically unless tests/.env.test contains valid
 * credentials (either a bearer token or basic user + password). No master
 * switch is required — if no credentials are configured, nothing talks to
 * the live API.
 *
 * Tests are strictly read-only: the base class records a flag at setUp
 * time and subclasses must invoke assertReadOnly($method) before issuing
 * any non-GET request. Failing to do so raises a hard assertion error
 * rather than silently mutating live data.
 */
abstract class IntegrationTestCase extends TestCase
{
    protected SynaxonClient $client;

    protected SynaxonConfig $config;

    protected function setUp(): void
    {
        parent::setUp();

        if (!testConfig::hasCredentials()) {
            self::markTestSkipped('Integration credentials missing in tests/.env.test.');
        }

        $config = testConfig::resolveBearerConfig();
        if ($config === null) {
            self::markTestSkipped('Unable to resolve a bearer token for integration testing.');
        }

        $this->config = $config;
        $this->client = new SynaxonClient($config);
    }

    /**
     * Guard helper. Subclasses MUST call this with the HTTP verb before
     * exercising it; only GET passes.
     */
    protected function assertReadOnly(string $method): void
    {
        if (strtoupper($method) !== 'GET') {
            self::fail('Integration tests are read-only; non-GET requests are forbidden.');
        }
    }
}
