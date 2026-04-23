<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Resource;

/**
 * Pusher resource — wraps all /v1/pusher/* endpoints.
 *
 * This class is generated from the OpenAPI specification. Method names follow
 * REST conventions where the endpoint shape permits; otherwise the suffix of
 * the upstream operationId is used to preserve semantic meaning.
 */
class PusherResource extends AbstractResource
{
    /**
     * Pusher user authentication
     *
     * @synaxon-endpoint POST /v1/pusher/user-auth
     * @synaxon-operation-id PusherUserAuthHttpController_pusherUserAuth
     * @param array<string, mixed>|null $body Request body.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function pusherUserAuth(?array $body = null): array|null
    {
        return $this->httpPost($this->expand('/v1/pusher/user-auth'), $body);
    }

    /**
     * Pusher private channel authentication
     *
     * @synaxon-endpoint POST /v1/pusher/channel-auth
     * @synaxon-operation-id PusherChannelAuthHttpController_pusherChannelAuth
     * @param array<string, mixed>|null $body Request body.
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function pusherChannelAuth(?array $body = null): array|null
    {
        return $this->httpPost($this->expand('/v1/pusher/channel-auth'), $body);
    }
}
