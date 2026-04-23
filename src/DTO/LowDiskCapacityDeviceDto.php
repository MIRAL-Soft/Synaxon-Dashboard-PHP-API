<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class LowDiskCapacityDeviceDto extends AbstractDto
{
    /**
     * @return string
     */
    public function getId(): string
    {
        return (string) $this->data['id'];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->data['name'];
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return (string) $this->data['type'];
    }

    /**
     * @return list<DiskDto>
     */
    public function getDisks(): array
    {
        $out = [];
        foreach ((array) ($this->data['disks'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = DiskDto::fromArray($item);
            } elseif ($item instanceof DiskDto) {
                $out[] = $item;
            }
        }
        return $out;
    }
}
