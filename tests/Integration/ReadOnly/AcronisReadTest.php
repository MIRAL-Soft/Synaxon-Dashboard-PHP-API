<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Integration\ReadOnly;

use miralsoft\synaxon\api\Tests\Integration\IntegrationTestCase;

/**
 * Read-only smoke tests for all GET /v1/acronis/* endpoints.
 *
 * Generated from the OpenAPI spec. Every test invokes the upstream
 * endpoint and asserts that the response is not an error. Endpoints
 * that require a sample ID draw it from the list endpoint for the
 * same resource.
 */
final class AcronisReadTest extends IntegrationTestCase
{
    use EndpointSamplingTrait;

    /**
     * Get acronis customers
     *
     * @synaxon-endpoint GET /v1/acronis/customers
     */
    public function testFindAcronisCustomersHttpControllerListAcronisCustomers(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->acronis()->listAcronisCustomers([]);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/acronis/customers');
    }

    /**
     * Get acronis customer by id
     *
     * @synaxon-endpoint GET /v1/acronis/customers/{id}
     */
    public function testFindAcronisCustomerHttpControllerGetAcronisCustomer(): void
    {
        $this->assertReadOnly('GET');
        $id = $this->sampleId(
            'acronis:/v1/acronis/customers',
            fn () => $this->client->acronis()->listAcronisCustomers(["limit" => 1]),
        );
        $response = $this->client->acronis()->getAcronisCustomer($id);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/acronis/customers/{id}');
    }

    /**
     * Get Acronis customer metrics with comparison
     *
     * @synaxon-endpoint GET /v1/acronis/customers/{id}/metrics
     */
    public function testGetAcronisCustomerMetricsHttpControllerGetAcronisCustomerMetrics(): void
    {
        $this->assertReadOnly('GET');
        $id = $this->sampleId(
            'acronis:/v1/acronis/customers',
            fn () => $this->client->acronis()->listAcronisCustomers(["limit" => 1]),
        );
        $response = $this->client->acronis()->getAcronisCustomerMetrics($id, []);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/acronis/customers/{id}/metrics');
    }

    /**
     * Get acronis partner from context
     *
     * @synaxon-endpoint GET /v1/acronis/partners/fromContext
     */
    public function testFindAcronisPartnerFromContextHttpControllerGetAcronisPartnerFromContext(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->acronis()->getAcronisPartnerFromContext();
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/acronis/partners/fromContext');
    }

    /**
     * Get Acronis partner metrics with comparison
     *
     * @synaxon-endpoint GET /v1/acronis/partners/{id}/metrics
     */
    public function testGetAcronisPartnerMetricsHttpControllerGetAcronisPartnerMetrics(): void
    {
        $this->assertReadOnly('GET');
        self::markTestSkipped('No list endpoint available in this resource to sample an ID from.');
    }

    /**
     * Get acronis devices
     *
     * @synaxon-endpoint GET /v1/acronis/devices
     */
    public function testFindAcronisDevicesHttpControllerListAcronisDevices(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->acronis()->listAcronisDevices([]);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/acronis/devices');
    }

    /**
     * Get acronis device by id
     *
     * @synaxon-endpoint GET /v1/acronis/devices/{id}
     */
    public function testFindAcronisDeviceByIdHttpControllerGetAcronisDevice(): void
    {
        $this->assertReadOnly('GET');
        $id = $this->sampleId(
            'acronis:/v1/acronis/devices',
            fn () => $this->client->acronis()->listAcronisDevices(["limit" => 1]),
        );
        $response = $this->client->acronis()->getAcronisDevice($id);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/acronis/devices/{id}');
    }

    /**
     * Get acronis policies
     *
     * @synaxon-endpoint GET /v1/acronis/policies
     */
    public function testFindAcronisPoliciesHttpControllerListAcronisPolicies(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->acronis()->listAcronisPolicies([]);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/acronis/policies');
    }

    /**
     * Get acronis policy by id
     *
     * @synaxon-endpoint GET /v1/acronis/policies/{id}
     */
    public function testFindAcronisPolicyByIdHttpControllerGetAcronisPolicy(): void
    {
        $this->assertReadOnly('GET');
        $id = $this->sampleId(
            'acronis:/v1/acronis/policies',
            fn () => $this->client->acronis()->listAcronisPolicies(["limit" => 1]),
        );
        $response = $this->client->acronis()->getAcronisPolicy($id);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/acronis/policies/{id}');
    }
}
