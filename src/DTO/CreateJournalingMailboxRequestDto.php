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
}
