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
     * Create API session
     *
     * @synaxon-endpoint POST /v1/auth/token
     */
    public function testCreateApiSessionHttpControllerCreateApiSession(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new AuthResource($http);

        $resource->createApiSession(['field' => 'value']);

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('POST', $req['method']);
        self::assertSame('/v1/auth/token', $req['path']);
        self::assertSame(['field' => 'value'], $req['options']['body'] ?? null);
        self::assertSame('form', $req['options']['bodyFormat'] ?? 'json');
    }

    /**
     * Create API session (GB)
     *
     * @synaxon-endpoint POST /v1/auth/token-gb
     */
    public function testCreateApiSessionGbHttpControllerCreateApiSessionGb(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new AuthResource($http);

        $resource->createApiSessionGb(['field' => 'value']);

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('POST', $req['method']);
        self::assertSame('/v1/auth/token-gb', $req['path']);
        self::assertSame(['field' => 'value'], $req['options']['body'] ?? null);
        self::assertSame('form', $req['options']['bodyFormat'] ?? 'json');
    }

    /**
     * Refresh authentication using refresh token
     *
     * @synaxon-endpoint POST /v1/auth/refresh
     */
    public function testRefreshAuthTokenHttpControllerRefresh(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new AuthResource($http);

        $resource->refresh(['field' => 'value']);

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('POST', $req['method']);
        self::assertSame('/v1/auth/refresh', $req['path']);
        self::assertSame(['field' => 'value'], $req['options']['body'] ?? null);
        self::assertSame('json', $req['options']['bodyFormat'] ?? 'json');
    }

    /**
     * Logout current session
     *
     * @synaxon-endpoint DELETE /v1/auth
     */
    public function testDeleteAuthTokenHttpControllerLogout(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new AuthResource($http);

        $resource->logout();

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('DELETE', $req['method']);
        self::assertSame('/v1/auth', $req['path']);
    }

    /**
     * Create API token
     *
     * @synaxon-endpoint POST /v1/auth/api-tokens
     */
    public function testCreateApiTokenHttpControllerCreateApiToken(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new AuthResource($http);

        $resource->createApiToken(['field' => 'value']);

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('POST', $req['method']);
        self::assertSame('/v1/auth/api-tokens', $req['path']);
        self::assertSame(['field' => 'value'], $req['options']['body'] ?? null);
        self::assertSame('json', $req['options']['bodyFormat'] ?? 'json');
    }

    /**
     * Revoke API token
     *
     * @synaxon-endpoint POST /v1/auth/api-tokens/{id}/revoke
     */
    public function testRevokeApiTokenHttpControllerRevokeApiToken(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new AuthResource($http);

        $resource->revokeApiToken('sample id/1');

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('POST', $req['method']);
        self::assertSame('/v1/auth/api-tokens/sample%20id%2F1/revoke', $req['path']);
    }
}
