<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class UsedAntivirusDto extends AbstractDto
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->data['name'];
    }

    /**
     * @return float
     */
    public function getCount(): float
    {
        return (float) $this->data['count'];
    }

    /**
     * @return list<UsedAntivirusDeviceDto>
     */
    public function getDevices(): array
    {
        $out = [];
        foreach ((array) ($this->data['devices'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = UsedAntivirusDeviceDto::fromArray($item);
            } elseif ($item instanceof UsedAntivirusDeviceDto) {
                $out[] = $item;
            }
        }
        return $out;
    }
}
