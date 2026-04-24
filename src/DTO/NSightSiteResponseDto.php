<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class NSightSiteResponseDto extends AbstractDto
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
     * The customer id of customer file
     *
     * @return float|null
     */
    public function getCustomerId(): ?float
    {
        $v = $this->data['customerId'] ?? null;
        return $v === null ? null : (float) $v;
    }

    /**
     * The name of the site
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->data['name'];
    }

    /**
     * The site ID
     *
     * @return float
     */
    public function getVendorId(): float
    {
        return (float) $this->data['vendorId'];
    }

    /**
     * The number of workstations
     *
     * @return float
     */
    public function getWorkstationCount(): float
    {
        return (float) $this->data['workstationCount'];
    }

    /**
     * The number of servers
     *
     * @return float
     */
    public function getServerCount(): float
    {
        return (float) $this->data['serverCount'];
    }

    /**
     * The number of failing checks
     *
     * @return float
     */
    public function getFailingChecksCount(): float
    {
        return (float) $this->data['failingChecksCount'];
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
