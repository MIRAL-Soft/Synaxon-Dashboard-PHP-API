<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Integration\ReadOnly;

use miralsoft\synaxon\api\Tests\Integration\IntegrationTestCase;

/**
 * Read-only smoke tests for all GET /v1/rollouter/* endpoints.
 *
 * Generated from the OpenAPI spec. Every test invokes the upstream
 * endpoint and asserts that the response is not an error. Endpoints
 * that require a sample ID draw it from the list endpoint for the
 * same resource.
 */
final class RollouterReadTest extends IntegrationTestCase
{
    use EndpointSamplingTrait;

    /**
     * List Rollouter customers
     *
     * @synaxon-endpoint GET /v1/rollouter/customers
     */
    public function testFindRollouterCustomersHttpControllerListRollouterCustomers(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->rollouter()->listRollouterCustomers([]);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/rollouter/customers');
    }

    /**
     * Get Rollouter customer by id
     *
     * @synaxon-endpoint GET /v1/rollouter/customers/{id}
     */
    public function testFindRollouterCustomerByIdHttpControllerGetRollouterCustomer(): void
    {
        $this->assertReadOnly('GET');
        $id = $this->sampleId(
            'rollouter:/v1/rollouter/customers',
            fn () => $this->client->rollouter()->listRollouterCustomers(['limit' => 1]),
        );
        $response = $this->client->rollouter()->getRollouterCustomer($id);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/rollouter/customers/{id}');
    }
}
