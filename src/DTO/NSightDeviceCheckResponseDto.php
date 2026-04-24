<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class NSightDeviceCheckResponseDto extends AbstractDto
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
     * The device ID associated with this check
     *
     * @return string
     */
    public function getDeviceId(): string
    {
        return (string) $this->data['deviceId'];
    }

    /**
     * The name of the device associated with this check
     *
     * @return string|null
     */
    public function getDeviceName(): ?string
    {
        $v = $this->data['deviceName'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * The name of the site associated with this check
     *
     * @return string|null
     */
    public function getSiteName(): ?string
    {
        $v = $this->data['siteName'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * The tenant ID associated with this check
     *
     * @return string
     */
    public function getTenantId(): string
    {
        return (string) $this->data['tenantId'];
    }

    /**
     * The site ID associated with this check
     *
     * @return string
     */
    public function getSiteId(): string
    {
        return (string) $this->data['siteId'];
    }

    /**
     * The check ID for this device check
     *
     * @return float
     */
    public function getVendorId(): float
    {
        return (float) $this->data['vendorId'];
    }

    /**
     * The description of this device check
     *
     * @return string|null
     */
    public function getDescription(): ?string
    {
        $v = $this->data['description'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * The status of this device check
     *
     * @return string
     */
    public function getStatus(): string
    {
        return (string) $this->data['status'];
    }

    /**
     * The UTC time when this check was run
     *
     * @return string|null
     */
    public function getUtcRun(): ?string
    {
        $v = $this->data['utcRun'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * The type of check being performed
     *
     * @return float
     */
    public function getCheckType(): float
    {
        return (float) $this->data['checkType'];
    }

    /**
     * Consecutive failure count for this check
     *
     * @return float
     */
    public function getConsecutiveFails(): float
    {
        return (float) $this->data['consecutiveFails'];
    }

    /**
     * DSC 247 value for this check
     *
     * @return float
     */
    public function getDsc247(): float
    {
        return (float) $this->data['dsc247'];
    }

    /**
     * Formatted output from the check execution
     *
     * @return string|null
     */
    public function getFormattedOutput(): ?string
    {
        $v = $this->data['formattedOutput'] ?? null;
        return $v === null ? null : (string) $v;
    }
}
