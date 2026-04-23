<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Resource;

/**
 * SecAuditor resource — wraps all /v1/sec-auditor/* endpoints.
 *
 * This class is generated from the OpenAPI specification. Method names follow
 * REST conventions where the endpoint shape permits; otherwise the suffix of
 * the upstream operationId is used to preserve semantic meaning.
 */
class SecAuditorResource extends AbstractResource
{
    /**
     * List SEC AUDITOR customers
     *
     * @synaxon-endpoint GET /v1/sec-auditor/customers
     * @synaxon-operation-id FindSecAuditorCustomersHttpController_listSecAuditorCustomers
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function listSecAuditorCustomers(array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/sec-auditor/customers'), $query);
    }

    /**
     * Create new SEC AUDITOR customer
     *
     * @synaxon-endpoint POST /v1/sec-auditor/customers
     * @synaxon-operation-id CreateSecAuditorCustomerHttpController_createSecAuditorCustomer
     * @param array<string, mixed>|null $body Request body.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function createSecAuditorCustomer(?array $body = null): array|null
    {
        return $this->httpPost($this->expand('/v1/sec-auditor/customers'), $body);
    }

    /**
     * Get SEC AUDITOR customer by id
     *
     * @synaxon-endpoint GET /v1/sec-auditor/customers/{id}
     * @synaxon-operation-id FindSecAuditorCustomerHttpController_getSecAuditorCustomer
     * @param string $id Path parameter from the upstream spec.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function getSecAuditorCustomer(string $id): array|null
    {
        return $this->httpGet($this->expand('/v1/sec-auditor/customers/{id}', ['id' => $id]));
    }

    /**
     * Update SEC AUDITOR customer
     *
     * @synaxon-endpoint PATCH /v1/sec-auditor/customers/{id}
     * @synaxon-operation-id UpdateSecAuditorCustomerHttpController_updateSecAuditorCustomer
     * @param string $id Path parameter from the upstream spec.
     * @param array<string, mixed>|null $body Request body.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function updateSecAuditorCustomer(string $id, ?array $body = null): array|null
    {
        return $this->httpPatch($this->expand('/v1/sec-auditor/customers/{id}', ['id' => $id]), $body);
    }

    /**
     * Create SEC AUDITOR customer installer
     *
     * @synaxon-endpoint GET /v1/sec-auditor/customers/{id}/installer
     * @synaxon-operation-id CreateSecAuditorInstallerHttpController_createSecAuditorInstaller
     * @param string $id Path parameter from the upstream spec.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function createSecAuditorInstaller(string $id): array|null
    {
        return $this->httpGet($this->expand('/v1/sec-auditor/customers/{id}/installer', ['id' => $id]));
    }
}
