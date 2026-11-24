<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CreateApiTokenResponseDto extends AbstractDto
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
     * tenantid associated with the API token
     *
     * @return string
     */
    public function getTenantId(): string
    {
        return (string) $this->required('tenantId');
    }

    /**
     * client identifier, used as Basic Auth username
     *
     * @return string
     */
    public function getClientId(): string
    {
        return (string) $this->required('clientId');
    }

    /**
     * tenant-defined label of the API token
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->required('name');
    }

    /**
     * API token status
     *
     * @return string
     */
    public function getStatus(): string
    {
        return (string) $this->required('status');
    }

    /**
     * expiry date
     *
     * @return string
     */
    public function getExpiresAt(): string
    {
        return (string) $this->required('expiresAt');
    }

    /**
     * timestamp of the last successful authentication
     *
     * @return string|null
     */
    public function getLastUsedAt(): ?string
    {
        $v = $this->data['lastUsedAt'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * id of the user who created this token
     *
     * @return string
     */
    public function getCreatedBy(): string
    {
        return (string) $this->required('createdBy');
    }

    /**
     * client secret, returned exactly once at creation
     *
     * @return string
     */
    public function getClientSecret(): string
    {
        return (string) $this->required('clientSecret');
    }
}
