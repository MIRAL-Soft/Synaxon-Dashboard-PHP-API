<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class ScoreDto extends AbstractDto
{
    /**
     * @return float
     */
    public function getTotalDevices(): float
    {
        return (float) $this->data['totalDevices'];
    }

    /**
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
