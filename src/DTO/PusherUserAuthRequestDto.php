<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class PusherUserAuthRequestDto extends AbstractDto
{
    /**
     * Socket ID
     *
     * @return string
     */
    public function getSocketId(): string
    {
        return (string) $this->data['socket_id'];
    }
}
