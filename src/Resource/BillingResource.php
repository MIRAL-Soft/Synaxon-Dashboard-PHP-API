<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Resource;

/**
 * Billing resource: wraps all /v1/billing/* endpoints.
 *
 * This class is generated from the OpenAPI specification. Method names follow
 * REST conventions where the endpoint shape permits; otherwise the suffix of
 * the upstream operationId is used to preserve semantic meaning.
 */
class BillingResource extends AbstractResource
{
    /**
     * Retrieve all API keys of the partner No.
     *
     * @synaxon-endpoint GET /v1/billing/neumeier
     * @synaxon-operation-id FindNeumeierApiKeysByPartnerNoHttpController_listNeumeierApiKeys
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function listNeumeierApiKeys(): array|null
    {
        return $this->httpGet($this->expand('/v1/billing/neumeier'));
    }

    /**
     * Create new partner API key
     *
     * @synaxon-endpoint POST /v1/billing/neumeier
     * @synaxon-operation-id CreateNeumeierApiKeyHttpController_createNeumeierApiKey
     * @param array<string, mixed>|null $body Request body.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function createNeumeierApiKey(?array $body = null): array|null
    {
        return $this->httpPost($this->expand('/v1/billing/neumeier'), $body);
    }

    /**
     * Revokes a partner API key by its ID
     *
     * @synaxon-endpoint POST /v1/billing/neumeier/{id}/revoke
     * @synaxon-operation-id RevokeNeumeierApiKeyHttpController_revokeNeumeierApiKey
     * @param string $id Path parameter from the upstream spec.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function revokeNeumeierApiKey(string $id): array|null
    {
        return $this->httpPost($this->expand('/v1/billing/neumeier/{id}/revoke', ['id' => $id]), null);
    }
}
