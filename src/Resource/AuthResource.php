<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Resource;

/**
 * Auth resource: wraps all /v1/auth/* endpoints.
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
     * @synaxon-operation-id EgisAuthFlowHttpController_auth
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
     * @synaxon-operation-id EgisAuthFlowHttpController_callback
     * @param string $scope Declared as a path parameter upstream, sent as a query parameter.
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function callback(string $scope, array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/auth/egis/callback'), ['scope' => $scope] + $query);
    }

    /**
     * Invokes authorization flow and redirects user to EGIS UK
     *
     * @synaxon-endpoint GET /v1/auth/egis-gb
     * @synaxon-operation-id EgisGbAuthFlowHttpController_authGb
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function authGb(array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/auth/egis-gb'), $query);
    }

    /**
     * EGIS UK authorization callback
     *
     * @synaxon-endpoint GET /v1/auth/egis-gb/callback
     * @synaxon-operation-id EgisGbAuthFlowHttpController_callbackGb
     * @param string $scope Declared as a path parameter upstream, sent as a query parameter.
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function callbackGb(string $scope, array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/auth/egis-gb/callback'), ['scope' => $scope] + $query);
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
     * Create API session
     *
     * @synaxon-endpoint POST /v1/auth/token
     * @synaxon-operation-id CreateApiSessionHttpController_createApiSession
     * @param array<string, mixed>|null $body Request body.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function createApiSession(?array $body = null): array|null
    {
        return $this->httpPost($this->expand('/v1/auth/token'), $body, [], 'form');
    }

    /**
     * Create API session (GB)
     *
     * @synaxon-endpoint POST /v1/auth/token-gb
     * @synaxon-operation-id CreateApiSessionGbHttpController_createApiSessionGb
     * @param array<string, mixed>|null $body Request body.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function createApiSessionGb(?array $body = null): array|null
    {
        return $this->httpPost($this->expand('/v1/auth/token-gb'), $body, [], 'form');
    }

    /**
     * Refresh authentication using refresh token
     *
     * @synaxon-endpoint POST /v1/auth/refresh
     * @synaxon-operation-id RefreshAuthTokenHttpController_refresh
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
     * @synaxon-operation-id DeleteAuthTokenHttpController_logout
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function logout(): array|null
    {
        return $this->httpDelete($this->expand('/v1/auth'));
    }

    /**
     * List API tokens
     *
     * @synaxon-endpoint GET /v1/auth/api-tokens
     * @synaxon-operation-id FindApiTokensHttpController_listApiTokens
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function listApiTokens(array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/auth/api-tokens'), $query);
    }

    /**
     * Create API token
     *
     * @synaxon-endpoint POST /v1/auth/api-tokens
     * @synaxon-operation-id CreateApiTokenHttpController_createApiToken
     * @param array<string, mixed>|null $body Request body.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function createApiToken(?array $body = null): array|null
    {
        return $this->httpPost($this->expand('/v1/auth/api-tokens'), $body);
    }

    /**
     * Revoke API token
     *
     * @synaxon-endpoint POST /v1/auth/api-tokens/{id}/revoke
     * @synaxon-operation-id RevokeApiTokenHttpController_revokeApiToken
     * @param string $id Path parameter from the upstream spec.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function revokeApiToken(string $id): array|null
    {
        return $this->httpPost($this->expand('/v1/auth/api-tokens/{id}/revoke', ['id' => $id]), null);
    }
}
