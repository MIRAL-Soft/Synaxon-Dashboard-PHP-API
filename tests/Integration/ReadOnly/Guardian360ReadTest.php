<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Integration\ReadOnly;

use miralsoft\synaxon\api\Tests\Integration\IntegrationTestCase;

/**
 * Read-only smoke tests for all GET /v1/guardian360/* endpoints.
 *
 * Generated from the OpenAPI spec. Every test invokes the upstream
 * endpoint and asserts that the response is not an error. Endpoints
 * that require a sample ID draw it from the list endpoint for the
 * same resource.
 */
final class Guardian360ReadTest extends IntegrationTestCase
{
    use EndpointSamplingTrait;

    /**
     * List Guardian360 customers
     *
     * @synaxon-endpoint GET /v1/guardian360/customers
     */
    public function testFindGuardian360CustomersHttpControllerListGuardian360Customers(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->guardian360()->listGuardian360Customers([]);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/guardian360/customers');
    }

    /**
     * Get Guardian360 customer by id
     *
     * @synaxon-endpoint GET /v1/guardian360/customers/{id}
     */
    public function testFindGuardian360CustomerHttpControllerGetGuardian360Customer(): void
    {
        $this->assertReadOnly('GET');
        $id = $this->sampleId(
            'guardian360:/v1/guardian360/customers',
            fn () => $this->client->guardian360()->listGuardian360Customers(['limit' => 1]),
        );
        $response = $this->client->guardian360()->getGuardian360Customer($id);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/guardian360/customers/{id}');
    }
}
