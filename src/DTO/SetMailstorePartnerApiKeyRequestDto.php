<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class SetMailstorePartnerApiKeyRequestDto extends AbstractDto
{
    /**
     * API key for the MailStore partner raw API. If omitted, a random key is generated.
     *
     * @return string|null
     */
    public function getApiKey(): ?string
    {
        $v = $this->data['apiKey'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Set the "apiKey" field. API key for the MailStore partner raw API. If omitted, a random key is generated.
     *
     * @return static
     */
    public function withApiKey(?string $value): static
    {
        return $this->with('apiKey', $value);
    }
}
