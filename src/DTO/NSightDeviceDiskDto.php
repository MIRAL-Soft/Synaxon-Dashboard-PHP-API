<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class NSightDeviceDiskDto extends AbstractDto
{
    /**
     * The description of the hard disk
     *
     * @return string
     */
    public function getDescription(): string
    {
        return (string) $this->required('description');
    }

    /**
     * The byte value of the total disk size
     *
     * @return float
     */
    public function getSize(): float
    {
        return (float) $this->required('size');
    }

    /**
     * The byte value of the available disk space
     *
     * @return float
     */
    public function getFreeSpace(): float
    {
        return (float) $this->required('freeSpace');
    }

    /**
     * The warning status of the hard disk
     *
     * @return bool
     */
    public function getFailing(): bool
    {
        return (bool) $this->required('failing');
    }
}
