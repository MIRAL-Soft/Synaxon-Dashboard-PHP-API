<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Unit\Resource;

use miralsoft\synaxon\api\Resource\ReportsResource;
use miralsoft\synaxon\api\Tests\Support\MockHttpClient;
use PHPUnit\Framework\TestCase;

/**
 * Offline unit tests for every mutating /v1/reports/* endpoint.
 *
 * Each test issues the call against a MockHttpClient and asserts
 * that the verb, path, body and query match the spec verbatim.
 * Generated from the OpenAPI specification.
 */
final class ReportsWriteTest extends TestCase
{
    /**
     * Create partner report setting
     *
     * @synaxon-endpoint POST /v1/reports/setting
     */
    public function testCreateReportSettingHttpControllerCreateReportSetting(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new ReportsResource($http);

        $resource->createReportSetting(['field' => 'value']);

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('POST', $req['method']);
        self::assertSame('/v1/reports/setting', $req['path']);
        self::assertSame(['field' => 'value'], $req['options']['body'] ?? null);
    }

    /**
     * Update partner report setting
     *
     * @synaxon-endpoint PATCH /v1/reports/setting
     */
    public function testUpdateReportSettingHttpControllerUpdateReportSetting(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new ReportsResource($http);

        $resource->updateReportSetting(['field' => 'value']);

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('PATCH', $req['method']);
        self::assertSame('/v1/reports/setting', $req['path']);
        self::assertSame(['field' => 'value'], $req['options']['body'] ?? null);
    }

    /**
     * Delete partner report setting
     *
     * @synaxon-endpoint DELETE /v1/reports/setting
     */
    public function testDeleteReportSettingHttpControllerRemoveReportSetting(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new ReportsResource($http);

        $resource->removeReportSetting();

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('DELETE', $req['method']);
        self::assertSame('/v1/reports/setting', $req['path']);
    }
}
