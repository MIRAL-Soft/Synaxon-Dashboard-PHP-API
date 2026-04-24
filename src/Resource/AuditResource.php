<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Resource;

/**
 * Audit resource — wraps all /v1/audit/* endpoints.
 *
 * This class is generated from the OpenAPI specification. Method names follow
 * REST conventions where the endpoint shape permits; otherwise the suffix of
 * the upstream operationId is used to preserve semantic meaning.
 */
class AuditResource extends AbstractResource
{
    /**
     * List audit logs
     *
     * @synaxon-endpoint GET /v1/audit/logs
     * @synaxon-operation-id FindAuditLogsHttpController_listAuditLogs
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function listAuditLogs(array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/audit/logs'), $query);
    }

    /**
     * Get audit log options — Returns all unique entity names for audit log filtering
     *
     * @synaxon-endpoint GET /v1/audit/logs/options
     * @synaxon-operation-id FindAuditLogOptionsHttpController_findAuditLogOptions
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function findAuditLogOptions(): array|null
    {
        return $this->httpGet($this->expand('/v1/audit/logs/options'));
    }
}
