<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Integration;

use miralsoft\synaxon\api\Client\SynaxonClient;
use miralsoft\synaxon\api\Config\SynaxonConfig;
use miralsoft\synaxon\api\Http\GuzzleHttpClient;
use miralsoft\synaxon\api\Tests\Support\ReadOnlyHttpClient;
use miralsoft\synaxon\api\Tests\testConfig;
use PHPUnit\Framework\TestCase;

/**
 * Base class for live integration tests against the SYNAXON Marketplace API.
 *
 * Tests are skipped automatically unless tests/.env.test contains valid
 * credentials (either a bearer token or basic user + password). No master
 * switch is required: if no credentials are configured, nothing talks to
 * the live API.
 *
 * Tests are strictly read-only. The client's transport is wrapped in
 * ReadOnlyHttpClient, which refuses every request other than GET or HEAD
 * before it is sent; that is the guard. assertReadOnly() in the generated
 * tests only documents the intent.
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
        $this->client = new SynaxonClient($config, new ReadOnlyHttpClient(new GuzzleHttpClient($config)));
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
