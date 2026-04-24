<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Unit\Resource;

use miralsoft\synaxon\api\Resource\AcronisResource;
use miralsoft\synaxon\api\Tests\Support\MockHttpClient;
use PHPUnit\Framework\TestCase;

/**
 * Offline unit tests for every mutating /v1/acronis/* endpoint.
 *
 * Each test issues the call against a MockHttpClient and asserts
 * that the verb, path, body and query match the spec verbatim.
 * Generated from the OpenAPI specification.
 */
final class AcronisWriteTest extends TestCase
{
    /**
     * Create new acronis customer
     *
     * @synaxon-endpoint POST /v1/acronis/customers
     */
    public function testCreateAcronisCustomerHttpControllerCreateAcronisCustomer(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new AcronisResource($http);

        $resource->createAcronisCustomer(['field' => 'value']);

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('POST', $req['method']);
        self::assertSame('/v1/acronis/customers', $req['path']);
        self::assertSame(['field' => 'value'], $req['options']['body'] ?? null);
    }

    /**
     * Update acronis customer by id
     *
     * @synaxon-endpoint PATCH /v1/acronis/customers/{id}
     */
    public function testUpdateAcronisCustomerHttpControllerUpdateAcronisCustomer(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new AcronisResource($http);

        $resource->updateAcronisCustomer('sample-id-1', ['field' => 'value']);

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('PATCH', $req['method']);
        self::assertSame('/v1/acronis/customers/sample-id-1', $req['path']);
        self::assertSame(['field' => 'value'], $req['options']['body'] ?? null);
    }
}
