<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class AcronisStorageDto extends AbstractDto
{
    /**
     * Local storage in bytes
     *
     * @return float
     */
    public function getLocalStorage(): float
    {
        return (float) $this->data['local_storage'];
    }

    /**
     * Cloud storage in bytes
     *
     * @return float
     */
    public function getStorage(): float
    {
        return (float) $this->data['storage'];
    }

    /**
     * Total storage in bytes
     *
     * @return float
     */
    public function getStorageTotal(): float
    {
        return (float) $this->data['storage_total'];
    }

    /**
     * Number of servers
     *
     * @return float
     */
    public function getServers(): float
    {
        return (float) $this->data['servers'];
    }

    /**
     * Number of workstations
     *
     * @return float
     */
    public function getWorkstations(): float
    {
        return (float) $this->data['workstations'];
    }

    /**
     * Number of virtual machines
     *
     * @return float
     */
    public function getVms(): float
    {
        return (float) $this->data['vms'];
    }
}
