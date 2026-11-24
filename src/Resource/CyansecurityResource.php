<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Resource;

/**
 * Cyansecurity resource: wraps all /v1/cyansecurity/* endpoints.
 *
 * This class is generated from the OpenAPI specification. Method names follow
 * REST conventions where the endpoint shape permits; otherwise the suffix of
 * the upstream operationId is used to preserve semantic meaning.
 */
class CyansecurityResource extends AbstractResource
{
    /**
     * List CyanSecurity customers for the current tenant
     *
     * @synaxon-endpoint GET /v1/cyansecurity/customers
     * @synaxon-operation-id FindCyanSecurityCustomersHttpController_listCustomers
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function listCustomers(array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/cyansecurity/customers'), $query);
    }

    /**
     * Create a CyanSecurity company customer
     *
     * @synaxon-endpoint POST /v1/cyansecurity/customers
     * @synaxon-operation-id CreateCyanSecurityCustomerHttpController_createCustomer
     * @param array<string, mixed>|null $body Request body.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function createCustomer(?array $body = null): array|null
    {
        return $this->httpPost($this->expand('/v1/cyansecurity/customers'), $body);
    }

    /**
     * Get CyanSecurity customer by id
     *
     * @synaxon-endpoint GET /v1/cyansecurity/customers/{id}
     * @synaxon-operation-id FindCyanSecurityCustomerByIdHttpController_getCustomer
     * @param string $id Path parameter from the upstream spec.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function getCustomer(string $id): array|null
    {
        return $this->httpGet($this->expand('/v1/cyansecurity/customers/{id}', ['id' => $id]));
    }
}
