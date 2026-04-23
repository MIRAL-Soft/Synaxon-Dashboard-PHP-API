<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class AntivirusCheckDeviceDto extends AbstractDto
{
    /**
     * @return string
     */
    public function getId(): string
    {
        return (string) $this->data['_id'];
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
    public function getType(): string
    {
        return (string) $this->data['type'];
    }
}
