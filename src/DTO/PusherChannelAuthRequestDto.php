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
     * Set the "socket_id" field. Socket ID
     *
     * @return static
     */
    public function withSocketId(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('socket_id', $value);
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

    /**
     * Set the "channel_name" field. Channel name
     *
     * @return static
     */
    public function withChannelName(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('channel_name', $value);
    }
}
