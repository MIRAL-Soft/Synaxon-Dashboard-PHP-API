<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class EsetScoreDto extends AbstractDto
{
    /**
     * Total number of devices
     *
     * @return float
     */
    public function getTotalDevices(): float
    {
        return (float) $this->data['totalDevices'];
    }

    /**
     * Number of devices with errors
     *
     * @return float
     */
    public function getDevicesWithErrors(): float
    {
        return (float) $this->data['devicesWithErrors'];
    }

    /**
     * Score as a decimal (0-1), representing the percentage of devices without errors
     *
     * @return float
     */
    public function getScore(): float
    {
        return (float) $this->data['score'];
    }
}
