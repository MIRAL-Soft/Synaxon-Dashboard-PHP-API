<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Integration\ReadOnly;

use miralsoft\synaxon\api\Tests\Integration\IntegrationTestCase;

/**
 * Read-only smoke tests for all GET /v1/cyansecurity/* endpoints.
 *
 * Generated from the OpenAPI spec. Every test invokes the upstream
 * endpoint and asserts that the response is not an error. Endpoints
 * that require a sample ID draw it from the list endpoint for the
 * same resource.
 */
final class CyansecurityReadTest extends IntegrationTestCase
{
    use EndpointSamplingTrait;

    /**
     * List CyanSecurity customers for the current tenant
     *
     * @synaxon-endpoint GET /v1/cyansecurity/customers
     */
    public function testFindCyanSecurityCustomersHttpControllerListCustomers(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->cyansecurity()->listCustomers([]);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/cyansecurity/customers');
    }

    /**
     * Get CyanSecurity customer by id
     *
     * @synaxon-endpoint GET /v1/cyansecurity/customers/{id}
     */
    public function testFindCyanSecurityCustomerByIdHttpControllerGetCustomer(): void
    {
        $this->assertReadOnly('GET');
        $id = $this->sampleId(
            'cyansecurity:/v1/cyansecurity/customers',
            fn () => $this->client->cyansecurity()->listCustomers(['limit' => 1]),
        );
        $response = $this->client->cyansecurity()->getCustomer($id);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/cyansecurity/customers/{id}');
    }
}
