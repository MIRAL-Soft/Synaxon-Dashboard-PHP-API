<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Unit\Resource;

use miralsoft\synaxon\api\Resource\AuditResource;
use miralsoft\synaxon\api\Tests\Support\MockHttpClient;
use PHPUnit\Framework\TestCase;

final class AuditResourceTest extends TestCase
{
    public function testListAuditLogsSendsGet(): void
    {
        $http = (new MockHttpClient())->queue(['data' => []]);
        $res = new AuditResource($http);

        $res->listAuditLogs(['limit' => 10]);

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('GET', $req['method']);
        self::assertSame('/v1/audit/logs', $req['path']);
        self::assertSame(['limit' => 10], $req['options']['query'] ?? null);
    }

    public function testFindAuditLogOptionsSendsGet(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $res = new AuditResource($http);

        $res->findAuditLogOptions();

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('GET', $req['method']);
        self::assertSame('/v1/audit/logs/options', $req['path']);
    }
}
