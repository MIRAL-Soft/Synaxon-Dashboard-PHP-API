<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Integration\ReadOnly;

use miralsoft\synaxon\api\Tests\Integration\IntegrationTestCase;

/**
 * Read-only smoke tests for all GET /v1/customers/* endpoints.
 *
 * Generated from the OpenAPI spec. Every test invokes the upstream
 * endpoint and asserts that the response is not an error. Endpoints
 * that require a sample ID draw it from the list endpoint for the
 * same resource.
 */
final class CustomersReadTest extends IntegrationTestCase
{
    use EndpointSamplingTrait;

    /**
     * Get customers
     *
     * @synaxon-endpoint GET /v1/customers
     */
    public function testFindCustomersHttpControllerListCustomers(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->customers()->list([]);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/customers');
    }

    /**
     * Get customer suggestion by input
     *
     * @synaxon-endpoint GET /v1/customers/suggestion
     */
    public function testGetCustomerSuggestionHttpControllerGetCustomerSuggestion(): void
    {
        $this->assertReadOnly('GET');
        try {
            $response = $this->client->customers()->getCustomerSuggestion([]);
            self::assertNotNull($response, 'Expected a non-null response from GET /v1/customers/suggestion');
        } catch (\miralsoft\synaxon\api\Exception\ServerException $e) {
            self::markTestIncomplete('Upstream returns HTTP 500 as of SYNAXON Marketplace API v1.9.2.' . ' Last error: ' . $e->getMessage());
        }
    }

    /**
     * Get customer
     *
     * @synaxon-endpoint GET /v1/customers/{id}
     */
    public function testFindCustomerByIdHttpControllerGetCustomer(): void
    {
        $this->assertReadOnly('GET');
        $id = $this->sampleId(
            'customers:/v1/customers',
            fn () => $this->client->customers()->list(['limit' => 1]),
        );
        $response = $this->client->customers()->find($id);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/customers/{id}');
    }

    /**
     * Get service references
     *
     * @synaxon-endpoint GET /v1/customers/{id}/references
     */
    public function testFindCustomerReferencesHttpControllerListReferences(): void
    {
        $this->assertReadOnly('GET');
        $id = $this->sampleId(
            'customers:/v1/customers',
            fn () => $this->client->customers()->list(['limit' => 1]),
        );
        $response = $this->client->customers()->listReferences($id);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/customers/{id}/references');
    }

    /**
     * Get customer report setting
     *
     * @synaxon-endpoint GET /v1/customers/{customerId}/report
     */
    public function testFindCustomerReportSettingHttpControllerGetCustomerReportSetting(): void
    {
        $this->assertReadOnly('GET');
        $customerId = $this->sampleId(
            'customers:/v1/customers',
            fn () => $this->client->customers()->list(['limit' => 1]),
        );
        try {
            $response = $this->client->customers()->getCustomerReportSetting($customerId);
            self::assertNotNull($response, 'Expected a non-null response from GET /v1/customers/{customerId}/report');
        } catch (\miralsoft\synaxon\api\Exception\NotFoundException) {
            self::markTestSkipped('Requires a customer-report setting; skipped when none exists.');
        }
    }

    /**
     * Generate customer report PDF
     *
     * @synaxon-endpoint GET /v1/customers/{id}/report/pdf
     */
    public function testGenerateReportHttpControllerGenerateCustomerReport(): void
    {
        $this->assertReadOnly('GET');
        self::markTestSkipped('Returns PDF; requires targeted test fixture rather than a smoke call.');
    }
}
