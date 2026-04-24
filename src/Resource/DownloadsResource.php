<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Resource;

/**
 * Downloads resource — wraps all /v1/downloads/* endpoints.
 *
 * This class is generated from the OpenAPI specification. Method names follow
 * REST conventions where the endpoint shape permits; otherwise the suffix of
 * the upstream operationId is used to preserve semantic meaning.
 */
class DownloadsResource extends AbstractResource
{
    /**
     * Find download files by tenant
     *
     * @synaxon-endpoint GET /v1/downloads
     * @synaxon-operation-id FindDownloadFilesHttpController_listDownloads
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function list(array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/downloads'), $query);
    }

    /**
     * Get file by ID
     *
     * @synaxon-endpoint GET /v1/downloads/{id}
     * @synaxon-operation-id FindDownloadFileByIdHttpController_getDownload
     * @param string $id Path parameter from the upstream spec.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function find(string $id): array|null
    {
        return $this->httpGet($this->expand('/v1/downloads/{id}', ['id' => $id]));
    }

    /**
     * Get presigned URL or direct link for a download file
     *
     * @synaxon-endpoint GET /v1/downloads/{id}/url
     * @synaxon-operation-id GetDownloadFileUrlHttpController_getDownloadUrl
     * @param string $id Path parameter from the upstream spec.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function getDownloadUrl(string $id): array|null
    {
        return $this->httpGet($this->expand('/v1/downloads/{id}/url', ['id' => $id]));
    }
}
