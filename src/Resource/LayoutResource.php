<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Resource;

/**
 * Layout resource — wraps all /v1/layout/* endpoints.
 *
 * This class is generated from the OpenAPI specification. Method names follow
 * REST conventions where the endpoint shape permits; otherwise the suffix of
 * the upstream operationId is used to preserve semantic meaning.
 */
class LayoutResource extends AbstractResource
{
    /**
     * Get dashboard layouts
     *
     * @synaxon-endpoint GET /v1/layout/dashboards
     * @synaxon-operation-id FindDashboardLayoutsHttpController_listDashboardLayouts
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function listDashboardLayouts(array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/layout/dashboards'), $query);
    }

    /**
     * Create a new dashboard layout
     *
     * @synaxon-endpoint POST /v1/layout/dashboards
     * @synaxon-operation-id CreateDashboardLayoutHttpController_createDashboardLayout
     * @param array<string, mixed>|null $body Request body.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function createDashboardLayout(?array $body = null): array|null
    {
        return $this->httpPost($this->expand('/v1/layout/dashboards'), $body);
    }

    /**
     * Get dashboard layout by ID
     *
     * @synaxon-endpoint GET /v1/layout/dashboards/{id}
     * @synaxon-operation-id FindDashboardLayoutByIdHttpController_getDashboardLayout
     * @param string $id Path parameter from the upstream spec.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function getDashboardLayout(string $id): array|null
    {
        return $this->httpGet($this->expand('/v1/layout/dashboards/{id}', ['id' => $id]));
    }

    /**
     * Update dashboard layout
     *
     * @synaxon-endpoint PATCH /v1/layout/dashboards/{id}
     * @synaxon-operation-id UpdateDashboardLayoutHttpController_updateDashboardLayout
     * @param string $id Path parameter from the upstream spec.
     * @param array<string, mixed>|null $body Request body.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function updateDashboardLayout(string $id, ?array $body = null): array|null
    {
        return $this->httpPatch($this->expand('/v1/layout/dashboards/{id}', ['id' => $id]), $body);
    }

    /**
     * Delete dashboard layout
     *
     * @synaxon-endpoint DELETE /v1/layout/dashboards/{id}
     * @synaxon-operation-id DeleteDashboardLayoutHttpController_removeDashboardLayout
     * @param string $id Path parameter from the upstream spec.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function removeDashboardLayout(string $id): array|null
    {
        return $this->httpDelete($this->expand('/v1/layout/dashboards/{id}', ['id' => $id]));
    }
}
