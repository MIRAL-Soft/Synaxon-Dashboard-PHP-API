<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Resource;

/**
 * Lywand resource — wraps all /v1/lywand/* endpoints.
 *
 * This class is generated from the OpenAPI specification. Method names follow
 * REST conventions where the endpoint shape permits; otherwise the suffix of
 * the upstream operationId is used to preserve semantic meaning.
 */
class LywandResource extends AbstractResource
{
    /**
     * Get lywand partner from context
     *
     * @synaxon-endpoint GET /v1/lywand/partners/fromContext
     * @synaxon-operation-id GetLywandPartnerFromContextHttpController_getLywandPartnerFromContext
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function getLywandPartnerFromContext(): array|null
    {
        return $this->httpGet($this->expand('/v1/lywand/partners/fromContext'));
    }

    /**
     * Get Lywand partner metrics with comparison — Retrieves current real-time metrics for a partner and
     * compares them with the most recent historical metric. Optionally specify a date to compare against a
     * specific historical point.
     *
     * @synaxon-endpoint GET /v1/lywand/partners/{id}/metrics
     * @synaxon-operation-id GetLywandPartnerMetricsHttpController_getLywandPartnerMetrics
     * @param string $id Path parameter from the upstream spec.
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function getLywandPartnerMetrics(string $id, array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/lywand/partners/{id}/metrics', ['id' => $id]), $query);
    }

    /**
     * Index lywand partners
     *
     * @synaxon-endpoint POST /v1/lywand/partners/{id}/index
     * @synaxon-operation-id IndexLywandPartnerHttpController_indexLywandPartner
     * @param string $id Path parameter from the upstream spec.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function indexLywandPartner(string $id): array|null
    {
        return $this->httpPost($this->expand('/v1/lywand/partners/{id}/index', ['id' => $id]), null);
    }

    /**
     * Get lywand customers
     *
     * @synaxon-endpoint GET /v1/lywand/customers
     * @synaxon-operation-id FindLywandCustomersHttpController_listLywandCustomers
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function listLywandCustomers(array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/lywand/customers'), $query);
    }

    /**
     * Create new lywand customer
     *
     * @synaxon-endpoint POST /v1/lywand/customers
     * @synaxon-operation-id CreateLywandCustomerHttpController_createLywandCustomer
     * @param array<string, mixed>|null $body Request body.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function createLywandCustomer(?array $body = null): array|null
    {
        return $this->httpPost($this->expand('/v1/lywand/customers'), $body);
    }

    /**
     * Get lywand customer by id
     *
     * @synaxon-endpoint GET /v1/lywand/customers/{id}
     * @synaxon-operation-id FindLywandCustomerHttpController_getLywandCustomer
     * @param string $id Path parameter from the upstream spec.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function getLywandCustomer(string $id): array|null
    {
        return $this->httpGet($this->expand('/v1/lywand/customers/{id}', ['id' => $id]));
    }

    /**
     * Update lywand customer by id
     *
     * @synaxon-endpoint PATCH /v1/lywand/customers/{id}
     * @synaxon-operation-id UpdateLywandCustomerHttpController_updateLywandCustomer
     * @param string $id Path parameter from the upstream spec.
     * @param array<string, mixed>|null $body Request body.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function updateLywandCustomer(string $id, ?array $body = null): array|null
    {
        return $this->httpPatch($this->expand('/v1/lywand/customers/{id}', ['id' => $id]), $body);
    }

    /**
     * Delete lywand customer
     *
     * @synaxon-endpoint DELETE /v1/lywand/customers/{id}
     * @synaxon-operation-id DeleteLywandCustomerHttpController_removeLywandCustomer
     * @param string $id Path parameter from the upstream spec.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function removeLywandCustomer(string $id): array|null
    {
        return $this->httpDelete($this->expand('/v1/lywand/customers/{id}', ['id' => $id]));
    }

    /**
     * Get Lywand customer metrics with comparison — Retrieves current real-time metrics for a customer
     * and compares them with the most recent historical metric. Optionally specify a date to compare
     * against a specific historical point.
     *
     * @synaxon-endpoint GET /v1/lywand/customers/{id}/metrics
     * @synaxon-operation-id GetLywandCustomerMetricsHttpController_getLywandCustomerMetrics
     * @param string $id Path parameter from the upstream spec.
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function getLywandCustomerMetrics(string $id, array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/lywand/customers/{id}/metrics', ['id' => $id]), $query);
    }

    /**
     * Get installation token for lywand customer
     *
     * @synaxon-endpoint GET /v1/lywand/customers/{id}/token
     * @synaxon-operation-id GetLywandCustomerInstallationTokenHttpController_getLywandInstallationToken
     * @param string $id Path parameter from the upstream spec.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function getLywandInstallationToken(string $id): array|null
    {
        return $this->httpGet($this->expand('/v1/lywand/customers/{id}/token', ['id' => $id]));
    }

    /**
     * Index lywand customer
     *
     * @synaxon-endpoint POST /v1/lywand/customers/{id}/index
     * @synaxon-operation-id IndexLywandCustomerHttpController_indexLywandCustomer
     * @param string $id Path parameter from the upstream spec.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function indexLywandCustomer(string $id): array|null
    {
        return $this->httpPost($this->expand('/v1/lywand/customers/{id}/index', ['id' => $id]), null);
    }

    /**
     * Index lywand customer targets
     *
     * @synaxon-endpoint POST /v1/lywand/customers/{id}/targets/index
     * @synaxon-operation-id IndexLywandTargetsHttpController_indexLywandCustomerTargets
     * @param string $id Path parameter from the upstream spec.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function indexLywandCustomerTargets(string $id): array|null
    {
        return $this->httpPost($this->expand('/v1/lywand/customers/{id}/targets/index', ['id' => $id]), null);
    }

    /**
     * Index lywand customer vulnerabilities
     *
     * @synaxon-endpoint POST /v1/lywand/customers/{id}/vulnerabilities/index
     * @synaxon-operation-id IndexLywandVulnerabilitiesHttpController_indexLywandCustomerVulnerabilities
     * @param string $id Path parameter from the upstream spec.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function indexLywandCustomerVulnerabilities(string $id): array|null
    {
        return $this->httpPost($this->expand('/v1/lywand/customers/{id}/vulnerabilities/index', ['id' => $id]), null);
    }

    /**
     * Get all lywand targets
     *
     * @synaxon-endpoint GET /v1/lywand/targets
     * @synaxon-operation-id FindLywandTargetsHttpController_listLywandTargets
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function listLywandTargets(array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/lywand/targets'), $query);
    }

    /**
     * Get lywand target by id
     *
     * @synaxon-endpoint GET /v1/lywand/targets/{id}
     * @synaxon-operation-id FindLywandTargetByIdHttpController_getLywandTarget
     * @param string $id Path parameter from the upstream spec.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function getLywandTarget(string $id): array|null
    {
        return $this->httpGet($this->expand('/v1/lywand/targets/{id}', ['id' => $id]));
    }

    /**
     * Get all lywand vulnerabilities with optional customer ID filtering
     *
     * @synaxon-endpoint GET /v1/lywand/vulnerabilities
     * @synaxon-operation-id FindLywandVulnerabilitiesHttpController_getLywandVulnerabilities
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function getLywandVulnerabilities(array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/lywand/vulnerabilities'), $query);
    }
}
