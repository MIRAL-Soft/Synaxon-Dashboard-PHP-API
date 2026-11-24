<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Resource;

/**
 * Guardian360 resource: wraps all /v1/guardian360/* endpoints.
 *
 * This class is generated from the OpenAPI specification. Method names follow
 * REST conventions where the endpoint shape permits; otherwise the suffix of
 * the upstream operationId is used to preserve semantic meaning.
 */
class Guardian360Resource extends AbstractResource
{
    /**
     * List Guardian360 customers
     *
     * @synaxon-endpoint GET /v1/guardian360/customers
     * @synaxon-operation-id FindGuardian360CustomersHttpController_listGuardian360Customers
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function listGuardian360Customers(array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/guardian360/customers'), $query);
    }

    /**
     * Create a Guardian360 customer
     *
     * @synaxon-endpoint POST /v1/guardian360/customers
     * @synaxon-operation-id CreateGuardian360CustomerHttpController_createGuardian360Customer
     * @param array<string, mixed>|null $body Request body.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function createGuardian360Customer(?array $body = null): array|null
    {
        return $this->httpPost($this->expand('/v1/guardian360/customers'), $body);
    }

    /**
     * Get Guardian360 customer by id
     *
     * @synaxon-endpoint GET /v1/guardian360/customers/{id}
     * @synaxon-operation-id FindGuardian360CustomerHttpController_getGuardian360Customer
     * @param string $id Path parameter from the upstream spec.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function getGuardian360Customer(string $id): array|null
    {
        return $this->httpGet($this->expand('/v1/guardian360/customers/{id}', ['id' => $id]));
    }

    /**
     * Update a Guardian360 customer
     *
     * @synaxon-endpoint PATCH /v1/guardian360/customers/{id}
     * @synaxon-operation-id UpdateGuardian360CustomerHttpController_updateGuardian360Customer
     * @param string $id Path parameter from the upstream spec.
     * @param array<string, mixed>|null $body Request body.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function updateGuardian360Customer(string $id, ?array $body = null): array|null
    {
        return $this->httpPatch($this->expand('/v1/guardian360/customers/{id}', ['id' => $id]), $body);
    }
}
