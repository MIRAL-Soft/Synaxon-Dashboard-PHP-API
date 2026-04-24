<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Integration\ReadOnly;

use miralsoft\synaxon\api\Tests\Integration\IntegrationTestCase;

/**
 * Read-only smoke tests for all GET /v1/tenants/* endpoints.
 *
 * Generated from the OpenAPI spec. Every test invokes the upstream
 * endpoint and asserts that the response is not an error. Endpoints
 * that require a sample ID draw it from the list endpoint for the
 * same resource.
 */
final class TenantsReadTest extends IntegrationTestCase
{
    use EndpointSamplingTrait;

    /**
     * Get tenant of requesting user
     *
     * @synaxon-endpoint GET /v1/tenants/fromContext
     */
    public function testFindTenantHttpControllerGetTenantFromContext(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->tenants()->getTenantFromContext();
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/tenants/fromContext');
    }

    /**
     * Get tenant logo
     *
     * @synaxon-endpoint GET /v1/tenants/{id}/logo
     */
    public function testGetTenantLogoHttpControllerGetLogo(): void
    {
        $this->assertReadOnly('GET');
        self::markTestSkipped('No list endpoint available in this resource to sample an ID from.');
    }
}
