<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class ApiTokenResponseDto extends AbstractDto
{
    /**
     * Access token
     *
     * @return string
     */
    public function getAccessToken(): string
    {
        return (string) $this->data['access_token'];
    }

    /**
     * Access token expiration time in seconds
     *
     * @return float
     */
    public function getExpiresIn(): float
    {
        return (float) $this->data['expires_in'];
    }

    /**
     * Scope of the access token
     *
     * @return string
     */
    public function getScope(): string
    {
        return (string) $this->data['scope'];
    }

    /**
     * Token type
     *
     * @return string
     */
    public function getTokenType(): string
    {
        return (string) $this->data['token_type'];
    }
}
