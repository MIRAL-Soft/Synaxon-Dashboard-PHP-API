<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class RefreshAuthTokenRequestDto extends AbstractDto
{
    /**
     * Refresh token acquired from authentication
     *
     * @return string
     */
    public function getRefreshToken(): string
    {
        return (string) $this->required('refreshToken');
    }

    /**
     * Set the "refreshToken" field. Refresh token acquired from authentication
     *
     * @return static
     */
    public function withRefreshToken(?string $value): static
    {
        return $this->with('refreshToken', $value);
    }
}
