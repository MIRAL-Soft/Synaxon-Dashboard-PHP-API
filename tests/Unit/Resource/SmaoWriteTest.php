<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Unit\Resource;

use miralsoft\synaxon\api\Resource\SmaoResource;
use miralsoft\synaxon\api\Tests\Support\MockHttpClient;
use PHPUnit\Framework\TestCase;

/**
 * Offline unit tests for every mutating /v1/smao/* endpoint.
 *
 * Each test issues the call against a MockHttpClient and asserts
 * that the verb, path, body and query match the spec verbatim.
 * Generated from the OpenAPI specification.
 */
final class SmaoWriteTest extends TestCase
{
    /**
     * Create new SMAO customer
     *
     * @synaxon-endpoint POST /v1/smao/customers
     */
    public function testCreateSmaoCustomerHttpControllerCreateSmaoCustomer(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new SmaoResource($http);

        $resource->createSmaoCustomer(['field' => 'value']);

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('POST', $req['method']);
        self::assertSame('/v1/smao/customers', $req['path']);
        self::assertSame(['field' => 'value'], $req['options']['body'] ?? null);
        self::assertSame('json', $req['options']['bodyFormat'] ?? 'json');
    }

    /**
     * Update SMAO customer
     *
     * @synaxon-endpoint PATCH /v1/smao/customers/{id}
     */
    public function testUpdateSmaoCustomerHttpControllerUpdateSmaoCustomer(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new SmaoResource($http);

        $resource->updateSmaoCustomer('sample id/1', ['field' => 'value']);

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('PATCH', $req['method']);
        self::assertSame('/v1/smao/customers/sample%20id%2F1', $req['path']);
        self::assertSame(['field' => 'value'], $req['options']['body'] ?? null);
        self::assertSame('json', $req['options']['bodyFormat'] ?? 'json');
    }
}
