<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Resource;

/**
 * SystemTasks resource — wraps all /v1/system-tasks/* endpoints.
 *
 * This class is generated from the OpenAPI specification. Method names follow
 * REST conventions where the endpoint shape permits; otherwise the suffix of
 * the upstream operationId is used to preserve semantic meaning.
 */
class SystemTasksResource extends AbstractResource
{
    /**
     * Get system task by id
     *
     * @synaxon-endpoint GET /v1/system-tasks/{id}
     * @synaxon-operation-id FindSystemTaskByIdHttpController_getSystemTaskById
     * @param string $id Path parameter from the upstream spec.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function find(string $id): array|null
    {
        return $this->httpGet($this->expand('/v1/system-tasks/{id}', ['id' => $id]));
    }
}
