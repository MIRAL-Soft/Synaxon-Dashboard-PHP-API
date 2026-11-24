<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class DeviceDto extends AbstractDto
{
    /**
     * @return string
     */
    public function getId(): string
    {
        return (string) $this->required('id');
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->required('name');
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return (string) $this->required('type');
    }

    /**
     * @return string|null
     */
    public function getOperatingSystem(): ?string
    {
        $v = $this->data['operatingSystem'] ?? null;
        return $v === null ? null : (string) $v;
    }
}
