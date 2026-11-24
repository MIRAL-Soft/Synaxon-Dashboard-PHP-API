<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Integration\ReadOnly;

use miralsoft\synaxon\api\Tests\Integration\IntegrationTestCase;

/**
 * Read-only smoke tests for all GET /v1/n-sight/* endpoints.
 *
 * Generated from the OpenAPI spec. Every test invokes the upstream
 * endpoint and asserts that the response is not an error. Endpoints
 * that require a sample ID draw it from the list endpoint for the
 * same resource.
 */
final class NSightReadTest extends IntegrationTestCase
{
    use EndpointSamplingTrait;

    /**
     * Get N-Sight client metrics with comparison
     *
     * @synaxon-endpoint GET /v1/n-sight/clients/{id}/metrics
     */
    public function testGetNSightClientMetricsHttpControllerGetNSightClientMetrics(): void
    {
        $this->assertReadOnly('GET');
        self::markTestSkipped('No list endpoint available in this resource to sample an ID from.');
    }

    /**
     * Find N-Sight sites
     *
     * @synaxon-endpoint GET /v1/n-sight/sites
     */
    public function testFindNSightSitesHttpControllerListNSightSites(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->nSight()->listNSightSites([]);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/n-sight/sites');
    }

    /**
     * Get N-sight site
     *
     * @synaxon-endpoint GET /v1/n-sight/sites/{id}
     */
    public function testFindNSightSiteByIdHttpControllerGetNSightSite(): void
    {
        $this->assertReadOnly('GET');
        $id = $this->sampleId(
            'n-sight:/v1/n-sight/sites',
            fn () => $this->client->nSight()->listNSightSites(['limit' => 1]),
        );
        $response = $this->client->nSight()->getNSightSite($id);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/n-sight/sites/{id}');
    }

    /**
     * Create n-sight site
     *
     * @synaxon-endpoint GET /v1/n-sight/sites/{id}/installer
     */
    public function testCreateNSightSiteInstallerHttpControllerGetNSightSiteInstaller(): void
    {
        $this->assertReadOnly('GET');
        self::markTestSkipped('Returns installer binary + requires OS query parameter.');
    }

    /**
     * Get N-Sight site metrics with comparison
     *
     * @synaxon-endpoint GET /v1/n-sight/sites/{id}/metrics
     */
    public function testGetNSightSiteMetricsHttpControllerGetNSightSiteMetrics(): void
    {
        $this->assertReadOnly('GET');
        $id = $this->sampleId(
            'n-sight:/v1/n-sight/sites',
            fn () => $this->client->nSight()->listNSightSites(['limit' => 1]),
        );
        $response = $this->client->nSight()->getNSightSiteMetrics($id, []);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/n-sight/sites/{id}/metrics');
    }

    /**
     * Get N-sight devices
     *
     * @synaxon-endpoint GET /v1/n-sight/devices
     */
    public function testFindNSightDevicesHttpControllerListNSightDevices(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->nSight()->listNSightDevices([]);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/n-sight/devices');
    }

    /**
     * Get N-sight device
     *
     * @synaxon-endpoint GET /v1/n-sight/devices/{id}
     */
    public function testFindNSightDeviceByIdHttpControllerGetNSightDevice(): void
    {
        $this->assertReadOnly('GET');
        $id = $this->sampleId(
            'n-sight:/v1/n-sight/devices',
            fn () => $this->client->nSight()->listNSightDevices(['limit' => 1]),
        );
        $response = $this->client->nSight()->getNSightDevice($id);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/n-sight/devices/{id}');
    }

    /**
     * Get N-sight device checks
     *
     * @synaxon-endpoint GET /v1/n-sight/device-checks
     */
    public function testFindNSightDeviceChecksHttpControllerListNSightDeviceChecks(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->nSight()->listNSightDeviceChecks([]);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/n-sight/device-checks');
    }

    /**
     * Get N-sight device take control url
     *
     * @synaxon-endpoint GET /v1/n-sight/devices/{id}/take-control
     */
    public function testGetDeviceTakeControlUrlHttpControllerGetNSightTakeControlUrl(): void
    {
        $this->assertReadOnly('GET');
        $id = $this->sampleId(
            'n-sight:/v1/n-sight/devices',
            fn () => $this->client->nSight()->listNSightDevices(['limit' => 1]),
        );
        $response = $this->client->nSight()->getNSightTakeControlUrl($id);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/n-sight/devices/{id}/take-control');
    }

    /**
     * Vendor-compatible raw API (N-sight Data Extraction API)
     *
     * @synaxon-endpoint GET /v1/n-sight/raw
     */
    public function testInvokeNSightRawApiHttpControllerInvokeRawApi(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->nSight()->invokeRawApi([]);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/n-sight/raw');
    }
}
