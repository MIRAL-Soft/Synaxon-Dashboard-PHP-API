<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class MailstoreProfileResponseDto extends AbstractDto
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
     * Mailstore instance ID
     *
     * @return string
     */
    public function getInstanceId(): string
    {
        return (string) $this->required('instanceId');
    }

    /**
     * Mailstore profile ID
     *
     * @return float
     */
    public function getProfileId(): float
    {
        return (float) $this->required('profileId');
    }

    /**
     * Tenant ID
     *
     * @return string
     */
    public function getTenantId(): string
    {
        return (string) $this->required('tenantId');
    }

    /**
     * Profile display name
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->required('name');
    }

    /**
     * Last known status of the profile
     *
     * @return string
     */
    public function getLastStatus(): string
    {
        return (string) $this->required('lastStatus');
    }
}
