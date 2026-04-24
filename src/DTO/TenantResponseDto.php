<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class TenantResponseDto extends AbstractDto
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
     * Tenant name
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->data['name'];
    }

    /**
     * Tenant display name
     *
     * @return string
     */
    public function getDisplayName(): string
    {
        return (string) $this->data['displayName'];
    }

    /**
     * Partner number
     *
     * @return string
     */
    public function getPartnerNumber(): string
    {
        return (string) $this->data['partnerNumber'];
    }

    /**
     * E-Mail Address for alerting
     *
     * @return string
     */
    public function getAlertEmail(): string
    {
        return (string) $this->data['alertEmail'];
    }

    /**
     * Support E-Mail Address for customers
     *
     * @return string
     */
    public function getSupportEmail(): string
    {
        return (string) $this->data['supportEmail'];
    }

    /**
     * Support phone number for customers
     *
     * @return string
     */
    public function getSupportPhone(): string
    {
        return (string) $this->data['supportPhone'];
    }

    /**
     * Support URL for customers
     *
     * @return string
     */
    public function getSupportUrl(): string
    {
        return (string) $this->data['supportUrl'];
    }

    /**
     * Partner region
     *
     * @return string
     */
    public function getRegion(): string
    {
        return (string) $this->data['region'];
    }
}
