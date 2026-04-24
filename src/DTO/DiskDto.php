<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class DiskDto extends AbstractDto
{
    /**
     * @return string
     */
    public function getDescription(): string
    {
        return (string) $this->data['description'];
    }

    /**
     * @return float
     */
    public function getFreeSpace(): float
    {
        return (float) $this->data['freeSpace'];
    }

    /**
     * @return float
     */
    public function getSize(): float
    {
        return (float) $this->data['size'];
    }
}
