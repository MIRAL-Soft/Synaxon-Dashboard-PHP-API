<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class NSightClientResponseDto extends AbstractDto
{
    /**
     * Entity unique identifier
     *
     * @return string
     */
    public function getId(): string
    {
        return (string) $this->required('id');
    }

    /**
     * Entity creation date and time
     *
     * @return string
     */
    public function getCreatedAt(): string
    {
        return (string) $this->required('createdAt');
    }

    /**
     * Date and time of last update
     *
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return (string) $this->required('updatedAt');
    }

    /**
     * Client name
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->required('name');
    }

    /**
     * N-sight Client ID
     *
     * @return float
     */
    public function getVendorId(): float
    {
        return (float) $this->required('vendorId');
    }

    /**
     * Dashboard access enabled for client
     *
     * @return string
     */
    public function getViewDashboard(): string
    {
        return (string) $this->required('viewDashboard');
    }

    /**
     * Workstation (or servers only) assets access enabled for client
     *
     * @return string
     */
    public function getViewWorkstationAssets(): string
    {
        return (string) $this->required('viewWorkstationAssets');
    }

    /**
     * Dashboard username
     *
     * @return string
     */
    public function getDashboardUsername(): string
    {
        return (string) $this->required('dashboardUsername');
    }

    /**
     * Timezone
     *
     * @return string
     */
    public function getTimezone(): string
    {
        return (string) $this->required('timezone');
    }

    /**
     * Number of servers
     *
     * @return float
     */
    public function getServerCount(): float
    {
        return (float) $this->required('serverCount');
    }

    /**
     * Number of workstations
     *
     * @return float
     */
    public function getWorkstationCount(): float
    {
        return (float) $this->required('workstationCount');
    }

    /**
     * Number of mobile devices
     *
     * @return float
     */
    public function getMobileDeviceCount(): float
    {
        return (float) $this->required('mobileDeviceCount');
    }

    /**
     * Number of devices
     *
     * @return float
     */
    public function getDeviceCount(): float
    {
        return (float) $this->required('deviceCount');
    }

    /**
     * Number of failing checks
     *
     * @return float
     */
    public function getFailingChecksCount(): float
    {
        return (float) $this->required('failingChecksCount');
    }

    /**
     * Deleted at
     *
     * @return string
     */
    public function getDeletedAt(): string
    {
        return (string) $this->required('deletedAt');
    }

    /**
     * Dashboard ID
     *
     * @return string
     */
    public function getDashboardId(): string
    {
        return (string) $this->required('dashboardId');
    }
}
