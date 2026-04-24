<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class PusherChannelAuthDto extends AbstractDto
{
    /**
     * Authentication string
     *
     * @return string
     */
    public function getAuth(): string
    {
        return (string) $this->data['auth'];
    }
}
