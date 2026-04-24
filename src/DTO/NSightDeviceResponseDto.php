<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class NSightDeviceResponseDto extends AbstractDto
{
    /**
     * Entity unique identifier
     *
     * @return string
     */
    public function getId(): string
    {
        return (string) $this->data['id'];
    }

    /**
     * Entity creation date and time
     *
     * @return string
     */
    public function getCreatedAt(): string
    {
        return (string) $this->data['createdAt'];
    }

    /**
     * Date and time of last update
     *
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return (string) $this->data['updatedAt'];
    }

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
     * The device ID
     *
     * @return float
     */
    public function getVendorId(): float
    {
        return (float) $this->data['vendorId'];
    }

    /**
     * The type of the device
     *
     * @return string
     */
    public function getType(): string
    {
        return (string) $this->data['type'];
    }

    /**
     * The tenant ID
     *
     * @return string
     */
    public function getTenantId(): string
    {
        return (string) $this->data['tenantId'];
    }

    /**
     * The dashboard ID
     *
     * @return string
     */
    public function getDashboardId(): string
    {
        return (string) $this->data['dashboardId'];
    }

    /**
     * The site ID
     *
     * @return string
     */
    public function getSiteId(): string
    {
        return (string) $this->data['siteId'];
    }

    /**
     * The description of the device
     *
     * @return string
     */
    public function getDescription(): string
    {
        return (string) $this->data['description'];
    }

    /**
     * The agent version of the device
     *
     * @return string
     */
    public function getAgentVersion(): string
    {
        return (string) $this->data['agentVersion'];
    }

    /**
     * The online status of the device
     *
     * @return bool
     */
    public function getIsOnline(): bool
    {
        return (bool) $this->data['isOnline'];
    }

    /**
     * The username of the device
     *
     * @return string
     */
    public function getUsername(): string
    {
        return (string) $this->data['username'];
    }

    /**
     * The manufacturer of the device
     *
     * @return string
     */
    public function getManufacturer(): string
    {
        return (string) $this->data['manufacturer'];
    }

    /**
     * The model of the device
     *
     * @return string
     */
    public function getModel(): string
    {
        return (string) $this->data['model'];
    }

    /**
     * The serial of the device
     *
     * @return string
     */
    public function getSerial(): string
    {
        return (string) $this->data['serial'];
    }

    /**
     * The processor count of the device
     *
     * @return float
     */
    public function getProcessorCount(): float
    {
        return (float) $this->data['processorCount'];
    }

    /**
     * The total memory of the device
     *
     * @return float
     */
    public function getTotalMemory(): float
    {
        return (float) $this->data['totalMemory'];
    }

    /**
     * The operating system of the device
     *
     * @return string
     */
    public function getOperatingSystem(): string
    {
        return (string) $this->data['operatingSystem'];
    }

    /**
     * The MAC address of the device
     *
     * @return string
     */
    public function getMac1(): string
    {
        return (string) $this->data['mac1'];
    }

    /**
     * The MAC address of the device
     *
     * @return string
     */
    public function getMac2(): string
    {
        return (string) $this->data['mac2'];
    }

    /**
     * The MAC address of the device
     *
     * @return string
     */
    public function getMac3(): string
    {
        return (string) $this->data['mac3'];
    }

    /**
     * The CPU of the device
     *
     * @return string
     */
    public function getCpu(): string
    {
        return (string) $this->data['cpu'];
    }

    /**
     * The CPU EOL of the device
     *
     * @return string
     */
    public function getCpuEOL(): string
    {
        return (string) $this->data['cpuEOL'];
    }

    /**
     * The CPU release date of the device
     *
     * @return string
     */
    public function getCpuRelease(): string
    {
        return (string) $this->data['cpuRelease'];
    }

    /**
     * The OS EOL of the device
     *
     * @return string
     */
    public function getOsEOL(): string
    {
        return (string) $this->data['osEOL'];
    }

    /**
     * The MS Office version of the device
     *
     * @return string
     */
    public function getMsoffice(): string
    {
        return (string) $this->data['msoffice'];
    }

    /**
     * The MS Office EOL of the device
     *
     * @return string
     */
    public function getMsofficeEOL(): string
    {
        return (string) $this->data['msofficeEOL'];
    }

    /**
     * The hardware of the device
     *
     * @return list<NSightDeviceHardwareDto>
     */
    public function getHardware(): array
    {
        $out = [];
        foreach ((array) ($this->data['hardware'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = NSightDeviceHardwareDto::fromArray($item);
            } elseif ($item instanceof NSightDeviceHardwareDto) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * The software of the device
     *
     * @return list<NSightDeviceSoftwareDto>
     */
    public function getSoftware(): array
    {
        $out = [];
        foreach ((array) ($this->data['software'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = NSightDeviceSoftwareDto::fromArray($item);
            } elseif ($item instanceof NSightDeviceSoftwareDto) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * The disks of the device
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
     * The antivirus of the device
     *
     * @return list<NSightDeviceAntivirusDto>
     */
    public function getAntivirus(): array
    {
        $out = [];
        foreach ((array) ($this->data['antivirus'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = NSightDeviceAntivirusDto::fromArray($item);
            } elseif ($item instanceof NSightDeviceAntivirusDto) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * The backups of the device
     *
     * @return list<NSightDeviceBackupDto>
     */
    public function getBackups(): array
    {
        $out = [];
        foreach ((array) ($this->data['backups'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = NSightDeviceBackupDto::fromArray($item);
            } elseif ($item instanceof NSightDeviceBackupDto) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * The patches of the device
     *
     * @return list<NSightDevicePatchDto>
     */
    public function getPatches(): array
    {
        $out = [];
        foreach ((array) ($this->data['patches'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = NSightDevicePatchDto::fromArray($item);
            } elseif ($item instanceof NSightDevicePatchDto) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * Whether take control module is enabled
     *
     * @return bool
     */
    public function getTakeControl(): bool
    {
        return (bool) $this->data['takeControl'];
    }

    /**
     * Whether patch management module is enabled
     *
     * @return bool
     */
    public function getPatchManagement(): bool
    {
        return (bool) $this->data['patchManagement'];
    }

    /**
     * Whether MAV (Managed Antivirus) module is enabled
     *
     * @return bool
     */
    public function getMav(): bool
    {
        return (bool) $this->data['mav'];
    }

    /**
     * MAV threat items for the device
     *
     * @return list<mixed>
     */
    public function getMavThreats(): array
    {
        return (array) ($this->data['mavThreats'] ?? []);
    }

    /**
     * The last time the device was seen
     *
     * @return string
     */
    public function getLastSeen(): string
    {
        return (string) $this->data['lastSeen'];
    }

    /**
     * Date and time of deletion
     *
     * @return string
     */
    public function getDeletedAt(): string
    {
        return (string) $this->data['deletedAt'];
    }
}
