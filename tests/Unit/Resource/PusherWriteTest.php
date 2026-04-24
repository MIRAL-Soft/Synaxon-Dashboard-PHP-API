<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Unit\Resource;

use miralsoft\synaxon\api\Resource\PusherResource;
use miralsoft\synaxon\api\Tests\Support\MockHttpClient;
use PHPUnit\Framework\TestCase;

/**
 * Offline unit tests for every mutating /v1/pusher/* endpoint.
 *
 * Each test issues the call against a MockHttpClient and asserts
 * that the verb, path, body and query match the spec verbatim.
 * Generated from the OpenAPI specification.
 */
final class PusherWriteTest extends TestCase
{
    /**
     * Pusher user authentication
     *
     * @synaxon-endpoint POST /v1/pusher/user-auth
     */
    public function testPusherUserAuthHttpControllerPusherUserAuth(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new PusherResource($http);

        $resource->pusherUserAuth(['field' => 'value']);

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('POST', $req['method']);
        self::assertSame('/v1/pusher/user-auth', $req['path']);
        self::assertSame(['field' => 'value'], $req['options']['body'] ?? null);
    }

    /**
     * Pusher private channel authentication
     *
     * @synaxon-endpoint POST /v1/pusher/channel-auth
     */
    public function testPusherChannelAuthHttpControllerPusherChannelAuth(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new PusherResource($http);

        $resource->pusherChannelAuth(['field' => 'value']);

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('POST', $req['method']);
        self::assertSame('/v1/pusher/channel-auth', $req['path']);
        self::assertSame(['field' => 'value'], $req['options']['body'] ?? null);
    }
}
