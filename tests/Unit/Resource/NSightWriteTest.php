<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Unit\Resource;

use miralsoft\synaxon\api\Resource\NSightResource;
use miralsoft\synaxon\api\Tests\Support\MockHttpClient;
use PHPUnit\Framework\TestCase;

/**
 * Offline unit tests for every mutating /v1/n-sight/* endpoint.
 *
 * Each test issues the call against a MockHttpClient and asserts
 * that the verb, path, body and query match the spec verbatim.
 * Generated from the OpenAPI specification.
 */
final class NSightWriteTest extends TestCase
{
    /**
     * Create n-sight site
     *
     * @synaxon-endpoint POST /v1/n-sight/sites
     */
    public function testCreateNSightSiteHttpControllerCreateNsightSite(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new NSightResource($http);

        $resource->createNsightSite(['field' => 'value']);

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('POST', $req['method']);
        self::assertSame('/v1/n-sight/sites', $req['path']);
        self::assertSame(['field' => 'value'], $req['options']['body'] ?? null);
    }

    /**
     * Update n-sight site
     *
     * @synaxon-endpoint PATCH /v1/n-sight/sites/{id}
     */
    public function testUpdateNSightSiteHttpControllerUpdateNsightSite(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new NSightResource($http);

        $resource->updateNsightSite('sample-id-1', ['field' => 'value']);

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('PATCH', $req['method']);
        self::assertSame('/v1/n-sight/sites/sample-id-1', $req['path']);
        self::assertSame(['field' => 'value'], $req['options']['body'] ?? null);
    }
}
