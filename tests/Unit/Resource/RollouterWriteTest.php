<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Unit\Resource;

use miralsoft\synaxon\api\Resource\RollouterResource;
use miralsoft\synaxon\api\Tests\Support\MockHttpClient;
use PHPUnit\Framework\TestCase;

/**
 * Offline unit tests for every mutating /v1/rollouter/* endpoint.
 *
 * Each test issues the call against a MockHttpClient and asserts
 * that the verb, path, body and query match the spec verbatim.
 * Generated from the OpenAPI specification.
 */
final class RollouterWriteTest extends TestCase
{
    /**
     * Create a Rollouter rollout for a customer
     *
     * @synaxon-endpoint POST /v1/rollouter/customers
     */
    public function testCreateRollouterCustomerHttpControllerCreateRollouterCustomer(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new RollouterResource($http);

        $resource->createRollouterCustomer(['field' => 'value']);

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('POST', $req['method']);
        self::assertSame('/v1/rollouter/customers', $req['path']);
        self::assertSame(['field' => 'value'], $req['options']['body'] ?? null);
        self::assertSame('json', $req['options']['bodyFormat'] ?? 'json');
    }

    /**
     * Update the local Rollouter customer reference
     *
     * @synaxon-endpoint PATCH /v1/rollouter/customers/{id}
     */
    public function testCreateRollouterCustomerHttpControllerUpdateRollouterCustomer(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new RollouterResource($http);

        $resource->updateRollouterCustomer('sample id/1', ['field' => 'value']);

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('PATCH', $req['method']);
        self::assertSame('/v1/rollouter/customers/sample%20id%2F1', $req['path']);
        self::assertSame(['field' => 'value'], $req['options']['body'] ?? null);
        self::assertSame('json', $req['options']['bodyFormat'] ?? 'json');
    }
}
