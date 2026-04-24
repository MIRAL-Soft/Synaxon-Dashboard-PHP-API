<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class AuthResponseDto extends AbstractDto
{
    /**
     * Authorization token ID
     *
     * @return string
     */
    public function getTokenId(): string
    {
        return (string) $this->data['tokenId'];
    }

    /**
     * User ID
     *
     * @return string
     */
    public function getUserId(): string
    {
        return (string) $this->data['userId'];
    }

    /**
     * User role
     *
     * @return string
     */
    public function getUserRole(): string
    {
        return (string) $this->data['userRole'];
    }

    /**
     * JWT access token
     *
     * @return string
     */
    public function getAccessToken(): string
    {
        return (string) $this->data['accessToken'];
    }

    /**
     * JWT refresh token
     *
     * @return string
     */
    public function getRefreshToken(): string
    {
        return (string) $this->data['refreshToken'];
    }

    /**
     * Token expiration date
     *
     * @return string
     */
    public function getExpiresAt(): string
    {
        return (string) $this->data['expiresAt'];
    }

    /**
     * Tenant ID
     *
     * @return string
     */
    public function getTenantId(): string
    {
        return (string) $this->data['tenantId'];
    }

    /**
     * Partner ID
     *
     * @return string
     */
    public function getPartnerNo(): string
    {
        return (string) $this->data['partnerNo'];
    }

    /**
     * Permissions granted to the user
     *
     * @return list<PermissionResponseDto>
     */
    public function getPermissions(): array
    {
        $out = [];
        foreach ((array) ($this->data['permissions'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = PermissionResponseDto::fromArray($item);
            } elseif ($item instanceof PermissionResponseDto) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * Redirect URL after authentication
     *
     * @return string|null
     */
    public function getRedirectUrl(): ?string
    {
        $v = $this->data['redirectUrl'] ?? null;
        return $v === null ? null : (string) $v;
    }
}
