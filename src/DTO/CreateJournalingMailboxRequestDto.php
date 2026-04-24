<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CreateJournalingMailboxRequestDto extends AbstractDto
{
    /**
     * Instance ID
     *
     * @return string
     */
    public function getInstanceId(): string
    {
        return (string) $this->data['instanceId'];
    }

    /**
     * Set the "instanceId" field. Instance ID
     *
     * @return static
     */
    public function withInstanceId(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('instanceId', $value);
    }
}
