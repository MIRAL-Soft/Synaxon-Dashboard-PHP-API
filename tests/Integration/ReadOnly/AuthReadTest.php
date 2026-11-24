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
    public function testEgisAuthFlowHttpControllerAuth(): void
    {
        $this->assertReadOnly('GET');
        self::markTestSkipped('OAuth authorization flow: browser redirect, not an API call.');
    }

    /**
     * EGIS authorization callback
     *
     * @synaxon-endpoint GET /v1/auth/egis/callback
     */
    public function testEgisAuthFlowHttpControllerCallback(): void
    {
        $this->assertReadOnly('GET');
        self::markTestSkipped('OAuth authorization callback: browser redirect, not an API call.');
    }

    /**
     * Invokes authorization flow and redirects user to EGIS UK
     *
     * @synaxon-endpoint GET /v1/auth/egis-gb
     */
    public function testEgisGbAuthFlowHttpControllerAuthGb(): void
    {
        $this->assertReadOnly('GET');
        self::markTestSkipped('OAuth authorization flow: browser redirect, not an API call.');
    }

    /**
     * EGIS UK authorization callback
     *
     * @synaxon-endpoint GET /v1/auth/egis-gb/callback
     */
    public function testEgisGbAuthFlowHttpControllerCallbackGb(): void
    {
        $this->assertReadOnly('GET');
        self::markTestSkipped('OAuth authorization callback: browser redirect, not an API call.');
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

    /**
     * List API tokens
     *
     * @synaxon-endpoint GET /v1/auth/api-tokens
     */
    public function testFindApiTokensHttpControllerListApiTokens(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->auth()->listApiTokens([]);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/auth/api-tokens');
    }
}
