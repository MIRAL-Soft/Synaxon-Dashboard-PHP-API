<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Resource;

/**
 * Acronis resource — wraps all /v1/acronis/* endpoints.
 *
 * This class is generated from the OpenAPI specification. Method names follow
 * REST conventions where the endpoint shape permits; otherwise the suffix of
 * the upstream operationId is used to preserve semantic meaning.
 */
class AcronisResource extends AbstractResource
{
    /**
     * Get acronis customers
     *
     * @synaxon-endpoint GET /v1/acronis/customers
     * @synaxon-operation-id FindAcronisCustomersHttpController_listAcronisCustomers
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function listAcronisCustomers(array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/acronis/customers'), $query);
    }

    /**
     * Create new acronis customer
     *
     * @synaxon-endpoint POST /v1/acronis/customers
     * @synaxon-operation-id CreateAcronisCustomerHttpController_createAcronisCustomer
     * @param array<string, mixed>|null $body Request body.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function createAcronisCustomer(?array $body = null): array|null
    {
        return $this->httpPost($this->expand('/v1/acronis/customers'), $body);
    }

    /**
     * Get acronis customer by id
     *
     * @synaxon-endpoint GET /v1/acronis/customers/{id}
     * @synaxon-operation-id FindAcronisCustomerHttpController_getAcronisCustomer
     * @param string $id Path parameter from the upstream spec.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function getAcronisCustomer(string $id): array|null
    {
        return $this->httpGet($this->expand('/v1/acronis/customers/{id}', ['id' => $id]));
    }

    /**
     * Update acronis customer by id
     *
     * @synaxon-endpoint PATCH /v1/acronis/customers/{id}
     * @synaxon-operation-id UpdateAcronisCustomerHttpController_updateAcronisCustomer
     * @param string $id Path parameter from the upstream spec.
     * @param array<string, mixed>|null $body Request body.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function updateAcronisCustomer(string $id, ?array $body = null): array|null
    {
        return $this->httpPatch($this->expand('/v1/acronis/customers/{id}', ['id' => $id]), $body);
    }

    /**
     * Get Acronis customer metrics with comparison — Retrieves current real-time metrics for a customer
     * and compares them with the most recent historical metric. Optionally specify a date to compare
     * against a specific historical point.
     *
     * @synaxon-endpoint GET /v1/acronis/customers/{id}/metrics
     * @synaxon-operation-id GetAcronisCustomerMetricsHttpController_getAcronisCustomerMetrics
     * @param string $id Path parameter from the upstream spec.
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function getAcronisCustomerMetrics(string $id, array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/acronis/customers/{id}/metrics', ['id' => $id]), $query);
    }

    /**
     * Get acronis partner from context
     *
     * @synaxon-endpoint GET /v1/acronis/partners/fromContext
     * @synaxon-operation-id FindAcronisPartnerFromContextHttpController_getAcronisPartnerFromContext
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function getAcronisPartnerFromContext(): array|null
    {
        return $this->httpGet($this->expand('/v1/acronis/partners/fromContext'));
    }

    /**
     * Get Acronis partner metrics with comparison — Retrieves current real-time metrics for an Acronis
     * partner and compares them with the most recent historical metric. Optionally specify a date to
     * compare against a specific historical point.
     *
     * @synaxon-endpoint GET /v1/acronis/partners/{id}/metrics
     * @synaxon-operation-id GetAcronisPartnerMetricsHttpController_getAcronisPartnerMetrics
     * @param string $id Path parameter from the upstream spec.
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function getAcronisPartnerMetrics(string $id, array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/acronis/partners/{id}/metrics', ['id' => $id]), $query);
    }

    /**
     * Get acronis devices
     *
     * @synaxon-endpoint GET /v1/acronis/devices
     * @synaxon-operation-id FindAcronisDevicesHttpController_listAcronisDevices
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function listAcronisDevices(array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/acronis/devices'), $query);
    }

    /**
     * Get acronis device by id
     *
     * @synaxon-endpoint GET /v1/acronis/devices/{id}
     * @synaxon-operation-id FindAcronisDeviceByIdHttpController_getAcronisDevice
     * @param string $id Path parameter from the upstream spec.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function getAcronisDevice(string $id): array|null
    {
        return $this->httpGet($this->expand('/v1/acronis/devices/{id}', ['id' => $id]));
    }

    /**
     * Get acronis policies
     *
     * @synaxon-endpoint GET /v1/acronis/policies
     * @synaxon-operation-id FindAcronisPoliciesHttpController_listAcronisPolicies
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function listAcronisPolicies(array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/acronis/policies'), $query);
    }

    /**
     * Get acronis policy by id
     *
     * @synaxon-endpoint GET /v1/acronis/policies/{id}
     * @synaxon-operation-id FindAcronisPolicyByIdHttpController_getAcronisPolicy
     * @param string $id Path parameter from the upstream spec.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function getAcronisPolicy(string $id): array|null
    {
        return $this->httpGet($this->expand('/v1/acronis/policies/{id}', ['id' => $id]));
    }
}
