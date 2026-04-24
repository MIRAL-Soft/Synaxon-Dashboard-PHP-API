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
    public function testGetNSightClientMetricsHttpControllerGetNsightClientMetrics(): void
    {
        $this->assertReadOnly('GET');
        self::markTestSkipped('No list endpoint available in this resource to sample an ID from.');
    }

    /**
     * Find N-Sight sites
     *
     * @synaxon-endpoint GET /v1/n-sight/sites
     */
    public function testFindNSightSitesHttpControllerListNsightSites(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->nSight()->listNsightSites([]);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/n-sight/sites');
    }

    /**
     * Get N-sight site
     *
     * @synaxon-endpoint GET /v1/n-sight/sites/{id}
     */
    public function testFindNSightSiteByIdHttpControllerGetNsightSite(): void
    {
        $this->assertReadOnly('GET');
        $id = $this->sampleId(
            'n-sight:/v1/n-sight/sites',
            fn () => $this->client->nSight()->listNsightSites(['limit' => 1]),
        );
        $response = $this->client->nSight()->getNsightSite($id);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/n-sight/sites/{id}');
    }

    /**
     * Create n-sight site
     *
     * @synaxon-endpoint GET /v1/n-sight/sites/{id}/installer
     */
    public function testCreateNSightSiteInstallerHttpControllerGetNsightSiteInstaller(): void
    {
        $this->assertReadOnly('GET');
        self::markTestSkipped('Returns installer binary + requires OS query parameter.');
    }

    /**
     * Get N-Sight site metrics with comparison
     *
     * @synaxon-endpoint GET /v1/n-sight/sites/{id}/metrics
     */
    public function testGetNSightSiteMetricsHttpControllerGetNsightSiteMetrics(): void
    {
        $this->assertReadOnly('GET');
        $id = $this->sampleId(
            'n-sight:/v1/n-sight/sites',
            fn () => $this->client->nSight()->listNsightSites(['limit' => 1]),
        );
        $response = $this->client->nSight()->getNsightSiteMetrics($id, []);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/n-sight/sites/{id}/metrics');
    }

    /**
     * Get N-sight devices
     *
     * @synaxon-endpoint GET /v1/n-sight/devices
     */
    public function testFindNSightDevicesHttpControllerListNsightDevices(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->nSight()->listNsightDevices([]);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/n-sight/devices');
    }

    /**
     * Get N-sight device
     *
     * @synaxon-endpoint GET /v1/n-sight/devices/{id}
     */
    public function testFindNSightDeviceByIdHttpControllerGetNsightDevice(): void
    {
        $this->assertReadOnly('GET');
        $id = $this->sampleId(
            'n-sight:/v1/n-sight/devices',
            fn () => $this->client->nSight()->listNsightDevices(['limit' => 1]),
        );
        $response = $this->client->nSight()->getNsightDevice($id);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/n-sight/devices/{id}');
    }

    /**
     * Get N-sight device checks
     *
     * @synaxon-endpoint GET /v1/n-sight/device-checks
     */
    public function testFindNSightDeviceChecksHttpControllerListNsightDeviceChecks(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->nSight()->listNsightDeviceChecks([]);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/n-sight/device-checks');
    }

    /**
     * Get N-sight device take control url
     *
     * @synaxon-endpoint GET /v1/n-sight/devices/{id}/take-control
     */
    public function testGetDeviceTakeControlUrlHttpControllerGetNsightTakeControlUrl(): void
    {
        $this->assertReadOnly('GET');
        $id = $this->sampleId(
            'n-sight:/v1/n-sight/devices',
            fn () => $this->client->nSight()->listNsightDevices(['limit' => 1]),
        );
        $response = $this->client->nSight()->getNsightTakeControlUrl($id);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/n-sight/devices/{id}/take-control');
    }
}
