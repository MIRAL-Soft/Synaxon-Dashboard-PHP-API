<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Resource;

/**
 * Notifications resource — wraps all /v1/notifications/* endpoints.
 *
 * This class is generated from the OpenAPI specification. Method names follow
 * REST conventions where the endpoint shape permits; otherwise the suffix of
 * the upstream operationId is used to preserve semantic meaning.
 */
class NotificationsResource extends AbstractResource
{
    /**
     * Get messages
     *
     * @synaxon-endpoint GET /v1/notifications
     * @synaxon-operation-id FindMessagesHttpController_listMessages
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function list(array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/notifications'), $query);
    }

    /**
     * Get unread messages
     *
     * @synaxon-endpoint GET /v1/notifications/unread
     * @synaxon-operation-id FindUnreadMessagesHttpController_listUnreadMessages
     * @param array<string, scalar|array<int, scalar>> $query Query parameters.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function listUnreadMessages(array $query = []): array|null
    {
        return $this->httpGet($this->expand('/v1/notifications/unread'), $query);
    }

    /**
     * Get message options
     *
     * @synaxon-endpoint GET /v1/notifications/options
     * @synaxon-operation-id FindMessageOptionsHttpController_getMessageOptions
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function getMessageOptions(): array|null
    {
        return $this->httpGet($this->expand('/v1/notifications/options'));
    }

    /**
     * Set all messages as read
     *
     * @synaxon-endpoint POST /v1/notifications/setAllRead
     * @synaxon-operation-id SetAllReadMessageHttpController_setAllRead
     * @param array<string, mixed>|null $body Request body.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function setAllRead(?array $body = null): array|null
    {
        return $this->httpPost($this->expand('/v1/notifications/setAllRead'), $body);
    }

    /**
     * Get message by id
     *
     * @synaxon-endpoint GET /v1/notifications/{id}
     * @synaxon-operation-id FindMessageHttpController_getMessage
     * @param string $id Path parameter from the upstream spec.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function find(string $id): array|null
    {
        return $this->httpGet($this->expand('/v1/notifications/{id}', ['id' => $id]));
    }

    /**
     * Updates a message
     *
     * @synaxon-endpoint PATCH /v1/notifications/{id}
     * @synaxon-operation-id UpdateMessageHttpController_updateMessage
     * @param string $id Path parameter from the upstream spec.
     * @param array<string, mixed>|null $body Request body.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function update(string $id, ?array $body = null): array|null
    {
        return $this->httpPatch($this->expand('/v1/notifications/{id}', ['id' => $id]), $body);
    }

    /**
     * Updates a bulk of messages
     *
     * @synaxon-endpoint PATCH /v1/notifications/bulk
     * @synaxon-operation-id UpdateMessageBulkHttpController_updateMessageBulk
     * @param array<string, mixed>|null $body Request body.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function updateMessageBulk(?array $body = null): array|null
    {
        return $this->httpPatch($this->expand('/v1/notifications/bulk'), $body);
    }

    /**
     * Set message as read
     *
     * @synaxon-endpoint POST /v1/notifications/{id}/setRead
     * @synaxon-operation-id SetReadMessageHttpController_setRead
     * @param string $id Path parameter from the upstream spec.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function setRead(string $id): array|null
    {
        return $this->httpPost($this->expand('/v1/notifications/{id}/setRead', ['id' => $id]), null);
    }
}
