<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Unit\Resource;

use miralsoft\synaxon\api\Resource\BillingResource;
use miralsoft\synaxon\api\Tests\Support\MockHttpClient;
use PHPUnit\Framework\TestCase;

/**
 * Offline unit tests for every mutating /v1/billing/* endpoint.
 *
 * Each test issues the call against a MockHttpClient and asserts
 * that the verb, path, body and query match the spec verbatim.
 * Generated from the OpenAPI specification.
 */
final class BillingWriteTest extends TestCase
{
    /**
     * Create new partner API key
     *
     * @synaxon-endpoint POST /v1/billing/neumeier
     */
    public function testCreateNeumeierApiKeyHttpControllerCreateNeumeierApiKey(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new BillingResource($http);

        $resource->createNeumeierApiKey(['field' => 'value']);

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('POST', $req['method']);
        self::assertSame('/v1/billing/neumeier', $req['path']);
        self::assertSame(['field' => 'value'], $req['options']['body'] ?? null);
        self::assertSame('json', $req['options']['bodyFormat'] ?? 'json');
    }

    /**
     * Revokes a partner API key by its ID
     *
     * @synaxon-endpoint POST /v1/billing/neumeier/{id}/revoke
     */
    public function testRevokeNeumeierApiKeyHttpControllerRevokeNeumeierApiKey(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new BillingResource($http);

        $resource->revokeNeumeierApiKey('sample id/1');

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('POST', $req['method']);
        self::assertSame('/v1/billing/neumeier/sample%20id%2F1/revoke', $req['path']);
    }
}
