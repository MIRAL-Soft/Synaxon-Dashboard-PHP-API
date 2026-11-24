<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Integration\ReadOnly;

use miralsoft\synaxon\api\Tests\Integration\IntegrationTestCase;

/**
 * Read-only smoke tests for all GET /v1/cove/* endpoints.
 *
 * Generated from the OpenAPI spec. Every test invokes the upstream
 * endpoint and asserts that the response is not an error. Endpoints
 * that require a sample ID draw it from the list endpoint for the
 * same resource.
 */
final class CoveReadTest extends IntegrationTestCase
{
    use EndpointSamplingTrait;

    /**
     * List Cove customers
     *
     * @synaxon-endpoint GET /v1/cove/customers
     */
    public function testFindCoveCustomersHttpControllerListCoveCustomers(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->cove()->listCoveCustomers([]);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/cove/customers');
    }

    /**
     * Get Cove customer by id
     *
     * @synaxon-endpoint GET /v1/cove/customers/{id}
     */
    public function testFindCoveCustomerHttpControllerGetCoveCustomer(): void
    {
        $this->assertReadOnly('GET');
        $id = $this->sampleId(
            'cove:/v1/cove/customers',
            fn () => $this->client->cove()->listCoveCustomers(['limit' => 1]),
        );
        $response = $this->client->cove()->getCoveCustomer($id);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/cove/customers/{id}');
    }
}
