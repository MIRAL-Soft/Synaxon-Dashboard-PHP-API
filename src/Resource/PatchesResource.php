<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Resource;

/**
 * Patches resource — wraps all /v1/patches/* endpoints.
 *
 * This class is generated from the OpenAPI specification. Method names follow
 * REST conventions where the endpoint shape permits; otherwise the suffix of
 * the upstream operationId is used to preserve semantic meaning.
 */
class PatchesResource extends AbstractResource
{
    /**
     * Get patches
     *
     * @synaxon-endpoint GET /v1/patches
     * @synaxon-operation-id FindPatchesHttpController_listPatches
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function list(array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/patches'), $query);
    }

    /**
     * Deploy patches
     *
     * @synaxon-endpoint POST /v1/patches/deploy
     * @synaxon-operation-id DeployPatchesHttpController_deployPatches
     * @param array<string, mixed>|null $body Request body.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function deployPatches(?array $body = null): array|null
    {
        return $this->httpPost($this->expand('/v1/patches/deploy'), $body);
    }
}
