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
 * Tests are skipped automatically unless:
 *   - SYNAXON_INTEGRATION=1 is set, AND
 *   - tests/.env.test contains valid credentials.
 *
 * Tests are strictly read-only. The base class records a flag at setUp time,
 * and subclasses must invoke assertReadOnly($method) before issuing any
 * non-GET request — failing to do so raises an assertion error rather than
 * silently mutating live data.
 */
abstract class IntegrationTestCase extends TestCase
{
    protected SynaxonClient $client;

    protected SynaxonConfig $config;

    protected function setUp(): void
    {
        parent::setUp();

        if (!testConfig::isIntegrationEnabled()) {
            self::markTestSkipped('Integration disabled (set SYNAXON_INTEGRATION=1 to enable).');
        }
        if (!testConfig::hasCredentials()) {
            self::markTestSkipped('Integration credentials missing in tests/.env.test.');
        }

        $this->config = testConfig::fromEnv();
        $this->client = new SynaxonClient($this->config);
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
