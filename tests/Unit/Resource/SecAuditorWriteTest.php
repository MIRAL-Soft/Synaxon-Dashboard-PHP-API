<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Unit\Resource;

use miralsoft\synaxon\api\Resource\SecAuditorResource;
use miralsoft\synaxon\api\Tests\Support\MockHttpClient;
use PHPUnit\Framework\TestCase;

/**
 * Offline unit tests for every mutating /v1/sec-auditor/* endpoint.
 *
 * Each test issues the call against a MockHttpClient and asserts
 * that the verb, path, body and query match the spec verbatim.
 * Generated from the OpenAPI specification.
 */
final class SecAuditorWriteTest extends TestCase
{
    /**
     * Create new SEC AUDITOR customer
     *
     * @synaxon-endpoint POST /v1/sec-auditor/customers
     */
    public function testCreateSecAuditorCustomerHttpControllerCreateSecAuditorCustomer(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new SecAuditorResource($http);

        $resource->createSecAuditorCustomer(['field' => 'value']);

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('POST', $req['method']);
        self::assertSame('/v1/sec-auditor/customers', $req['path']);
        self::assertSame(['field' => 'value'], $req['options']['body'] ?? null);
    }

    /**
     * Update SEC AUDITOR customer
     *
     * @synaxon-endpoint PATCH /v1/sec-auditor/customers/{id}
     */
    public function testUpdateSecAuditorCustomerHttpControllerUpdateSecAuditorCustomer(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new SecAuditorResource($http);

        $resource->updateSecAuditorCustomer('sample-id-1', ['field' => 'value']);

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('PATCH', $req['method']);
        self::assertSame('/v1/sec-auditor/customers/sample-id-1', $req['path']);
        self::assertSame(['field' => 'value'], $req['options']['body'] ?? null);
    }
}
