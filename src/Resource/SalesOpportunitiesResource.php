<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Resource;

/**
 * SalesOpportunities resource — wraps all /v1/sales-opportunities/* endpoints.
 *
 * This class is generated from the OpenAPI specification. Method names follow
 * REST conventions where the endpoint shape permits; otherwise the suffix of
 * the upstream operationId is used to preserve semantic meaning.
 */
class SalesOpportunitiesResource extends AbstractResource
{
    /**
     * Get sales opportunities
     *
     * @synaxon-endpoint GET /v1/sales-opportunities
     * @synaxon-operation-id GetSalesOpportunitiesHttpController_listNsightSalesOpportunities
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function list(array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/sales-opportunities'), $query);
    }

    /**
     * Get sales opportunities
     *
     * @synaxon-endpoint GET /v1/sales-opportunities/csv
     * @synaxon-operation-id GetSalesOpportunitiesExportHttpController_exportNsightSalesOpportunitiesCSV
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function exportNsightSalesOpportunitiesCSV(array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/sales-opportunities/csv'), $query);
    }

    /**
     * Get sales opportunities
     *
     * @synaxon-endpoint GET /v1/sales-opportunities/pdf
     * @synaxon-operation-id GetSalesOpportunitiesExportHttpController_exportNsightSalesOpportunitiesPDF
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function exportNsightSalesOpportunitiesPDF(array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/sales-opportunities/pdf'), $query);
    }
}
