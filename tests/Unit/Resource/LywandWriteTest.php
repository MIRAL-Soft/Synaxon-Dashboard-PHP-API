<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Unit\Resource;

use miralsoft\synaxon\api\Resource\LywandResource;
use miralsoft\synaxon\api\Tests\Support\MockHttpClient;
use PHPUnit\Framework\TestCase;

/**
 * Offline unit tests for every mutating /v1/lywand/* endpoint.
 *
 * Each test issues the call against a MockHttpClient and asserts
 * that the verb, path, body and query match the spec verbatim.
 * Generated from the OpenAPI specification.
 */
final class LywandWriteTest extends TestCase
{
    /**
     * Index lywand partners
     *
     * @synaxon-endpoint POST /v1/lywand/partners/{id}/index
     */
    public function testIndexLywandPartnerHttpControllerIndexLywandPartner(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new LywandResource($http);

        $resource->indexLywandPartner('sample-id-1');

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('POST', $req['method']);
        self::assertSame('/v1/lywand/partners/sample-id-1/index', $req['path']);
    }

    /**
     * Create new lywand customer
     *
     * @synaxon-endpoint POST /v1/lywand/customers
     */
    public function testCreateLywandCustomerHttpControllerCreateLywandCustomer(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new LywandResource($http);

        $resource->createLywandCustomer(['field' => 'value']);

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('POST', $req['method']);
        self::assertSame('/v1/lywand/customers', $req['path']);
        self::assertSame(['field' => 'value'], $req['options']['body'] ?? null);
    }

    /**
     * Update lywand customer by id
     *
     * @synaxon-endpoint PATCH /v1/lywand/customers/{id}
     */
    public function testUpdateLywandCustomerHttpControllerUpdateLywandCustomer(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new LywandResource($http);

        $resource->updateLywandCustomer('sample-id-1', ['field' => 'value']);

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('PATCH', $req['method']);
        self::assertSame('/v1/lywand/customers/sample-id-1', $req['path']);
        self::assertSame(['field' => 'value'], $req['options']['body'] ?? null);
    }

    /**
     * Delete lywand customer
     *
     * @synaxon-endpoint DELETE /v1/lywand/customers/{id}
     */
    public function testDeleteLywandCustomerHttpControllerRemoveLywandCustomer(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new LywandResource($http);

        $resource->removeLywandCustomer('sample-id-1');

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('DELETE', $req['method']);
        self::assertSame('/v1/lywand/customers/sample-id-1', $req['path']);
    }

    /**
     * Index lywand customer
     *
     * @synaxon-endpoint POST /v1/lywand/customers/{id}/index
     */
    public function testIndexLywandCustomerHttpControllerIndexLywandCustomer(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new LywandResource($http);

        $resource->indexLywandCustomer('sample-id-1');

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('POST', $req['method']);
        self::assertSame('/v1/lywand/customers/sample-id-1/index', $req['path']);
    }

    /**
     * Index lywand customer targets
     *
     * @synaxon-endpoint POST /v1/lywand/customers/{id}/targets/index
     */
    public function testIndexLywandTargetsHttpControllerIndexLywandCustomerTargets(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new LywandResource($http);

        $resource->indexLywandCustomerTargets('sample-id-1');

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('POST', $req['method']);
        self::assertSame('/v1/lywand/customers/sample-id-1/targets/index', $req['path']);
    }

    /**
     * Index lywand customer vulnerabilities
     *
     * @synaxon-endpoint POST /v1/lywand/customers/{id}/vulnerabilities/index
     */
    public function testIndexLywandVulnerabilitiesHttpControllerIndexLywandCustomerVulnerabilities(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new LywandResource($http);

        $resource->indexLywandCustomerVulnerabilities('sample-id-1');

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('POST', $req['method']);
        self::assertSame('/v1/lywand/customers/sample-id-1/vulnerabilities/index', $req['path']);
    }
}
