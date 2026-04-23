<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class RefreshTokenRequestDto extends AbstractDto
{
    /**
     * Refresh token acquired from authentication
     *
     * @return string
     */
    public function getRefreshToken(): string
    {
        return (string) $this->data['refreshToken'];
    }
}
