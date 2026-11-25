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
    public function testGetSalesOpportunitiesHttpControllerListNSightSalesOpportunities(): void
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
    public function testGetSalesOpportunitiesExportHttpControllerExportNSightSalesOpportunitiesCSV(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->salesOpportunities()->exportNSightSalesOpportunitiesCSV([]);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/sales-opportunities/csv');
        self::assertIsArray($response);
        self::assertArrayHasKey('_raw', $response, 'a file response arrives as _raw/_contentType');
        self::assertStringNotContainsString('json', (string) $response['_contentType']);
    }

    /**
     * Get sales opportunities
     *
     * @synaxon-endpoint GET /v1/sales-opportunities/pdf
     */
    public function testGetSalesOpportunitiesExportHttpControllerExportNSightSalesOpportunitiesPDF(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->salesOpportunities()->exportNSightSalesOpportunitiesPDF([]);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/sales-opportunities/pdf');
        self::assertIsArray($response);
        self::assertArrayHasKey('_raw', $response, 'a file response arrives as _raw/_contentType');
        self::assertStringNotContainsString('json', (string) $response['_contentType']);
    }
}
