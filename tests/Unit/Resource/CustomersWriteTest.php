<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Unit\Resource;

use miralsoft\synaxon\api\Resource\CustomersResource;
use miralsoft\synaxon\api\Tests\Support\MockHttpClient;
use PHPUnit\Framework\TestCase;

/**
 * Offline unit tests for every mutating /v1/customers/* endpoint.
 *
 * Each test issues the call against a MockHttpClient and asserts
 * that the verb, path, body and query match the spec verbatim.
 * Generated from the OpenAPI specification.
 */
final class CustomersWriteTest extends TestCase
{
    /**
     * Create new customer
     *
     * @synaxon-endpoint POST /v1/customers
     */
    public function testCreateCustomerHttpControllerCreateCustomer(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new CustomersResource($http);

        $resource->create(['field' => 'value']);

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('POST', $req['method']);
        self::assertSame('/v1/customers', $req['path']);
        self::assertSame(['field' => 'value'], $req['options']['body'] ?? null);
        self::assertSame('json', $req['options']['bodyFormat'] ?? 'json');
    }

    /**
     * Update customer
     *
     * @synaxon-endpoint PATCH /v1/customers/{id}
     */
    public function testUpdateCustomerHttpControllerUpdateCustomer(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new CustomersResource($http);

        $resource->update('sample id/1', ['field' => 'value']);

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('PATCH', $req['method']);
        self::assertSame('/v1/customers/sample%20id%2F1', $req['path']);
        self::assertSame(['field' => 'value'], $req['options']['body'] ?? null);
        self::assertSame('json', $req['options']['bodyFormat'] ?? 'json');
    }

    /**
     * Delete customer
     *
     * @synaxon-endpoint DELETE /v1/customers/{id}
     */
    public function testDeleteCustomerHttpControllerRemoveCustomer(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new CustomersResource($http);

        $resource->delete('sample id/1');

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('DELETE', $req['method']);
        self::assertSame('/v1/customers/sample%20id%2F1', $req['path']);
    }

    /**
     * Import or update customers.
     *
     * @synaxon-endpoint POST /v1/customers/import
     */
    public function testImportCustomersHttpControllerImportCustomers(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new CustomersResource($http);

        $resource->importCustomers(['field' => 'value']);

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('POST', $req['method']);
        self::assertSame('/v1/customers/import', $req['path']);
        self::assertSame(['field' => 'value'], $req['options']['body'] ?? null);
        self::assertSame('json', $req['options']['bodyFormat'] ?? 'json');
    }

    /**
     * Create customer report setting
     *
     * @synaxon-endpoint POST /v1/customers/{id}/report
     */
    public function testCreateCustomerReportSettingHttpControllerCreateCustomerReportSetting(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new CustomersResource($http);

        $resource->createCustomerReportSetting('sample id/1', ['field' => 'value']);

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('POST', $req['method']);
        self::assertSame('/v1/customers/sample%20id%2F1/report', $req['path']);
        self::assertSame(['field' => 'value'], $req['options']['body'] ?? null);
        self::assertSame('json', $req['options']['bodyFormat'] ?? 'json');
    }

    /**
     * Update customer report setting
     *
     * @synaxon-endpoint PATCH /v1/customers/{id}/report
     */
    public function testUpdateCustomerReportSettingHttpControllerUpdateCustomerReportSetting(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new CustomersResource($http);

        $resource->updateCustomerReportSetting('sample id/1', ['field' => 'value']);

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('PATCH', $req['method']);
        self::assertSame('/v1/customers/sample%20id%2F1/report', $req['path']);
        self::assertSame(['field' => 'value'], $req['options']['body'] ?? null);
        self::assertSame('json', $req['options']['bodyFormat'] ?? 'json');
    }

    /**
     * Delete customer report setting
     *
     * @synaxon-endpoint DELETE /v1/customers/{id}/report
     */
    public function testDeleteCustomerReportSettingHttpControllerRemoveCustomerReportSetting(): void
    {
        $http = (new MockHttpClient())->queue([]);
        $resource = new CustomersResource($http);

        $resource->removeCustomerReportSetting('sample id/1');

        $req = $http->lastRequest();
        self::assertNotNull($req);
        self::assertSame('DELETE', $req['method']);
        self::assertSame('/v1/customers/sample%20id%2F1/report', $req['path']);
    }
}
