<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Integration\ReadOnly;

use miralsoft\synaxon\api\Tests\Integration\IntegrationTestCase;

/**
 * Read-only smoke tests for all GET /v1/cloudally/* endpoints.
 *
 * Generated from the OpenAPI spec. Every test invokes the upstream
 * endpoint and asserts that the response is not an error. Endpoints
 * that require a sample ID draw it from the list endpoint for the
 * same resource.
 */
final class CloudallyReadTest extends IntegrationTestCase
{
    use EndpointSamplingTrait;

    /**
     * Get Cloudally customers
     *
     * @synaxon-endpoint GET /v1/cloudally/customers
     */
    public function testFindCloudallyCustomersHttpControllerListCloudallyCustomers(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->cloudally()->listCloudallyCustomers([]);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/cloudally/customers');
    }

    /**
     * Get Cloudally customer by id
     *
     * @synaxon-endpoint GET /v1/cloudally/customers/{id}
     */
    public function testFindCloudallyCustomerByIdHttpControllerGetCloudallyCustomer(): void
    {
        $this->assertReadOnly('GET');
        $id = $this->sampleId(
            'cloudally:/v1/cloudally/customers',
            fn () => $this->client->cloudally()->listCloudallyCustomers(['limit' => 1]),
        );
        $response = $this->client->cloudally()->getCloudallyCustomer($id);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/cloudally/customers/{id}');
    }

    /**
     * Get Cloudally partner by id
     *
     * @synaxon-endpoint GET /v1/cloudally/partners/{id}
     */
    public function testFindCloudallyPartnerByIdHttpControllerGetCloudallyPartner(): void
    {
        $this->assertReadOnly('GET');
        self::markTestSkipped('No list endpoint available in this resource to sample an ID from.');
    }

    /**
     * Get Cloudally partner from context
     *
     * @synaxon-endpoint GET /v1/cloudally/partners/fromContext
     */
    public function testFindCloudallyPartnerFromContextHttpControllerGetCloudallyPartnerFromContext(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->cloudally()->getCloudallyPartnerFromContext();
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/cloudally/partners/fromContext');
    }

    /**
     * Get Cloudally tasks
     *
     * @synaxon-endpoint GET /v1/cloudally/tasks
     */
    public function testFindCloudallyTasksHttpControllerListCloudallyTasks(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->cloudally()->listCloudallyTasks([]);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/cloudally/tasks');
    }

    /**
     * Get Cloudally backup statuses
     *
     * @synaxon-endpoint GET /v1/cloudally/statuses
     */
    public function testFindCloudallyStatusesHttpControllerListCloudallyStatuses(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->cloudally()->listCloudallyStatuses([]);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/cloudally/statuses');
    }

    /**
     * Get Cloudally report data
     *
     * @synaxon-endpoint GET /v1/cloudally/report/report-data
     */
    public function testFindCloudallyReportDataHttpControllerGetCloudallyReportData(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->cloudally()->getCloudallyReportData(['modules' => ['customerCount']]);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/cloudally/report/report-data');
    }

    /**
     * Get Cloudally partner metrics with comparison
     *
     * @synaxon-endpoint GET /v1/cloudally/partners/{id}/metrics
     */
    public function testGetCloudallyPartnerMetricsHttpControllerGetCloudallyPartnerMetrics(): void
    {
        $this->assertReadOnly('GET');
        self::markTestSkipped('No list endpoint available in this resource to sample an ID from.');
    }

    /**
     * Get Cloudally customer metrics with comparison
     *
     * @synaxon-endpoint GET /v1/cloudally/customers/{id}/metrics
     */
    public function testGetCloudallyCustomerMetricsHttpControllerGetCloudallyCustomerMetrics(): void
    {
        $this->assertReadOnly('GET');
        $id = $this->sampleId(
            'cloudally:/v1/cloudally/customers',
            fn () => $this->client->cloudally()->listCloudallyCustomers(['limit' => 1]),
        );
        $response = $this->client->cloudally()->getCloudallyCustomerMetrics($id, []);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/cloudally/customers/{id}/metrics');
    }
}
