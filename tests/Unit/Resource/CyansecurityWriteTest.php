<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Unit\Resource;

use miralsoft\synaxon\api\Resource\CyansecurityResource;
use miralsoft\synaxon\api\Tests\Support\MockHttpClient;
use PHPUnit\Framework\TestCase;

/**
 * Offline unit tests for every mutating /v1/cyansecurity/* endpoint.
 *
 * Each test issues the call against a MockHttpClient and asserts
 * that the verb, path, body and query match the spec verbatim.
 * Generated from the OpenAPI specification.
 */
final class CyansecurityWriteTest extends TestCase
{
    /**
     * Create a CyanSecurity company customer
     *
     * @synaxon-endpoint POST /v1/cyansecurity/customers
     */
    public function testCreateCyanSecurityCustomerHttpControllerCreateCustomer(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new CyansecurityResource($http);

        $resource->createCustomer(['field' => 'value']);

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('POST', $req['method']);
        self::assertSame('/v1/cyansecurity/customers', $req['path']);
        self::assertSame(['field' => 'value'], $req['options']['body'] ?? null);
        self::assertSame('json', $req['options']['bodyFormat'] ?? 'json');
    }
}
