<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Integration\ReadOnly;

use miralsoft\synaxon\api\Tests\Integration\IntegrationTestCase;

/**
 * Read-only smoke tests for all GET /v1/auth/* endpoints.
 *
 * Generated from the OpenAPI spec. Every test invokes the upstream
 * endpoint and asserts that the response is not an error. Endpoints
 * that require a sample ID draw it from the list endpoint for the
 * same resource.
 */
final class AuthReadTest extends IntegrationTestCase
{
    /**
     * Invokes authorization flow and redirects user to EGIS
     *
     * @synaxon-endpoint GET /v1/auth/egis
     */
    public function testEgisAuthHttpControllerAuth(): void
    {
        $this->assertReadOnly('GET');
        self::markTestSkipped('OAuth authorization flow — browser redirect, not an API call.');
    }

    /**
     * EGIS authorization callback
     *
     * @synaxon-endpoint GET /v1/auth/egis/callback
     */
    public function testEgisAuthHttpControllerCallback(): void
    {
        $this->assertReadOnly('GET');
        self::markTestSkipped('OAuth authorization callback — browser redirect, not an API call.');
    }

    /**
     * Get current user
     *
     * @synaxon-endpoint GET /v1/auth/me
     */
    public function testWhoAmIHttpControllerWhoAmI(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->auth()->whoAmI();
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/auth/me');
    }
}
