<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class EsetDeviceResponseDto extends AbstractDto
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
     * Device name
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->data['name'];
    }

    /**
     * Parent ID of the device
     *
     * @return string
     */
    public function getParentId(): string
    {
        return (string) $this->data['parentId'];
    }

    /**
     * Vendor ID of the device
     *
     * @return string
     */
    public function getVendorId(): string
    {
        return (string) $this->data['vendorId'];
    }

    /**
     * Number of detections on the device
     *
     * @return float
     */
    public function getDetections(): float
    {
        return (float) $this->data['detections'];
    }

    /**
     * Security product name
     *
     * @return string
     */
    public function getSecurityProductName(): string
    {
        return (string) $this->data['securityProductName'];
    }

    /**
     * Security product version
     *
     * @return string
     */
    public function getSecurityProductVersion(): string
    {
        return (string) $this->data['securityProductVersion'];
    }

    /**
     * Module status
     *
     * @return string
     */
    public function getModuleStatus(): string
    {
        return (string) $this->data['moduleStatus'];
    }

    /**
     * Operating system name
     *
     * @return string
     */
    public function getOsName(): string
    {
        return (string) $this->data['osName'];
    }

    /**
     * Operating system version
     *
     * @return string
     */
    public function getOsVersion(): string
    {
        return (string) $this->data['osVersion'];
    }

    /**
     * Operating system build number
     *
     * @return string
     */
    public function getOsBuildNumber(): string
    {
        return (string) $this->data['osBuildNumber'];
    }

    /**
     * Date of the last database update on the device
     *
     * @return string
     */
    public function getDatabaseDate(): string
    {
        return (string) $this->data['databaseDate'];
    }

    /**
     * Aggregated status of the device
     *
     * @return string
     */
    public function getStatus(): string
    {
        return (string) $this->data['status'];
    }

    /**
     * License public ID of the device
     *
     * @return string
     */
    public function getLicensePublicId(): string
    {
        return (string) $this->data['licensePublicId'];
    }
}
