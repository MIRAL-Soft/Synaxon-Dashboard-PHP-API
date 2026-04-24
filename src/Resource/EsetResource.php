<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Resource;

/**
 * Eset resource — wraps all /v1/eset/* endpoints.
 *
 * This class is generated from the OpenAPI specification. Method names follow
 * REST conventions where the endpoint shape permits; otherwise the suffix of
 * the upstream operationId is used to preserve semantic meaning.
 */
class EsetResource extends AbstractResource
{
    /**
     * List ESET partners
     *
     * @synaxon-endpoint GET /v1/eset/partners
     * @synaxon-operation-id FindEsetPartnersHttpController_listEsetPartners
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function listEsetPartners(array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/eset/partners'), $query);
    }

    /**
     * Create new ESET partner (managed MSP)
     *
     * @synaxon-endpoint POST /v1/eset/partners
     * @synaxon-operation-id CreateEsetPartnerHttpController_createEsetPartner
     * @param array<string, mixed>|null $body Request body.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function createEsetPartner(?array $body = null): array|null
    {
        return $this->httpPost($this->expand('/v1/eset/partners'), $body);
    }

    /**
     * Get eset partner from context
     *
     * @synaxon-endpoint GET /v1/eset/partners/fromContext
     * @synaxon-operation-id FindEsetPartnerFromContextHttpController_getEsetPartnerFromContext
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function getEsetPartnerFromContext(): array|null
    {
        return $this->httpGet($this->expand('/v1/eset/partners/fromContext'));
    }

    /**
     * Get ESET partner metrics with comparison — Retrieves current real-time metrics for an ESET partner
     * (aggregated across all customers) and compares them with the most recent historical metric.
     * Optionally specify a date to compare against a specific historical point.
     *
     * @synaxon-endpoint GET /v1/eset/partners/{id}/metrics
     * @synaxon-operation-id GetEsetPartnerMetricsHttpController_getEsetPartnerMetrics
     * @param string $id Path parameter from the upstream spec.
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function getEsetPartnerMetrics(string $id, array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/eset/partners/{id}/metrics', ['id' => $id]), $query);
    }

    /**
     * List ESET customers
     *
     * @synaxon-endpoint GET /v1/eset/customers
     * @synaxon-operation-id FindEsetCustomersHttpController_listEsetCustomers
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function listEsetCustomers(array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/eset/customers'), $query);
    }

    /**
     * Create new ESET customer
     *
     * @synaxon-endpoint POST /v1/eset/customers
     * @synaxon-operation-id CreateEsetCustomerHttpController_createEsetCustomer
     * @param array<string, mixed>|null $body Request body.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function createEsetCustomer(?array $body = null): array|null
    {
        return $this->httpPost($this->expand('/v1/eset/customers'), $body);
    }

    /**
     * Get ESET customer by id
     *
     * @synaxon-endpoint GET /v1/eset/customers/{id}
     * @synaxon-operation-id FindEsetCustomerByIdHttpController_getEsetCustomer
     * @param string $id Path parameter from the upstream spec.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function getEsetCustomer(string $id): array|null
    {
        return $this->httpGet($this->expand('/v1/eset/customers/{id}', ['id' => $id]));
    }

    /**
     * Update ESET customer by id
     *
     * @synaxon-endpoint PATCH /v1/eset/customers/{id}
     * @synaxon-operation-id UpdateEsetCustomerHttpController_updateEsetCustomer
     * @param string $id Path parameter from the upstream spec.
     * @param array<string, mixed>|null $body Request body.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function updateEsetCustomer(string $id, ?array $body = null): array|null
    {
        return $this->httpPatch($this->expand('/v1/eset/customers/{id}', ['id' => $id]), $body);
    }

    /**
     * Get ESET customer metrics with comparison — Retrieves current real-time metrics for a customer and
     * compares them with the most recent historical metric. Optionally specify a date to compare against a
     * specific historical point.
     *
     * @synaxon-endpoint GET /v1/eset/customers/{id}/metrics
     * @synaxon-operation-id GetEsetCustomerMetricsHttpController_getEsetCustomerMetrics
     * @param string $id Path parameter from the upstream spec.
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function getEsetCustomerMetrics(string $id, array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/eset/customers/{id}/metrics', ['id' => $id]), $query);
    }

    /**
     * List ESET customers
     *
     * @synaxon-endpoint GET /v1/eset/licenses
     * @synaxon-operation-id FindEsetLicensesHttpController_listEsetLicenses
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function listEsetLicenses(array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/eset/licenses'), $query);
    }

    /**
     * Create ESET license for a customer
     *
     * @synaxon-endpoint POST /v1/eset/licenses
     * @synaxon-operation-id CreateEsetLicenseHttpController_createEsetLicense
     * @param array<string, mixed>|null $body Request body.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function createEsetLicense(?array $body = null): array|null
    {
        return $this->httpPost($this->expand('/v1/eset/licenses'), $body);
    }

    /**
     * Get ESET license by id
     *
     * @synaxon-endpoint GET /v1/eset/licenses/{id}
     * @synaxon-operation-id FindEsetLicenseByIdHttpController_getEsetLicense
     * @param string $id Path parameter from the upstream spec.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function getEsetLicense(string $id): array|null
    {
        return $this->httpGet($this->expand('/v1/eset/licenses/{id}', ['id' => $id]));
    }

    /**
     * Update ESET license by id
     *
     * @synaxon-endpoint PATCH /v1/eset/licenses/{id}
     * @synaxon-operation-id UpdateEsetLicenseHttpController_updateEsetLicense
     * @param string $id Path parameter from the upstream spec.
     * @param array<string, mixed>|null $body Request body.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function updateEsetLicense(string $id, ?array $body = null): array|null
    {
        return $this->httpPatch($this->expand('/v1/eset/licenses/{id}', ['id' => $id]), $body);
    }

    /**
     * List ESET devices
     *
     * @synaxon-endpoint GET /v1/eset/devices
     * @synaxon-operation-id FindEsetDevicesHttpController_listEsetDevices
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function listEsetDevices(array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/eset/devices'), $query);
    }

    /**
     * List ESET device problems
     *
     * @synaxon-endpoint GET /v1/eset/device-problems
     * @synaxon-operation-id FindEsetDeviceProblemsHttpController_listDeviceProblems
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function listDeviceProblems(array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/eset/device-problems'), $query);
    }
}
