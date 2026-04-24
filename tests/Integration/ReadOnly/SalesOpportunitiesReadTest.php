<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Integration\ReadOnly;

use miralsoft\synaxon\api\Tests\Integration\IntegrationTestCase;

/**
 * Read-only smoke tests for all GET /v1/sales-opportunities/* endpoints.
 *
 * Generated from the OpenAPI spec. Every test invokes the upstream
 * endpoint and asserts that the response is not an error. Endpoints
 * that require a sample ID draw it from the list endpoint for the
 * same resource.
 */
final class SalesOpportunitiesReadTest extends IntegrationTestCase
{
    /**
     * Get sales opportunities
     *
     * @synaxon-endpoint GET /v1/sales-opportunities
     */
    public function testGetSalesOpportunitiesHttpControllerListNsightSalesOpportunities(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->salesOpportunities()->list([]);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/sales-opportunities');
    }

    /**
     * Get sales opportunities
     *
     * @synaxon-endpoint GET /v1/sales-opportunities/csv
     */
    public function testGetSalesOpportunitiesExportHttpControllerExportNsightSalesOpportunitiesCSV(): void
    {
        $this->assertReadOnly('GET');
        self::markTestSkipped('Returns CSV; requires targeted test fixture rather than a smoke call.');
    }

    /**
     * Get sales opportunities
     *
     * @synaxon-endpoint GET /v1/sales-opportunities/pdf
     */
    public function testGetSalesOpportunitiesExportHttpControllerExportNsightSalesOpportunitiesPDF(): void
    {
        $this->assertReadOnly('GET');
        self::markTestSkipped('Returns PDF; requires targeted test fixture rather than a smoke call.');
    }
}
