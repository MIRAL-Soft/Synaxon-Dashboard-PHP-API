<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Unit\Resource;

use miralsoft\synaxon\api\Resource\CoveResource;
use miralsoft\synaxon\api\Tests\Support\MockHttpClient;
use PHPUnit\Framework\TestCase;

/**
 * Offline unit tests for every mutating /v1/cove/* endpoint.
 *
 * Each test issues the call against a MockHttpClient and asserts
 * that the verb, path, body and query match the spec verbatim.
 * Generated from the OpenAPI specification.
 */
final class CoveWriteTest extends TestCase
{
    /**
     * Create new Cove customer
     *
     * @synaxon-endpoint POST /v1/cove/customers
     */
    public function testCreateCoveCustomerHttpControllerCreateCoveCustomer(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new CoveResource($http);

        $resource->createCoveCustomer(['field' => 'value']);

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('POST', $req['method']);
        self::assertSame('/v1/cove/customers', $req['path']);
        self::assertSame(['field' => 'value'], $req['options']['body'] ?? null);
        self::assertSame('json', $req['options']['bodyFormat'] ?? 'json');
    }

    /**
     * Update Cove customer
     *
     * @synaxon-endpoint PATCH /v1/cove/customers/{id}
     */
    public function testUpdateCoveCustomerHttpControllerUpdateCoveCustomer(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new CoveResource($http);

        $resource->updateCoveCustomer('sample id/1', ['field' => 'value']);

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('PATCH', $req['method']);
        self::assertSame('/v1/cove/customers/sample%20id%2F1', $req['path']);
        self::assertSame(['field' => 'value'], $req['options']['body'] ?? null);
        self::assertSame('json', $req['options']['bodyFormat'] ?? 'json');
    }
}
