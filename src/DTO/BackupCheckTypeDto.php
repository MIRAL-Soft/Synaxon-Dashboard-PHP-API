<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class BackupCheckTypeDto extends AbstractDto
{
    /**
     * @return float
     */
    public function getTotal(): float
    {
        return (float) $this->data['total'];
    }

    /**
     * @return float
     */
    public function getWithChecks(): float
    {
        return (float) $this->data['withChecks'];
    }

    /**
     * @return list<BackupCheckDeviceDto>
     */
    public function getDevices(): array
    {
        $out = [];
        foreach ((array) ($this->data['devices'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = BackupCheckDeviceDto::fromArray($item);
            } elseif ($item instanceof BackupCheckDeviceDto) {
                $out[] = $item;
            }
        }
        return $out;
    }
}
