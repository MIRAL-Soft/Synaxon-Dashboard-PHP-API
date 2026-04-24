<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Unit\Resource;

use miralsoft\synaxon\api\Resource\AuthResource;
use miralsoft\synaxon\api\Tests\Support\MockHttpClient;
use PHPUnit\Framework\TestCase;

/**
 * Offline unit tests for every mutating /v1/auth/* endpoint.
 *
 * Each test issues the call against a MockHttpClient and asserts
 * that the verb, path, body and query match the spec verbatim.
 * Generated from the OpenAPI specification.
 */
final class AuthWriteTest extends TestCase
{
    /**
     * Get API token
     *
     * @synaxon-endpoint POST /v1/auth/token
     */
    public function testCreateApiTokenHttpControllerGetApiToken(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new AuthResource($http);

        $resource->getApiToken(['field' => 'value']);

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('POST', $req['method']);
        self::assertSame('/v1/auth/token', $req['path']);
        self::assertSame(['field' => 'value'], $req['options']['body'] ?? null);
    }

    /**
     * Refresh authentication using refresh token
     *
     * @synaxon-endpoint POST /v1/auth/refresh
     */
    public function testRefreshTokenHttpControllerRefresh(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new AuthResource($http);

        $resource->refresh(['field' => 'value']);

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('POST', $req['method']);
        self::assertSame('/v1/auth/refresh', $req['path']);
        self::assertSame(['field' => 'value'], $req['options']['body'] ?? null);
    }

    /**
     * Logout current session
     *
     * @synaxon-endpoint DELETE /v1/auth
     */
    public function testDeleteTokenHttpControllerLogout(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new AuthResource($http);

        $resource->logout();

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('DELETE', $req['method']);
        self::assertSame('/v1/auth', $req['path']);
    }
}
