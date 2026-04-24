<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Resource;

/**
 * Support resource — wraps all /v1/support/* endpoints.
 *
 * This class is generated from the OpenAPI specification. Method names follow
 * REST conventions where the endpoint shape permits; otherwise the suffix of
 * the upstream operationId is used to preserve semantic meaning.
 */
class SupportResource extends AbstractResource
{
    /**
     * List support queries
     *
     * @synaxon-endpoint GET /v1/support/queries
     * @synaxon-operation-id FindSupportQueriesHttpController_listSupportQueries
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function listSupportQueries(array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/support/queries'), $query);
    }

    /**
     * Submit a query to the support chatbot
     *
     * @synaxon-endpoint POST /v1/support/queries
     * @synaxon-operation-id CreateSupportQueryHttpController_createSupportQuery
     * @param array<string, mixed>|null $body Request body.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function createSupportQuery(?array $body = null): array|null
    {
        return $this->httpPost($this->expand('/v1/support/queries'), $body);
    }

    /**
     * Update a support query
     *
     * @synaxon-endpoint PATCH /v1/support/queries/{id}
     * @synaxon-operation-id UpdateSupportQueryHttpController_updateSupportQuery
     * @param string $id Path parameter from the upstream spec.
     * @param array<string, mixed>|null $body Request body.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function updateSupportQuery(string $id, ?array $body = null): array|null
    {
        return $this->httpPatch($this->expand('/v1/support/queries/{id}', ['id' => $id]), $body);
    }

    /**
     * List support chat threads
     *
     * @synaxon-endpoint GET /v1/support/chats
     * @synaxon-operation-id FindSupportChatListHttpController_listSupportChats
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function listSupportChats(array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/support/chats'), $query);
    }

    /**
     * Delete a support chat thread
     *
     * @synaxon-endpoint DELETE /v1/support/chats/{threadId}
     * @synaxon-operation-id DeleteSupportChatHttpController_removeSupportChat
     * @param string $threadId Path parameter from the upstream spec.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function removeSupportChat(string $threadId): array|null
    {
        return $this->httpDelete($this->expand('/v1/support/chats/{threadId}', ['threadId' => $threadId]));
    }
}
