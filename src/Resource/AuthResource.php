<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Resource;

/**
 * Auth resource — wraps all /v1/auth/* endpoints.
 *
 * This class is generated from the OpenAPI specification. Method names follow
 * REST conventions where the endpoint shape permits; otherwise the suffix of
 * the upstream operationId is used to preserve semantic meaning.
 */
class AuthResource extends AbstractResource
{
    /**
     * Invokes authorization flow and redirects user to EGIS
     *
     * @synaxon-endpoint GET /v1/auth/egis
     * @synaxon-operation-id EgisAuthHttpController_auth
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function auth(array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/auth/egis'), $query);
    }

    /**
     * EGIS authorization callback
     *
     * @synaxon-endpoint GET /v1/auth/egis/callback
     * @synaxon-operation-id EgisAuthHttpController_callback
     * @param string $scope Path parameter from the upstream spec.
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function callback(string $scope, array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/auth/egis/callback', ['scope' => $scope]), $query);
    }

    /**
     * Get current user
     *
     * @synaxon-endpoint GET /v1/auth/me
     * @synaxon-operation-id WhoAmIHttpController_whoAmI
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function whoAmI(): array|null
    {
        return $this->httpGet($this->expand('/v1/auth/me'));
    }

    /**
     * Get API token
     *
     * @synaxon-endpoint POST /v1/auth/token
     * @synaxon-operation-id CreateApiTokenHttpController_getApiToken
     * @param array<string, mixed>|null $body Request body.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function getApiToken(?array $body = null): array|null
    {
        return $this->httpPost($this->expand('/v1/auth/token'), $body);
    }

    /**
     * Refresh authentication using refresh token
     *
     * @synaxon-endpoint POST /v1/auth/refresh
     * @synaxon-operation-id RefreshTokenHttpController_refresh
     * @param array<string, mixed>|null $body Request body.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function refresh(?array $body = null): array|null
    {
        return $this->httpPost($this->expand('/v1/auth/refresh'), $body);
    }

    /**
     * Logout current session
     *
     * @synaxon-endpoint DELETE /v1/auth
     * @synaxon-operation-id DeleteTokenHttpController_logout
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function logout(): array|null
    {
        return $this->httpDelete($this->expand('/v1/auth'));
    }
}
