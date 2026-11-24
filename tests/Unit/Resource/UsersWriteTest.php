<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Unit\Resource;

use miralsoft\synaxon\api\Resource\UsersResource;
use miralsoft\synaxon\api\Tests\Support\MockHttpClient;
use PHPUnit\Framework\TestCase;

/**
 * Offline unit tests for every mutating /v1/users/* endpoint.
 *
 * Each test issues the call against a MockHttpClient and asserts
 * that the verb, path, body and query match the spec verbatim.
 * Generated from the OpenAPI specification.
 */
final class UsersWriteTest extends TestCase
{
    /**
     * Updates user
     *
     * @synaxon-endpoint PATCH /v1/users/{id}
     */
    public function testUpdateUserHttpControllerUpdateUser(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new UsersResource($http);

        $resource->update('sample id/1', ['field' => 'value']);

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('PATCH', $req['method']);
        self::assertSame('/v1/users/sample%20id%2F1', $req['path']);
        self::assertSame(['field' => 'value'], $req['options']['body'] ?? null);
        self::assertSame('json', $req['options']['bodyFormat'] ?? 'json');
    }
}
