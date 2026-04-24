<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class OfflineDevicesDto extends AbstractDto
{
    /**
     * @return float
     */
    public function getWorkstation(): float
    {
        return (float) $this->data['workstation'];
    }

    /**
     * @return float
     */
    public function getServer(): float
    {
        return (float) $this->data['server'];
    }
}
