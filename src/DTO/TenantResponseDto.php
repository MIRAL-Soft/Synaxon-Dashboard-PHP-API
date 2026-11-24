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
     * Tenant name
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->required('name');
    }

    /**
     * Tenant display name
     *
     * @return string
     */
    public function getDisplayName(): string
    {
        return (string) $this->required('displayName');
    }

    /**
     * Partner number
     *
     * @return string
     */
    public function getPartnerNumber(): string
    {
        return (string) $this->required('partnerNumber');
    }

    /**
     * E-Mail Address for alerting
     *
     * @return string
     */
    public function getAlertEmail(): string
    {
        return (string) $this->required('alertEmail');
    }

    /**
     * Support E-Mail Address for customers
     *
     * @return string
     */
    public function getSupportEmail(): string
    {
        return (string) $this->required('supportEmail');
    }

    /**
     * Support phone number for customers
     *
     * @return string
     */
    public function getSupportPhone(): string
    {
        return (string) $this->required('supportPhone');
    }

    /**
     * Support URL for customers
     *
     * @return string
     */
    public function getSupportUrl(): string
    {
        return (string) $this->required('supportUrl');
    }

    /**
     * Partner region
     *
     * @return string
     */
    public function getRegion(): string
    {
        return (string) $this->required('region');
    }
}
