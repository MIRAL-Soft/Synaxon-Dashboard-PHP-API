<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class SalesOpportunityResponseDto extends AbstractDto
{
    /**
     * The name of the device
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->data['name'];
    }

    /**
     * The name of the site
     *
     * @return string
     */
    public function getSiteName(): string
    {
        return (string) $this->data['siteName'];
    }

    /**
     * The user who logged in the device
     *
     * @return string|null
     */
    public function getUsername(): ?string
    {
        $v = $this->data['username'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * The operating system of the device
     *
     * @return string|null
     */
    public function getOperatingSystem(): ?string
    {
        $v = $this->data['operatingSystem'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * The end of life (EOL) of the operating system
     *
     * @return string
     */
    public function getOsEOL(): string
    {
        return (string) $this->data['osEOL'];
    }

    /**
     * The name of the CPU
     *
     * @return string|null
     */
    public function getCpu(): ?string
    {
        $v = $this->data['cpu'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * The end of life (EOL) of the CPU
     *
     * @return string|null
     */
    public function getCpuEOL(): ?string
    {
        $v = $this->data['cpuEOL'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * The release of the CPU
     *
     * @return string|null
     */
    public function getCpuRelease(): ?string
    {
        $v = $this->data['cpuRelease'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * The amount of RAM of the device
     *
     * @return string|null
     */
    public function getTotalMemory(): ?string
    {
        $v = $this->data['totalMemory'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * The amount of hard disk space of the device
     *
     * @return list<NSightDeviceDiskDto>
     */
    public function getDisks(): array
    {
        $out = [];
        foreach ((array) ($this->data['disks'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = NSightDeviceDiskDto::fromArray($item);
            } elseif ($item instanceof NSightDeviceDiskDto) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * The Microsoft System of the device
     *
     * @return string|null
     */
    public function getMsoffice(): ?string
    {
        $v = $this->data['msoffice'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * The end of life (EOL) of the Microsoft System
     *
     * @return string|null
     */
    public function getMsofficeEOL(): ?string
    {
        $v = $this->data['msofficeEOL'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * The recommendations for the device
     *
     * @return list<string>
     */
    public function getRecommendations(): array
    {
        return (array) ($this->data['recommendations'] ?? []);
    }
}
