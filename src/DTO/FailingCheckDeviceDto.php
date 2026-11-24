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
        return (string) $this->required('deviceId');
    }

    /**
     * @return string
     */
    public function getSiteName(): string
    {
        return (string) $this->required('siteName');
    }

    /**
     * @return string
     */
    public function getDeviceName(): string
    {
        return (string) $this->required('deviceName');
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return (string) $this->required('type');
    }

    /**
     * @return list<string>
     */
    public function getErrors(): array
    {
        return (array) ($this->data['errors'] ?? []);
    }
}
