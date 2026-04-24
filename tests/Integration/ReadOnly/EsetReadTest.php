<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Integration\ReadOnly;

use miralsoft\synaxon\api\Tests\Integration\IntegrationTestCase;

/**
 * Read-only smoke tests for all GET /v1/eset/* endpoints.
 *
 * Generated from the OpenAPI spec. Every test invokes the upstream
 * endpoint and asserts that the response is not an error. Endpoints
 * that require a sample ID draw it from the list endpoint for the
 * same resource.
 */
final class EsetReadTest extends IntegrationTestCase
{
    use EndpointSamplingTrait;

    /**
     * List ESET partners
     *
     * @synaxon-endpoint GET /v1/eset/partners
     */
    public function testFindEsetPartnersHttpControllerListEsetPartners(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->eset()->listEsetPartners([]);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/eset/partners');
    }

    /**
     * Get eset partner from context
     *
     * @synaxon-endpoint GET /v1/eset/partners/fromContext
     */
    public function testFindEsetPartnerFromContextHttpControllerGetEsetPartnerFromContext(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->eset()->getEsetPartnerFromContext();
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/eset/partners/fromContext');
    }

    /**
     * Get ESET partner metrics with comparison
     *
     * @synaxon-endpoint GET /v1/eset/partners/{id}/metrics
     */
    public function testGetEsetPartnerMetricsHttpControllerGetEsetPartnerMetrics(): void
    {
        $this->assertReadOnly('GET');
        $id = $this->sampleId(
            'eset:/v1/eset/partners',
            fn () => $this->client->eset()->listEsetPartners(['limit' => 1]),
        );
        $response = $this->client->eset()->getEsetPartnerMetrics($id, []);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/eset/partners/{id}/metrics');
    }

    /**
     * List ESET customers
     *
     * @synaxon-endpoint GET /v1/eset/customers
     */
    public function testFindEsetCustomersHttpControllerListEsetCustomers(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->eset()->listEsetCustomers([]);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/eset/customers');
    }

    /**
     * Get ESET customer by id
     *
     * @synaxon-endpoint GET /v1/eset/customers/{id}
     */
    public function testFindEsetCustomerByIdHttpControllerGetEsetCustomer(): void
    {
        $this->assertReadOnly('GET');
        $id = $this->sampleId(
            'eset:/v1/eset/customers',
            fn () => $this->client->eset()->listEsetCustomers(['limit' => 1]),
        );
        $response = $this->client->eset()->getEsetCustomer($id);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/eset/customers/{id}');
    }

    /**
     * Get ESET customer metrics with comparison
     *
     * @synaxon-endpoint GET /v1/eset/customers/{id}/metrics
     */
    public function testGetEsetCustomerMetricsHttpControllerGetEsetCustomerMetrics(): void
    {
        $this->assertReadOnly('GET');
        $id = $this->sampleId(
            'eset:/v1/eset/customers',
            fn () => $this->client->eset()->listEsetCustomers(['limit' => 1]),
        );
        $response = $this->client->eset()->getEsetCustomerMetrics($id, []);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/eset/customers/{id}/metrics');
    }

    /**
     * List ESET customers
     *
     * @synaxon-endpoint GET /v1/eset/licenses
     */
    public function testFindEsetLicensesHttpControllerListEsetLicenses(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->eset()->listEsetLicenses([]);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/eset/licenses');
    }

    /**
     * Get ESET license by id
     *
     * @synaxon-endpoint GET /v1/eset/licenses/{id}
     */
    public function testFindEsetLicenseByIdHttpControllerGetEsetLicense(): void
    {
        $this->assertReadOnly('GET');
        $id = $this->sampleId(
            'eset:/v1/eset/licenses',
            fn () => $this->client->eset()->listEsetLicenses(['limit' => 1]),
        );
        $response = $this->client->eset()->getEsetLicense($id);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/eset/licenses/{id}');
    }

    /**
     * List ESET devices
     *
     * @synaxon-endpoint GET /v1/eset/devices
     */
    public function testFindEsetDevicesHttpControllerListEsetDevices(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->eset()->listEsetDevices([]);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/eset/devices');
    }

    /**
     * List ESET device problems
     *
     * @synaxon-endpoint GET /v1/eset/device-problems
     */
    public function testFindEsetDeviceProblemsHttpControllerListDeviceProblems(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->eset()->listDeviceProblems([]);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/eset/device-problems');
    }
}
