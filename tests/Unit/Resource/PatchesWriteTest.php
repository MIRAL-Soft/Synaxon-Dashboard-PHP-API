<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Unit\Resource;

use miralsoft\synaxon\api\Resource\PatchesResource;
use miralsoft\synaxon\api\Tests\Support\MockHttpClient;
use PHPUnit\Framework\TestCase;

/**
 * Offline unit tests for every mutating /v1/patches/* endpoint.
 *
 * Each test issues the call against a MockHttpClient and asserts
 * that the verb, path, body and query match the spec verbatim.
 * Generated from the OpenAPI specification.
 */
final class PatchesWriteTest extends TestCase
{
    /**
     * Deploy patches
     *
     * @synaxon-endpoint POST /v1/patches/deploy
     */
    public function testDeployPatchesHttpControllerDeployPatches(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new PatchesResource($http);

        $resource->deployPatches(['field' => 'value']);

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('POST', $req['method']);
        self::assertSame('/v1/patches/deploy', $req['path']);
        self::assertSame(['field' => 'value'], $req['options']['body'] ?? null);
    }
}
