<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Unit\Client;

use miralsoft\synaxon\api\Client\SynaxonClient;
use miralsoft\synaxon\api\Config\SynaxonConfig;
use miralsoft\synaxon\api\Resource\AcronisResource;
use miralsoft\synaxon\api\Resource\AuditResource;
use miralsoft\synaxon\api\Resource\CustomersResource;
use miralsoft\synaxon\api\Tests\Support\MockHttpClient;
use PHPUnit\Framework\TestCase;

final class SynaxonClientTest extends TestCase
{
    public function testFactoriesReturnSameInstance(): void
    {
        $client = new SynaxonClient(new SynaxonConfig(bearerToken: 'tok'), new MockHttpClient());
        self::assertInstanceOf(AuditResource::class, $client->audit());
        self::assertSame($client->audit(), $client->audit());
        self::assertInstanceOf(AcronisResource::class, $client->acronis());
        self::assertInstanceOf(CustomersResource::class, $client->customers());
    }

    public function testResourceMethodsRouteThroughHttpClient(): void
    {
        $http = (new MockHttpClient())->queue(['ok' => true]);
        $client = new SynaxonClient(new SynaxonConfig(bearerToken: 'tok'), $http);

        $client->audit()->findAuditLogOptions();

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('GET', $req['method']);
        self::assertSame('/v1/audit/logs/options', $req['path']);
    }
}
