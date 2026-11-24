<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Resource;

/**
 * Smao resource: wraps all /v1/smao/* endpoints.
 *
 * This class is generated from the OpenAPI specification. Method names follow
 * REST conventions where the endpoint shape permits; otherwise the suffix of
 * the upstream operationId is used to preserve semantic meaning.
 */
class SmaoResource extends AbstractResource
{
    /**
     * Get SMAO customers
     *
     * @synaxon-endpoint GET /v1/smao/customers
     * @synaxon-operation-id FindSmaoCustomersHttpController_listSmaoCustomers
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function listSmaoCustomers(array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/smao/customers'), $query);
    }

    /**
     * Create new SMAO customer
     *
     * @synaxon-endpoint POST /v1/smao/customers
     * @synaxon-operation-id CreateSmaoCustomerHttpController_createSmaoCustomer
     * @param array<string, mixed>|null $body Request body.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function createSmaoCustomer(?array $body = null): array|null
    {
        return $this->httpPost($this->expand('/v1/smao/customers'), $body);
    }

    /**
     * Get SMAO customer by id
     *
     * @synaxon-endpoint GET /v1/smao/customers/{id}
     * @synaxon-operation-id FindSmaoCustomerHttpController_getSmaoCustomer
     * @param string $id Path parameter from the upstream spec.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function getSmaoCustomer(string $id): array|null
    {
        return $this->httpGet($this->expand('/v1/smao/customers/{id}', ['id' => $id]));
    }

    /**
     * Update SMAO customer
     *
     * @synaxon-endpoint PATCH /v1/smao/customers/{id}
     * @synaxon-operation-id UpdateSmaoCustomerHttpController_updateSmaoCustomer
     * @param string $id Path parameter from the upstream spec.
     * @param array<string, mixed>|null $body Request body.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function updateSmaoCustomer(string $id, ?array $body = null): array|null
    {
        return $this->httpPatch($this->expand('/v1/smao/customers/{id}', ['id' => $id]), $body);
    }
}
