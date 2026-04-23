<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class NSightClientsResponseDto extends AbstractDto
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
     * Client name
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->data['name'];
    }

    /**
     * N-sight Client ID
     *
     * @return float
     */
    public function getVendorId(): float
    {
        return (float) $this->data['vendorId'];
    }

    /**
     * Dashboard access enabled for client
     *
     * @return string
     */
    public function getViewDashboard(): string
    {
        return (string) $this->data['viewDashboard'];
    }

    /**
     * Workstation (or servers only) assets access enabled for client
     *
     * @return string
     */
    public function getViewWorkstationAssets(): string
    {
        return (string) $this->data['viewWorkstationAssets'];
    }

    /**
     * Dashboard username
     *
     * @return string
     */
    public function getDashboardUsername(): string
    {
        return (string) $this->data['dashboardUsername'];
    }

    /**
     * Timezone
     *
     * @return string
     */
    public function getTimezone(): string
    {
        return (string) $this->data['timezone'];
    }

    /**
     * Number of servers
     *
     * @return float
     */
    public function getServerCount(): float
    {
        return (float) $this->data['serverCount'];
    }

    /**
     * Number of workstations
     *
     * @return float
     */
    public function getWorkstationCount(): float
    {
        return (float) $this->data['workstationCount'];
    }

    /**
     * Number of mobile devices
     *
     * @return float
     */
    public function getMobileDeviceCount(): float
    {
        return (float) $this->data['mobileDeviceCount'];
    }

    /**
     * Number of devices
     *
     * @return float
     */
    public function getDeviceCount(): float
    {
        return (float) $this->data['deviceCount'];
    }

    /**
     * Number of failing checks
     *
     * @return float
     */
    public function getFailingChecksCount(): float
    {
        return (float) $this->data['failingChecksCount'];
    }

    /**
     * Deleted at
     *
     * @return string
     */
    public function getDeletedAt(): string
    {
        return (string) $this->data['deletedAt'];
    }

    /**
     * Dashboard ID
     *
     * @return string
     */
    public function getDashboardId(): string
    {
        return (string) $this->data['dashboardId'];
    }
}
