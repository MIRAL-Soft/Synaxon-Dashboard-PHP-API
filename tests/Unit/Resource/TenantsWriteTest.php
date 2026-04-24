<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Unit\Resource;

use miralsoft\synaxon\api\Resource\TenantsResource;
use miralsoft\synaxon\api\Tests\Support\MockHttpClient;
use PHPUnit\Framework\TestCase;

/**
 * Offline unit tests for every mutating /v1/tenants/* endpoint.
 *
 * Each test issues the call against a MockHttpClient and asserts
 * that the verb, path, body and query match the spec verbatim.
 * Generated from the OpenAPI specification.
 */
final class TenantsWriteTest extends TestCase
{
    /**
     * Update tenant by id
     *
     * @synaxon-endpoint PATCH /v1/tenants/{id}
     */
    public function testUpdateTenantHttpControllerUpdateTenant(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new TenantsResource($http);

        $resource->update('sample-id-1', ['field' => 'value']);

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('PATCH', $req['method']);
        self::assertSame('/v1/tenants/sample-id-1', $req['path']);
        self::assertSame(['field' => 'value'], $req['options']['body'] ?? null);
    }

    /**
     * Upload tenant logo
     *
     * @synaxon-endpoint PUT /v1/tenants/{id}/logo
     */
    public function testUpdateTenantLogoHttpControllerUpdateLogo(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new TenantsResource($http);

        $resource->updateLogo('sample-id-1', ['field' => 'value']);

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('PUT', $req['method']);
        self::assertSame('/v1/tenants/sample-id-1/logo', $req['path']);
        self::assertSame(['field' => 'value'], $req['options']['body'] ?? null);
    }

    /**
     * Delete tenant logo
     *
     * @synaxon-endpoint DELETE /v1/tenants/{id}/logo
     */
    public function testDeleteTenantLogoHttpControllerRemoveLogo(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new TenantsResource($http);

        $resource->removeLogo('sample-id-1');

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('DELETE', $req['method']);
        self::assertSame('/v1/tenants/sample-id-1/logo', $req['path']);
    }
}
