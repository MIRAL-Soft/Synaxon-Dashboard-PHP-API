<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Resource;

/**
 * Cloudally resource: wraps all /v1/cloudally/* endpoints.
 *
 * This class is generated from the OpenAPI specification. Method names follow
 * REST conventions where the endpoint shape permits; otherwise the suffix of
 * the upstream operationId is used to preserve semantic meaning.
 */
class CloudallyResource extends AbstractResource
{
    /**
     * Get Cloudally customers
     *
     * @synaxon-endpoint GET /v1/cloudally/customers
     * @synaxon-operation-id FindCloudallyCustomersHttpController_listCloudallyCustomers
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function listCloudallyCustomers(array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/cloudally/customers'), $query);
    }

    /**
     * Create a Cloudally customer
     *
     * @synaxon-endpoint POST /v1/cloudally/customers
     * @synaxon-operation-id CreateCloudallyCustomerHttpController_createCloudallyCustomer
     * @param array<string, mixed>|null $body Request body.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function createCloudallyCustomer(?array $body = null): array|null
    {
        return $this->httpPost($this->expand('/v1/cloudally/customers'), $body);
    }

    /**
     * Get Cloudally customer by id
     *
     * @synaxon-endpoint GET /v1/cloudally/customers/{id}
     * @synaxon-operation-id FindCloudallyCustomerByIdHttpController_getCloudallyCustomer
     * @param string $id Path parameter from the upstream spec.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function getCloudallyCustomer(string $id): array|null
    {
        return $this->httpGet($this->expand('/v1/cloudally/customers/{id}', ['id' => $id]));
    }

    /**
     * Update cloudally customer by id
     *
     * @synaxon-endpoint PATCH /v1/cloudally/customers/{id}
     * @synaxon-operation-id UpdateCloudallyCustomerHttpController_updateCloudallyCustomer
     * @param string $id Path parameter from the upstream spec.
     * @param array<string, mixed>|null $body Request body.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function updateCloudallyCustomer(string $id, ?array $body = null): array|null
    {
        return $this->httpPatch($this->expand('/v1/cloudally/customers/{id}', ['id' => $id]), $body);
    }

    /**
     * Get Cloudally partner by id
     *
     * @synaxon-endpoint GET /v1/cloudally/partners/{id}
     * @synaxon-operation-id FindCloudallyPartnerByIdHttpController_getCloudallyPartner
     * @param string $id Path parameter from the upstream spec.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function getCloudallyPartner(string $id): array|null
    {
        return $this->httpGet($this->expand('/v1/cloudally/partners/{id}', ['id' => $id]));
    }

    /**
     * Get Cloudally partner from context
     *
     * @synaxon-endpoint GET /v1/cloudally/partners/fromContext
     * @synaxon-operation-id FindCloudallyPartnerFromContextHttpController_getCloudallyPartnerFromContext
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function getCloudallyPartnerFromContext(): array|null
    {
        return $this->httpGet($this->expand('/v1/cloudally/partners/fromContext'));
    }

    /**
     * Get Cloudally tasks
     *
     * @synaxon-endpoint GET /v1/cloudally/tasks
     * @synaxon-operation-id FindCloudallyTasksHttpController_listCloudallyTasks
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function listCloudallyTasks(array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/cloudally/tasks'), $query);
    }

    /**
     * Get Cloudally backup statuses
     *
     * @synaxon-endpoint GET /v1/cloudally/statuses
     * @synaxon-operation-id FindCloudallyStatusesHttpController_listCloudallyStatuses
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function listCloudallyStatuses(array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/cloudally/statuses'), $query);
    }

    /**
     * Get Cloudally report data
     *
     * @synaxon-endpoint GET /v1/cloudally/report/report-data
     * @synaxon-operation-id FindCloudallyReportDataHttpController_getCloudallyReportData
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function getCloudallyReportData(array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/cloudally/report/report-data'), $query);
    }

    /**
     * Get Cloudally partner metrics with comparison. Retrieves current real-time metrics for a partner and
     * compares them with the most recent historical metric. Optionally specify a date to compare against a
     * specific historical point.
     *
     * @synaxon-endpoint GET /v1/cloudally/partners/{id}/metrics
     * @synaxon-operation-id GetCloudallyPartnerMetricsHttpController_getCloudallyPartnerMetrics
     * @param string $id Path parameter from the upstream spec.
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function getCloudallyPartnerMetrics(string $id, array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/cloudally/partners/{id}/metrics', ['id' => $id]), $query);
    }

    /**
     * Get Cloudally customer metrics with comparison. Retrieves current real-time metrics for a customer
     * and compares them with the most recent historical metric. Optionally specify a date to compare
     * against a specific historical point.
     *
     * @synaxon-endpoint GET /v1/cloudally/customers/{id}/metrics
     * @synaxon-operation-id GetCloudallyCustomerMetricsHttpController_getCloudallyCustomerMetrics
     * @param string $id Path parameter from the upstream spec.
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function getCloudallyCustomerMetrics(string $id, array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/cloudally/customers/{id}/metrics', ['id' => $id]), $query);
    }
}
