<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class LywandTokenResponseDto extends AbstractDto
{
    /**
     * The installation token
     *
     * @return string
     */
    public function getToken(): string
    {
        return (string) $this->data['token'];
    }
}
