<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Integration\ReadOnly;

use miralsoft\synaxon\api\Tests\Integration\IntegrationTestCase;

/**
 * Read-only smoke tests for all GET /v1/lywand/* endpoints.
 *
 * Generated from the OpenAPI spec. Every test invokes the upstream
 * endpoint and asserts that the response is not an error. Endpoints
 * that require a sample ID draw it from the list endpoint for the
 * same resource.
 */
final class LywandReadTest extends IntegrationTestCase
{
    use EndpointSamplingTrait;

    /**
     * Get lywand partner from context
     *
     * @synaxon-endpoint GET /v1/lywand/partners/fromContext
     */
    public function testGetLywandPartnerFromContextHttpControllerGetLywandPartnerFromContext(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->lywand()->getLywandPartnerFromContext();
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/lywand/partners/fromContext');
    }

    /**
     * Get Lywand partner metrics with comparison
     *
     * @synaxon-endpoint GET /v1/lywand/partners/{id}/metrics
     */
    public function testGetLywandPartnerMetricsHttpControllerGetLywandPartnerMetrics(): void
    {
        $this->assertReadOnly('GET');
        self::markTestSkipped('No list endpoint available in this resource to sample an ID from.');
    }

    /**
     * Get lywand customers
     *
     * @synaxon-endpoint GET /v1/lywand/customers
     */
    public function testFindLywandCustomersHttpControllerListLywandCustomers(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->lywand()->listLywandCustomers([]);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/lywand/customers');
    }

    /**
     * Get lywand customer by id
     *
     * @synaxon-endpoint GET /v1/lywand/customers/{id}
     */
    public function testFindLywandCustomerHttpControllerGetLywandCustomer(): void
    {
        $this->assertReadOnly('GET');
        $id = $this->sampleId(
            'lywand:/v1/lywand/customers',
            fn () => $this->client->lywand()->listLywandCustomers(["limit" => 1]),
        );
        $response = $this->client->lywand()->getLywandCustomer($id);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/lywand/customers/{id}');
    }

    /**
     * Get Lywand customer metrics with comparison
     *
     * @synaxon-endpoint GET /v1/lywand/customers/{id}/metrics
     */
    public function testGetLywandCustomerMetricsHttpControllerGetLywandCustomerMetrics(): void
    {
        $this->assertReadOnly('GET');
        $id = $this->sampleId(
            'lywand:/v1/lywand/customers',
            fn () => $this->client->lywand()->listLywandCustomers(["limit" => 1]),
        );
        $response = $this->client->lywand()->getLywandCustomerMetrics($id, []);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/lywand/customers/{id}/metrics');
    }

    /**
     * Get installation token for lywand customer
     *
     * @synaxon-endpoint GET /v1/lywand/customers/{id}/token
     */
    public function testGetLywandCustomerInstallationTokenHttpControllerGetLywandInstallationToken(): void
    {
        $this->assertReadOnly('GET');
        $id = $this->sampleId(
            'lywand:/v1/lywand/customers',
            fn () => $this->client->lywand()->listLywandCustomers(["limit" => 1]),
        );
        $response = $this->client->lywand()->getLywandInstallationToken($id);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/lywand/customers/{id}/token');
    }

    /**
     * Get all lywand targets
     *
     * @synaxon-endpoint GET /v1/lywand/targets
     */
    public function testFindLywandTargetsHttpControllerListLywandTargets(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->lywand()->listLywandTargets([]);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/lywand/targets');
    }

    /**
     * Get lywand target by id
     *
     * @synaxon-endpoint GET /v1/lywand/targets/{id}
     */
    public function testFindLywandTargetByIdHttpControllerGetLywandTarget(): void
    {
        $this->assertReadOnly('GET');
        $id = $this->sampleId(
            'lywand:/v1/lywand/targets',
            fn () => $this->client->lywand()->listLywandTargets(["limit" => 1]),
        );
        try {
            $response = $this->client->lywand()->getLywandTarget($id);
            self::assertNotNull($response, 'Expected a non-null response from GET /v1/lywand/targets/{id}');
        } catch (\miralsoft\synaxon\api\Exception\ServerException $e) {
            self::markTestIncomplete('Upstream returns HTTP 500 as of SYNAXON Marketplace API v1.9.2.' . ' Last error: ' . $e->getMessage());
        }
    }

    /**
     * Get all lywand vulnerabilities with optional customer ID filtering
     *
     * @synaxon-endpoint GET /v1/lywand/vulnerabilities
     */
    public function testFindLywandVulnerabilitiesHttpControllerGetLywandVulnerabilities(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->lywand()->getLywandVulnerabilities([]);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/lywand/vulnerabilities');
    }
}
