<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class AcronisDeviceResponseDto extends AbstractDto
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
     * The Acronis ID
     *
     * @return string
     */
    public function getVendorId(): string
    {
        return (string) $this->data['vendorId'];
    }

    /**
     * Device type (determined by system attributes)
     *
     * @return string
     */
    public function getType(): string
    {
        return (string) $this->data['type'];
    }

    /**
     * Device type based on licensing
     *
     * @return string
     */
    public function getLicense(): string
    {
        return (string) $this->data['license'];
    }

    /**
     * The status of the device
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
     * CPU information array
     *
     * @return list<string>
     */
    public function getCpu(): array
    {
        return (array) ($this->data['cpu'] ?? []);
    }

    /**
     * IP addresses array
     *
     * @return list<string>
     */
    public function getIpAddresses(): array
    {
        return (array) ($this->data['ipAddresses'] ?? []);
    }

    /**
     * Last backup date
     *
     * @return string|null
     */
    public function getLastBackup(): ?string
    {
        $v = $this->data['lastBackup'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Next backup date
     *
     * @return string|null
     */
    public function getNextBackup(): ?string
    {
        $v = $this->data['nextBackup'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Last successful backup date
     *
     * @return string|null
     */
    public function getLastSuccessfulBackup(): ?string
    {
        $v = $this->data['lastSuccessfulBackup'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Agent version
     *
     * @return string|null
     */
    public function getAgentVersion(): ?string
    {
        $v = $this->data['agentVersion'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Operating system type
     *
     * @return string|null
     */
    public function getOsType(): ?string
    {
        $v = $this->data['osType'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Operating system name
     *
     * @return string|null
     */
    public function getOs(): ?string
    {
        $v = $this->data['os'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * RAM size in bytes
     *
     * @return float|null
     */
    public function getRam(): ?float
    {
        $v = $this->data['ram'] ?? null;
        return $v === null ? null : (float) $v;
    }

    /**
     * Cyberfit security score
     *
     * @return float|null
     */
    public function getCyberfitScore(): ?float
    {
        $v = $this->data['cyberfitScore'] ?? null;
        return $v === null ? null : (float) $v;
    }

    /**
     * @return string
     */
    public function getAcronisUsername(): string
    {
        return (string) $this->data['acronisUsername'];
    }

    /**
     * @return string
     */
    public function getTenantId(): string
    {
        return (string) $this->data['tenantId'];
    }

    /**
     * @return string
     */
    public function getParentId(): string
    {
        return (string) $this->data['parentId'];
    }

    /**
     * Array of Acronis policy IDs
     *
     * @return list<string>
     */
    public function getAcronisPolicies(): array
    {
        return (array) ($this->data['acronisPolicies'] ?? []);
    }
}
