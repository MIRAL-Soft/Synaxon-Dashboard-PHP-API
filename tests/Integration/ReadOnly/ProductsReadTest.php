<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Integration\ReadOnly;

use miralsoft\synaxon\api\Tests\Integration\IntegrationTestCase;

/**
 * Read-only smoke tests for all GET /v1/products/* endpoints.
 *
 * Generated from the OpenAPI spec. Every test invokes the upstream
 * endpoint and asserts that the response is not an error. Endpoints
 * that require a sample ID draw it from the list endpoint for the
 * same resource.
 */
final class ProductsReadTest extends IntegrationTestCase
{
    /**
     * Get available managed services
     *
     * @synaxon-endpoint GET /v1/products/available
     */
    public function testGenerateProductOverviewHttpControllerGetAvailable(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->products()->getAvailable();
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/products/available');
    }
}
