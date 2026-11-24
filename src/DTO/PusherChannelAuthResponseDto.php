<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class PusherChannelAuthResponseDto extends AbstractDto
{
    /**
     * Authentication string
     *
     * @return string
     */
    public function getAuth(): string
    {
        return (string) $this->required('auth');
    }
}
