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

        $resource->update('sample-id-1', ['field' => 'value']);

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('PATCH', $req['method']);
        self::assertSame('/v1/users/sample-id-1', $req['path']);
        self::assertSame(['field' => 'value'], $req['options']['body'] ?? null);
    }

    /**
     * Accept providing terms
     *
     * @synaxon-endpoint POST /v1/users/terms/accept
     */
    public function testAcceptTermHttpControllerAcceptTerms(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new UsersResource($http);

        $resource->acceptTerms(['field' => 'value']);

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('POST', $req['method']);
        self::assertSame('/v1/users/terms/accept', $req['path']);
        self::assertSame(['field' => 'value'], $req['options']['body'] ?? null);
    }
}
