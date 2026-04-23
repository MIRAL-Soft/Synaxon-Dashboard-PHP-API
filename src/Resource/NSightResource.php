<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Resource;

/**
 * NSight resource — wraps all /v1/n-sight/* endpoints.
 *
 * This class is generated from the OpenAPI specification. Method names follow
 * REST conventions where the endpoint shape permits; otherwise the suffix of
 * the upstream operationId is used to preserve semantic meaning.
 */
class NSightResource extends AbstractResource
{
    /**
     * Get N-Sight client metrics with comparison — Retrieves current real-time metrics for a client and
     * compares them with the most recent historical metric. Optionally specify a date to compare against a
     * specific historical point.
     *
     * @synaxon-endpoint GET /v1/n-sight/clients/{id}/metrics
     * @synaxon-operation-id GetNSightClientMetricsHttpController_getNsightClientMetrics
     * @param string $id Path parameter from the upstream spec.
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function getNsightClientMetrics(string $id, array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/n-sight/clients/{id}/metrics', ['id' => $id]), $query);
    }

    /**
     * Find N-Sight sites
     *
     * @synaxon-endpoint GET /v1/n-sight/sites
     * @synaxon-operation-id FindNSightSitesHttpController_listNsightSites
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function listNsightSites(array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/n-sight/sites'), $query);
    }

    /**
     * Create n-sight site
     *
     * @synaxon-endpoint POST /v1/n-sight/sites
     * @synaxon-operation-id CreateNSightSiteHttpController_createNsightSite
     * @param array<string, mixed>|null $body Request body.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function createNsightSite(?array $body = null): array|null
    {
        return $this->httpPost($this->expand('/v1/n-sight/sites'), $body);
    }

    /**
     * Get N-sight site
     *
     * @synaxon-endpoint GET /v1/n-sight/sites/{id}
     * @synaxon-operation-id FindNSightSiteByIdHttpController_getNsightSite
     * @param string $id Path parameter from the upstream spec.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function getNsightSite(string $id): array|null
    {
        return $this->httpGet($this->expand('/v1/n-sight/sites/{id}', ['id' => $id]));
    }

    /**
     * Update n-sight site
     *
     * @synaxon-endpoint PATCH /v1/n-sight/sites/{id}
     * @synaxon-operation-id UpdateNSightSiteHttpController_updateNsightSite
     * @param string $id Path parameter from the upstream spec.
     * @param array<string, mixed>|null $body Request body.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function updateNsightSite(string $id, ?array $body = null): array|null
    {
        return $this->httpPatch($this->expand('/v1/n-sight/sites/{id}', ['id' => $id]), $body);
    }

    /**
     * Create n-sight site
     *
     * @synaxon-endpoint GET /v1/n-sight/sites/{id}/installer
     * @synaxon-operation-id CreateNSightSiteInstallerHttpController_getNsightSiteInstaller
     * @param string $id Path parameter from the upstream spec.
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function getNsightSiteInstaller(string $id, array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/n-sight/sites/{id}/installer', ['id' => $id]), $query);
    }

    /**
     * Get N-Sight site metrics with comparison — Retrieves current real-time metrics for a site and
     * compares them with the most recent historical metric. Optionally specify a date to compare against a
     * specific historical point.
     *
     * @synaxon-endpoint GET /v1/n-sight/sites/{id}/metrics
     * @synaxon-operation-id GetNSightSiteMetricsHttpController_getNsightSiteMetrics
     * @param string $id Path parameter from the upstream spec.
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function getNsightSiteMetrics(string $id, array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/n-sight/sites/{id}/metrics', ['id' => $id]), $query);
    }

    /**
     * Get N-sight devices
     *
     * @synaxon-endpoint GET /v1/n-sight/devices
     * @synaxon-operation-id FindNSightDevicesHttpController_listNsightDevices
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function listNsightDevices(array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/n-sight/devices'), $query);
    }

    /**
     * Get N-sight device
     *
     * @synaxon-endpoint GET /v1/n-sight/devices/{id}
     * @synaxon-operation-id FindNSightDeviceByIdHttpController_getNsightDevice
     * @param string $id Path parameter from the upstream spec.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function getNsightDevice(string $id): array|null
    {
        return $this->httpGet($this->expand('/v1/n-sight/devices/{id}', ['id' => $id]));
    }

    /**
     * Get N-sight device checks
     *
     * @synaxon-endpoint GET /v1/n-sight/device-checks
     * @synaxon-operation-id FindNSightDeviceChecksHttpController_listNsightDeviceChecks
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function listNsightDeviceChecks(array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/n-sight/device-checks'), $query);
    }

    /**
     * Get N-sight device take control url
     *
     * @synaxon-endpoint GET /v1/n-sight/devices/{id}/take-control
     * @synaxon-operation-id GetDeviceTakeControlUrlHttpController_getNsightTakeControlUrl
     * @param string $id Path parameter from the upstream spec.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function getNsightTakeControlUrl(string $id): array|null
    {
        return $this->httpGet($this->expand('/v1/n-sight/devices/{id}/take-control', ['id' => $id]));
    }
}
