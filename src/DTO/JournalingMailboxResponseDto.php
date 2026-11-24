<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class JournalingMailboxResponseDto extends AbstractDto
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
     * Customer name
     *
     * @return string|null
     */
    public function getCustomerName(): ?string
    {
        $v = $this->data['customerName'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Instance ID
     *
     * @return string
     */
    public function getInstanceId(): string
    {
        return (string) $this->required('instanceId');
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
     * Domain of the journaling mailbox
     *
     * @return string
     */
    public function getDomain(): string
    {
        return (string) $this->required('domain');
    }

    /**
     * Quota of the journaling mailbox
     *
     * @return float
     */
    public function getQuota(): float
    {
        return (float) $this->required('quota');
    }

    /**
     * Quota used of the journaling mailbox
     *
     * @return float
     */
    public function getQuotaUsed(): float
    {
        return (float) $this->required('quotaUsed');
    }

    /**
     * E-Mail address of the mailbox
     *
     * @return string
     */
    public function getEmail(): string
    {
        return (string) $this->required('email');
    }
}
