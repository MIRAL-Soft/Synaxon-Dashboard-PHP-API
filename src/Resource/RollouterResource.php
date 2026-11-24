<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Resource;

/**
 * Rollouter resource: wraps all /v1/rollouter/* endpoints.
 *
 * This class is generated from the OpenAPI specification. Method names follow
 * REST conventions where the endpoint shape permits; otherwise the suffix of
 * the upstream operationId is used to preserve semantic meaning.
 */
class RollouterResource extends AbstractResource
{
    /**
     * List Rollouter customers
     *
     * @synaxon-endpoint GET /v1/rollouter/customers
     * @synaxon-operation-id FindRollouterCustomersHttpController_listRollouterCustomers
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function listRollouterCustomers(array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/rollouter/customers'), $query);
    }

    /**
     * Create a Rollouter rollout for a customer
     *
     * @synaxon-endpoint POST /v1/rollouter/customers
     * @synaxon-operation-id CreateRollouterCustomerHttpController_createRollouterCustomer
     * @param array<string, mixed>|null $body Request body.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function createRollouterCustomer(?array $body = null): array|null
    {
        return $this->httpPost($this->expand('/v1/rollouter/customers'), $body);
    }

    /**
     * Get Rollouter customer by id
     *
     * @synaxon-endpoint GET /v1/rollouter/customers/{id}
     * @synaxon-operation-id FindRollouterCustomerByIdHttpController_getRollouterCustomer
     * @param string $id Path parameter from the upstream spec.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function getRollouterCustomer(string $id): array|null
    {
        return $this->httpGet($this->expand('/v1/rollouter/customers/{id}', ['id' => $id]));
    }

    /**
     * Update the local Rollouter customer reference
     *
     * @synaxon-endpoint PATCH /v1/rollouter/customers/{id}
     * @synaxon-operation-id CreateRollouterCustomerHttpController_updateRollouterCustomer
     * @param string $id Path parameter from the upstream spec.
     * @param array<string, mixed>|null $body Request body.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function updateRollouterCustomer(string $id, ?array $body = null): array|null
    {
        return $this->httpPatch($this->expand('/v1/rollouter/customers/{id}', ['id' => $id]), $body);
    }
}
