<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class SetNSightClientApiTokenResponseDto extends AbstractDto
{
    /**
     * The cleartext API token for the raw API. Only returned once - store it securely.
     *
     * @return string
     */
    public function getApiToken(): string
    {
        return (string) $this->required('apiToken');
    }
}
