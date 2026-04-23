<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class DevicesDto extends AbstractDto
{
    /**
     * @return list<DeviceDto>
     */
    public function getDevices(): array
    {
        $out = [];
        foreach ((array) ($this->data['devices'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = DeviceDto::fromArray($item);
            } elseif ($item instanceof DeviceDto) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * @return float
     */
    public function getWorkstations(): float
    {
        return (float) $this->data['workstations'];
    }

    /**
     * @return float
     */
    public function getServers(): float
    {
        return (float) $this->data['servers'];
    }
}
