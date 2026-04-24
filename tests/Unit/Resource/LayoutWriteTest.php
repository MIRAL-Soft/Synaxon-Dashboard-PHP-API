<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Unit\Resource;

use miralsoft\synaxon\api\Resource\LayoutResource;
use miralsoft\synaxon\api\Tests\Support\MockHttpClient;
use PHPUnit\Framework\TestCase;

/**
 * Offline unit tests for every mutating /v1/layout/* endpoint.
 *
 * Each test issues the call against a MockHttpClient and asserts
 * that the verb, path, body and query match the spec verbatim.
 * Generated from the OpenAPI specification.
 */
final class LayoutWriteTest extends TestCase
{
    /**
     * Create a new dashboard layout
     *
     * @synaxon-endpoint POST /v1/layout/dashboards
     */
    public function testCreateDashboardLayoutHttpControllerCreateDashboardLayout(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new LayoutResource($http);

        $resource->createDashboardLayout(['field' => 'value']);

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('POST', $req['method']);
        self::assertSame('/v1/layout/dashboards', $req['path']);
        self::assertSame(['field' => 'value'], $req['options']['body'] ?? null);
    }

    /**
     * Update dashboard layout
     *
     * @synaxon-endpoint PATCH /v1/layout/dashboards/{id}
     */
    public function testUpdateDashboardLayoutHttpControllerUpdateDashboardLayout(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new LayoutResource($http);

        $resource->updateDashboardLayout('sample-id-1', ['field' => 'value']);

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('PATCH', $req['method']);
        self::assertSame('/v1/layout/dashboards/sample-id-1', $req['path']);
        self::assertSame(['field' => 'value'], $req['options']['body'] ?? null);
    }

    /**
     * Delete dashboard layout
     *
     * @synaxon-endpoint DELETE /v1/layout/dashboards/{id}
     */
    public function testDeleteDashboardLayoutHttpControllerRemoveDashboardLayout(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new LayoutResource($http);

        $resource->removeDashboardLayout('sample-id-1');

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('DELETE', $req['method']);
        self::assertSame('/v1/layout/dashboards/sample-id-1', $req['path']);
    }
}
