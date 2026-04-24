<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Resource;

/**
 * Reports resource — wraps all /v1/reports/* endpoints.
 *
 * This class is generated from the OpenAPI specification. Method names follow
 * REST conventions where the endpoint shape permits; otherwise the suffix of
 * the upstream operationId is used to preserve semantic meaning.
 */
class ReportsResource extends AbstractResource
{
    /**
     * Get partner report setting
     *
     * @synaxon-endpoint GET /v1/reports/setting
     * @synaxon-operation-id FindPartnerReportSettingHttpController_getPartnerReportSetting
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function getPartnerReportSetting(): array|null
    {
        return $this->httpGet($this->expand('/v1/reports/setting'));
    }

    /**
     * Create partner report setting
     *
     * @synaxon-endpoint POST /v1/reports/setting
     * @synaxon-operation-id CreateReportSettingHttpController_createReportSetting
     * @param array<string, mixed>|null $body Request body.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function createReportSetting(?array $body = null): array|null
    {
        return $this->httpPost($this->expand('/v1/reports/setting'), $body);
    }

    /**
     * Update partner report setting
     *
     * @synaxon-endpoint PATCH /v1/reports/setting
     * @synaxon-operation-id UpdateReportSettingHttpController_updateReportSetting
     * @param array<string, mixed>|null $body Request body.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function updateReportSetting(?array $body = null): array|null
    {
        return $this->httpPatch($this->expand('/v1/reports/setting'), $body);
    }

    /**
     * Delete partner report setting
     *
     * @synaxon-endpoint DELETE /v1/reports/setting
     * @synaxon-operation-id DeleteReportSettingHttpController_removeReportSetting
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function removeReportSetting(): array|null
    {
        return $this->httpDelete($this->expand('/v1/reports/setting'));
    }

    /**
     * Generate partner report PDF
     *
     * @synaxon-endpoint GET /v1/reports/pdf
     * @synaxon-operation-id GenerateReportHttpController_generatePartnerReport
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function generatePartnerReport(): array|null
    {
        return $this->httpGet($this->expand('/v1/reports/pdf'));
    }
}
