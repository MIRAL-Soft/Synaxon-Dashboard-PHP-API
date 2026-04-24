<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Integration\ReadOnly;

use miralsoft\synaxon\api\Tests\Integration\IntegrationTestCase;

/**
 * Read-only smoke tests for all GET /v1/layout/* endpoints.
 *
 * Generated from the OpenAPI spec. Every test invokes the upstream
 * endpoint and asserts that the response is not an error. Endpoints
 * that require a sample ID draw it from the list endpoint for the
 * same resource.
 */
final class LayoutReadTest extends IntegrationTestCase
{
    use EndpointSamplingTrait;

    /**
     * Get dashboard layouts
     *
     * @synaxon-endpoint GET /v1/layout/dashboards
     */
    public function testFindDashboardLayoutsHttpControllerListDashboardLayouts(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->layout()->listDashboardLayouts([]);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/layout/dashboards');
    }

    /**
     * Get dashboard layout by ID
     *
     * @synaxon-endpoint GET /v1/layout/dashboards/{id}
     */
    public function testFindDashboardLayoutByIdHttpControllerGetDashboardLayout(): void
    {
        $this->assertReadOnly('GET');
        $id = $this->sampleId(
            'layout:/v1/layout/dashboards',
            fn () => $this->client->layout()->listDashboardLayouts(['limit' => 1]),
        );
        $response = $this->client->layout()->getDashboardLayout($id);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/layout/dashboards/{id}');
    }
}
