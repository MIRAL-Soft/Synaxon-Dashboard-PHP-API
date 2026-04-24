<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Resource;

/**
 * Users resource — wraps all /v1/users/* endpoints.
 *
 * This class is generated from the OpenAPI specification. Method names follow
 * REST conventions where the endpoint shape permits; otherwise the suffix of
 * the upstream operationId is used to preserve semantic meaning.
 */
class UsersResource extends AbstractResource
{
    /**
     * Updates user
     *
     * @synaxon-endpoint PATCH /v1/users/{id}
     * @synaxon-operation-id UpdateUserHttpController_updateUser
     * @param string $id Path parameter from the upstream spec.
     * @param array<string, mixed>|null $body Request body.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function update(string $id, ?array $body = null): array|null
    {
        return $this->httpPatch($this->expand('/v1/users/{id}', ['id' => $id]), $body);
    }

    /**
     * Get pending terms
     *
     * @synaxon-endpoint GET /v1/users/terms/pending
     * @synaxon-operation-id FindPendingTermsHttpController_listPendingTerms
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function listPendingTerms(): array|null
    {
        return $this->httpGet($this->expand('/v1/users/terms/pending'));
    }

    /**
     * Accept providing terms
     *
     * @synaxon-endpoint POST /v1/users/terms/accept
     * @synaxon-operation-id AcceptTermHttpController_acceptTerms
     * @param array<string, mixed>|null $body Request body.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function acceptTerms(?array $body = null): array|null
    {
        return $this->httpPost($this->expand('/v1/users/terms/accept'), $body);
    }
}
