<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Unit\Resource;

use miralsoft\synaxon\api\Resource\SupportResource;
use miralsoft\synaxon\api\Tests\Support\MockHttpClient;
use PHPUnit\Framework\TestCase;

/**
 * Offline unit tests for every mutating /v1/support/* endpoint.
 *
 * Each test issues the call against a MockHttpClient and asserts
 * that the verb, path, body and query match the spec verbatim.
 * Generated from the OpenAPI specification.
 */
final class SupportWriteTest extends TestCase
{
    /**
     * Submit a query to the support chatbot
     *
     * @synaxon-endpoint POST /v1/support/queries
     */
    public function testCreateSupportQueryHttpControllerCreateSupportQuery(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new SupportResource($http);

        $resource->createSupportQuery(['field' => 'value']);

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('POST', $req['method']);
        self::assertSame('/v1/support/queries', $req['path']);
        self::assertSame(['field' => 'value'], $req['options']['body'] ?? null);
    }

    /**
     * Update a support query
     *
     * @synaxon-endpoint PATCH /v1/support/queries/{id}
     */
    public function testUpdateSupportQueryHttpControllerUpdateSupportQuery(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new SupportResource($http);

        $resource->updateSupportQuery('sample-id-1', ['field' => 'value']);

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('PATCH', $req['method']);
        self::assertSame('/v1/support/queries/sample-id-1', $req['path']);
        self::assertSame(['field' => 'value'], $req['options']['body'] ?? null);
    }

    /**
     * Delete a support chat thread
     *
     * @synaxon-endpoint DELETE /v1/support/chats/{threadId}
     */
    public function testDeleteSupportChatHttpControllerRemoveSupportChat(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new SupportResource($http);

        $resource->removeSupportChat('sample-threadId-1');

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('DELETE', $req['method']);
        self::assertSame('/v1/support/chats/sample-threadId-1', $req['path']);
    }
}
