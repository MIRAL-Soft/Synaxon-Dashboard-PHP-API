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
}
