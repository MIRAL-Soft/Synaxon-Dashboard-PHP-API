<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Integration\ReadOnly;

use miralsoft\synaxon\api\Tests\Integration\IntegrationTestCase;

/**
 * Read-only smoke tests for all GET /v1/smao/* endpoints.
 *
 * Generated from the OpenAPI spec. Every test invokes the upstream
 * endpoint and asserts that the response is not an error. Endpoints
 * that require a sample ID draw it from the list endpoint for the
 * same resource.
 */
final class SmaoReadTest extends IntegrationTestCase
{
    use EndpointSamplingTrait;

    /**
     * Get SMAO customers
     *
     * @synaxon-endpoint GET /v1/smao/customers
     */
    public function testFindSmaoCustomersHttpControllerListSmaoCustomers(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->smao()->listSmaoCustomers([]);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/smao/customers');
    }

    /**
     * Get SMAO customer by id
     *
     * @synaxon-endpoint GET /v1/smao/customers/{id}
     */
    public function testFindSmaoCustomerHttpControllerGetSmaoCustomer(): void
    {
        $this->assertReadOnly('GET');
        $id = $this->sampleId(
            'smao:/v1/smao/customers',
            fn () => $this->client->smao()->listSmaoCustomers(['limit' => 1]),
        );
        $response = $this->client->smao()->getSmaoCustomer($id);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/smao/customers/{id}');
    }
}
