<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Unit\Resource;

use miralsoft\synaxon\api\Resource\EsetResource;
use miralsoft\synaxon\api\Tests\Support\MockHttpClient;
use PHPUnit\Framework\TestCase;

/**
 * Offline unit tests for every mutating /v1/eset/* endpoint.
 *
 * Each test issues the call against a MockHttpClient and asserts
 * that the verb, path, body and query match the spec verbatim.
 * Generated from the OpenAPI specification.
 */
final class EsetWriteTest extends TestCase
{
    /**
     * Create new ESET partner (managed MSP)
     *
     * @synaxon-endpoint POST /v1/eset/partners
     */
    public function testCreateEsetPartnerHttpControllerCreateEsetPartner(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new EsetResource($http);

        $resource->createEsetPartner(['field' => 'value']);

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('POST', $req['method']);
        self::assertSame('/v1/eset/partners', $req['path']);
        self::assertSame(['field' => 'value'], $req['options']['body'] ?? null);
    }

    /**
     * Create new ESET customer
     *
     * @synaxon-endpoint POST /v1/eset/customers
     */
    public function testCreateEsetCustomerHttpControllerCreateEsetCustomer(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new EsetResource($http);

        $resource->createEsetCustomer(['field' => 'value']);

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('POST', $req['method']);
        self::assertSame('/v1/eset/customers', $req['path']);
        self::assertSame(['field' => 'value'], $req['options']['body'] ?? null);
    }

    /**
     * Update ESET customer by id
     *
     * @synaxon-endpoint PATCH /v1/eset/customers/{id}
     */
    public function testUpdateEsetCustomerHttpControllerUpdateEsetCustomer(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new EsetResource($http);

        $resource->updateEsetCustomer('sample-id-1', ['field' => 'value']);

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('PATCH', $req['method']);
        self::assertSame('/v1/eset/customers/sample-id-1', $req['path']);
        self::assertSame(['field' => 'value'], $req['options']['body'] ?? null);
    }

    /**
     * Create ESET license for a customer
     *
     * @synaxon-endpoint POST /v1/eset/licenses
     */
    public function testCreateEsetLicenseHttpControllerCreateEsetLicense(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new EsetResource($http);

        $resource->createEsetLicense(['field' => 'value']);

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('POST', $req['method']);
        self::assertSame('/v1/eset/licenses', $req['path']);
        self::assertSame(['field' => 'value'], $req['options']['body'] ?? null);
    }

    /**
     * Update ESET license by id
     *
     * @synaxon-endpoint PATCH /v1/eset/licenses/{id}
     */
    public function testUpdateEsetLicenseHttpControllerUpdateEsetLicense(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new EsetResource($http);

        $resource->updateEsetLicense('sample-id-1', ['field' => 'value']);

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('PATCH', $req['method']);
        self::assertSame('/v1/eset/licenses/sample-id-1', $req['path']);
        self::assertSame(['field' => 'value'], $req['options']['body'] ?? null);
    }
}
