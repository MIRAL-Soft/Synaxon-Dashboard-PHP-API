<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Resource;

/**
 * Cove resource: wraps all /v1/cove/* endpoints.
 *
 * This class is generated from the OpenAPI specification. Method names follow
 * REST conventions where the endpoint shape permits; otherwise the suffix of
 * the upstream operationId is used to preserve semantic meaning.
 */
class CoveResource extends AbstractResource
{
    /**
     * List Cove customers
     *
     * @synaxon-endpoint GET /v1/cove/customers
     * @synaxon-operation-id FindCoveCustomersHttpController_listCoveCustomers
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function listCoveCustomers(array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/cove/customers'), $query);
    }

    /**
     * Create new Cove customer
     *
     * @synaxon-endpoint POST /v1/cove/customers
     * @synaxon-operation-id CreateCoveCustomerHttpController_createCoveCustomer
     * @param array<string, mixed>|null $body Request body.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function createCoveCustomer(?array $body = null): array|null
    {
        return $this->httpPost($this->expand('/v1/cove/customers'), $body);
    }

    /**
     * Get Cove customer by id
     *
     * @synaxon-endpoint GET /v1/cove/customers/{id}
     * @synaxon-operation-id FindCoveCustomerHttpController_getCoveCustomer
     * @param string $id Path parameter from the upstream spec.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function getCoveCustomer(string $id): array|null
    {
        return $this->httpGet($this->expand('/v1/cove/customers/{id}', ['id' => $id]));
    }

    /**
     * Update Cove customer
     *
     * @synaxon-endpoint PATCH /v1/cove/customers/{id}
     * @synaxon-operation-id UpdateCoveCustomerHttpController_updateCoveCustomer
     * @param string $id Path parameter from the upstream spec.
     * @param array<string, mixed>|null $body Request body.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function updateCoveCustomer(string $id, ?array $body = null): array|null
    {
        return $this->httpPatch($this->expand('/v1/cove/customers/{id}', ['id' => $id]), $body);
    }
}
