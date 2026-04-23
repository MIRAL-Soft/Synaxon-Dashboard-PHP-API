<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class PusherChannelAuthRequestDto extends AbstractDto
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

    /**
     * Channel name
     *
     * @return string
     */
    public function getChannelName(): string
    {
        return (string) $this->data['channel_name'];
    }
}
