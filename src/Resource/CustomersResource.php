<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Resource;

/**
 * Customers resource — wraps all /v1/customers/* endpoints.
 *
 * This class is generated from the OpenAPI specification. Method names follow
 * REST conventions where the endpoint shape permits; otherwise the suffix of
 * the upstream operationId is used to preserve semantic meaning.
 */
class CustomersResource extends AbstractResource
{
    /**
     * Get customers
     *
     * @synaxon-endpoint GET /v1/customers
     * @synaxon-operation-id FindCustomersHttpController_listCustomers
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function list(array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/customers'), $query);
    }

    /**
     * Create new customer
     *
     * @synaxon-endpoint POST /v1/customers
     * @synaxon-operation-id CreateCustomerHttpController_createCustomer
     * @param array<string, mixed>|null $body Request body.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function create(?array $body = null): array|null
    {
        return $this->httpPost($this->expand('/v1/customers'), $body);
    }

    /**
     * Get customer suggestion by input
     *
     * @synaxon-endpoint GET /v1/customers/suggestion
     * @synaxon-operation-id GetCustomerSuggestionHttpController_getCustomerSuggestion
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function getCustomerSuggestion(array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/customers/suggestion'), $query);
    }

    /**
     * Get customer
     *
     * @synaxon-endpoint GET /v1/customers/{id}
     * @synaxon-operation-id FindCustomerByIdHttpController_getCustomer
     * @param string $id Path parameter from the upstream spec.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function find(string $id): array|null
    {
        return $this->httpGet($this->expand('/v1/customers/{id}', ['id' => $id]));
    }

    /**
     * Update customer
     *
     * @synaxon-endpoint PATCH /v1/customers/{id}
     * @synaxon-operation-id UpdateCustomerHttpController_updateCustomer
     * @param string $id Path parameter from the upstream spec.
     * @param array<string, mixed>|null $body Request body.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function update(string $id, ?array $body = null): array|null
    {
        return $this->httpPatch($this->expand('/v1/customers/{id}', ['id' => $id]), $body);
    }

    /**
     * Delete customer
     *
     * @synaxon-endpoint DELETE /v1/customers/{id}
     * @synaxon-operation-id DeleteCustomerHttpController_removeCustomer
     * @param string $id Path parameter from the upstream spec.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function delete(string $id): array|null
    {
        return $this->httpDelete($this->expand('/v1/customers/{id}', ['id' => $id]));
    }

    /**
     * Get service references
     *
     * @synaxon-endpoint GET /v1/customers/{id}/references
     * @synaxon-operation-id FindCustomerReferencesHttpController_listReferences
     * @param string $id Path parameter from the upstream spec.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function listReferences(string $id): array|null
    {
        return $this->httpGet($this->expand('/v1/customers/{id}/references', ['id' => $id]));
    }

    /**
     * Create new service reference
     *
     * @synaxon-endpoint POST /v1/customers/{id}/references
     * @synaxon-operation-id CreateCustomerReferenceHttpController_createCustomerReference
     * @param string $id Path parameter from the upstream spec.
     * @param array<string, mixed>|null $body Request body.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function createCustomerReference(string $id, ?array $body = null): array|null
    {
        return $this->httpPost($this->expand('/v1/customers/{id}/references', ['id' => $id]), $body);
    }

    /**
     * Delete service reference
     *
     * @synaxon-endpoint DELETE /v1/customers/{id}/references/{refId}
     * @synaxon-operation-id DeleteCustomerReferenceHttpController_removeCustomerReference
     * @param string $id Path parameter from the upstream spec.
     * @param string $refId Path parameter from the upstream spec.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function removeCustomerReference(string $id, string $refId): array|null
    {
        return $this->httpDelete($this->expand('/v1/customers/{id}/references/{refId}', ['id' => $id, 'refId' => $refId]));
    }

    /**
     * Create customer report setting
     *
     * @synaxon-endpoint POST /v1/customers/{id}/report
     * @synaxon-operation-id CreateCustomerReportSettingHttpController_createCustomerReportSetting
     * @param string $id Path parameter from the upstream spec.
     * @param array<string, mixed>|null $body Request body.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function createCustomerReportSetting(string $id, ?array $body = null): array|null
    {
        return $this->httpPost($this->expand('/v1/customers/{id}/report', ['id' => $id]), $body);
    }

    /**
     * Update customer report setting
     *
     * @synaxon-endpoint PATCH /v1/customers/{id}/report
     * @synaxon-operation-id UpdateCustomerReportSettingHttpController_updateCustomerReportSetting
     * @param string $id Path parameter from the upstream spec.
     * @param array<string, mixed>|null $body Request body.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function updateCustomerReportSetting(string $id, ?array $body = null): array|null
    {
        return $this->httpPatch($this->expand('/v1/customers/{id}/report', ['id' => $id]), $body);
    }

    /**
     * Delete customer report setting
     *
     * @synaxon-endpoint DELETE /v1/customers/{id}/report
     * @synaxon-operation-id DeleteCustomerReportSettingHttpController_removeCustomerReportSetting
     * @param string $id Path parameter from the upstream spec.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function removeCustomerReportSetting(string $id): array|null
    {
        return $this->httpDelete($this->expand('/v1/customers/{id}/report', ['id' => $id]));
    }

    /**
     * Get customer report setting
     *
     * @synaxon-endpoint GET /v1/customers/{customerId}/report
     * @synaxon-operation-id FindCustomerReportSettingHttpController_getCustomerReportSetting
     * @param string $customerId Path parameter from the upstream spec.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function getCustomerReportSetting(string $customerId): array|null
    {
        return $this->httpGet($this->expand('/v1/customers/{customerId}/report', ['customerId' => $customerId]));
    }

    /**
     * Generate customer report PDF
     *
     * @synaxon-endpoint GET /v1/customers/{id}/report/pdf
     * @synaxon-operation-id GenerateReportHttpController_generateCustomerReport
     * @param string $id Path parameter from the upstream spec.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function generateCustomerReport(string $id): array|null
    {
        return $this->httpGet($this->expand('/v1/customers/{id}/report/pdf', ['id' => $id]));
    }
}
