<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class AcronisDeviceDto extends AbstractDto
{
    /**
     * Device name
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->data['name'];
    }

    /**
     * Device type (server, workstation, vm)
     *
     * @return string
     */
    public function getType(): string
    {
        return (string) $this->data['type'];
    }

    /**
     * Backup status
     *
     * @return string
     */
    public function getStatus(): string
    {
        return (string) $this->data['status'];
    }

    /**
     * Whether the device is online
     *
     * @return bool
     */
    public function getIsOnline(): bool
    {
        return (bool) $this->data['isOnline'];
    }

    /**
     * Last backup timestamp
     *
     * @return string|null
     */
    public function getLastBackup(): ?string
    {
        $v = $this->data['lastBackup'] ?? null;
        return $v === null ? null : (string) $v;
    }
}
