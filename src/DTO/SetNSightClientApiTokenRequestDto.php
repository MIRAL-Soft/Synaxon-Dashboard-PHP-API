<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class SetNSightClientApiTokenRequestDto extends AbstractDto
{
    /**
     * API token for the raw (vendor-compatible) API. If omitted, a random token is generated.
     *
     * @return string|null
     */
    public function getApiToken(): ?string
    {
        $v = $this->data['apiToken'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Set the "apiToken" field. API token for the raw (vendor-compatible) API. If omitted, a random token is generated.
     *
     * @return static
     */
    public function withApiToken(?string $value): static
    {
        return $this->with('apiToken', $value);
    }
}
