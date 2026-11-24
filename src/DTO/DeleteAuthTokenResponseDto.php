<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class DeleteAuthTokenResponseDto extends AbstractDto
{
    /**
     * Redirect URL for SSO logout (e.g. EGIS logout URL). The frontend should navigate to this URL.
     *
     * @return string|null
     */
    public function getRedirectUrl(): ?string
    {
        $v = $this->data['redirectUrl'] ?? null;
        return $v === null ? null : (string) $v;
    }
}
