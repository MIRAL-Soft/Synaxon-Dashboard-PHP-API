<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class SetMailstorePartnerApiKeyResponseDto extends AbstractDto
{
    /**
     * The cleartext API key for the MailStore raw API. Only returned once - store it securely.
     *
     * @return string
     */
    public function getApiKey(): string
    {
        return (string) $this->required('apiKey');
    }
}
