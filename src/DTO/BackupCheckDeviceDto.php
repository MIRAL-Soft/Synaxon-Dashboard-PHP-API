<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class BackupCheckDeviceDto extends AbstractDto
{
    /**
     * @return string
     */
    public function getId(): string
    {
        return (string) $this->data['id'];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->data['name'];
    }

    /**
     * @return string
     */
    public function getCheckName(): string
    {
        return (string) $this->data['checkName'];
    }
}
