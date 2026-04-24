<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Unit\Resource;

use miralsoft\synaxon\api\Resource\NotificationsResource;
use miralsoft\synaxon\api\Tests\Support\MockHttpClient;
use PHPUnit\Framework\TestCase;

/**
 * Offline unit tests for every mutating /v1/notifications/* endpoint.
 *
 * Each test issues the call against a MockHttpClient and asserts
 * that the verb, path, body and query match the spec verbatim.
 * Generated from the OpenAPI specification.
 */
final class NotificationsWriteTest extends TestCase
{
    /**
     * Set all messages as read
     *
     * @synaxon-endpoint POST /v1/notifications/setAllRead
     */
    public function testSetAllReadMessageHttpControllerSetAllRead(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new NotificationsResource($http);

        $resource->setAllRead(['field' => 'value']);

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('POST', $req['method']);
        self::assertSame('/v1/notifications/setAllRead', $req['path']);
        self::assertSame(['field' => 'value'], $req['options']['body'] ?? null);
    }

    /**
     * Updates a message
     *
     * @synaxon-endpoint PATCH /v1/notifications/{id}
     */
    public function testUpdateMessageHttpControllerUpdateMessage(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new NotificationsResource($http);

        $resource->update('sample-id-1', ['field' => 'value']);

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('PATCH', $req['method']);
        self::assertSame('/v1/notifications/sample-id-1', $req['path']);
        self::assertSame(['field' => 'value'], $req['options']['body'] ?? null);
    }

    /**
     * Updates a bulk of messages
     *
     * @synaxon-endpoint PATCH /v1/notifications/bulk
     */
    public function testUpdateMessageBulkHttpControllerUpdateMessageBulk(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new NotificationsResource($http);

        $resource->updateMessageBulk(['field' => 'value']);

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('PATCH', $req['method']);
        self::assertSame('/v1/notifications/bulk', $req['path']);
        self::assertSame(['field' => 'value'], $req['options']['body'] ?? null);
    }

    /**
     * Set message as read
     *
     * @synaxon-endpoint POST /v1/notifications/{id}/setRead
     */
    public function testSetReadMessageHttpControllerSetRead(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new NotificationsResource($http);

        $resource->setRead('sample-id-1');

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('POST', $req['method']);
        self::assertSame('/v1/notifications/sample-id-1/setRead', $req['path']);
    }
}
