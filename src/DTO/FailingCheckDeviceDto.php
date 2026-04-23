<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class FailingCheckDeviceDto extends AbstractDto
{
    /**
     * @return string
     */
    public function getDeviceId(): string
    {
        return (string) $this->data['deviceId'];
    }

    /**
     * @return string
     */
    public function getSiteName(): string
    {
        return (string) $this->data['siteName'];
    }

    /**
     * @return string
     */
    public function getDeviceName(): string
    {
        return (string) $this->data['deviceName'];
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return (string) $this->data['type'];
    }

    /**
     * @return list<string>
     */
    public function getErrors(): array
    {
        return (array) ($this->data['errors'] ?? []);
    }
}
