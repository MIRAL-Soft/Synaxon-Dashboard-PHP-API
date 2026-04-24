<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Resource;

/**
 * Tenants resource — wraps all /v1/tenants/* endpoints.
 *
 * This class is generated from the OpenAPI specification. Method names follow
 * REST conventions where the endpoint shape permits; otherwise the suffix of
 * the upstream operationId is used to preserve semantic meaning.
 */
class TenantsResource extends AbstractResource
{
    /**
     * Get tenant of requesting user
     *
     * @synaxon-endpoint GET /v1/tenants/fromContext
     * @synaxon-operation-id FindTenantHttpController_getTenantFromContext
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function getTenantFromContext(): array|null
    {
        return $this->httpGet($this->expand('/v1/tenants/fromContext'));
    }

    /**
     * Update tenant by id
     *
     * @synaxon-endpoint PATCH /v1/tenants/{id}
     * @synaxon-operation-id UpdateTenantHttpController_updateTenant
     * @param string $id Path parameter from the upstream spec.
     * @param array<string, mixed>|null $body Request body.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function update(string $id, ?array $body = null): array|null
    {
        return $this->httpPatch($this->expand('/v1/tenants/{id}', ['id' => $id]), $body);
    }

    /**
     * Get tenant logo
     *
     * @synaxon-endpoint GET /v1/tenants/{id}/logo
     * @synaxon-operation-id GetTenantLogoHttpController_getLogo
     * @param string $id Path parameter from the upstream spec.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function getLogo(string $id): array|null
    {
        return $this->httpGet($this->expand('/v1/tenants/{id}/logo', ['id' => $id]));
    }

    /**
     * Upload tenant logo
     *
     * @synaxon-endpoint PUT /v1/tenants/{id}/logo
     * @synaxon-operation-id UpdateTenantLogoHttpController_updateLogo
     * @param string $id Path parameter from the upstream spec.
     * @param array<string, mixed>|null $body Request body.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function updateLogo(string $id, ?array $body = null): array|null
    {
        return $this->httpPut($this->expand('/v1/tenants/{id}/logo', ['id' => $id]), $body);
    }

    /**
     * Delete tenant logo
     *
     * @synaxon-endpoint DELETE /v1/tenants/{id}/logo
     * @synaxon-operation-id DeleteTenantLogoHttpController_removeLogo
     * @param string $id Path parameter from the upstream spec.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function removeLogo(string $id): array|null
    {
        return $this->httpDelete($this->expand('/v1/tenants/{id}/logo', ['id' => $id]));
    }
}
