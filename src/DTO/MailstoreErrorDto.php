<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class MailstoreErrorDto extends AbstractDto
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
     * Display name
     *
     * @return string
     */
    public function getDisplayName(): string
    {
        return (string) $this->data['displayName'];
    }

    /**
     * Error status
     *
     * @return string
     */
    public function getStatus(): string
    {
        return (string) $this->data['status'];
    }
}
