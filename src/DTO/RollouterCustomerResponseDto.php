<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class RollouterCustomerResponseDto extends AbstractDto
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
     * @return string
     */
    public function getTenantId(): string
    {
        return (string) $this->required('tenantId');
    }

    /**
     * @return string
     */
    public function getParentId(): string
    {
        return (string) $this->required('parentId');
    }

    /**
     * @return float|null
     */
    public function getCustomerId(): ?float
    {
        $v = $this->data['customerId'] ?? null;
        return $v === null ? null : (float) $v;
    }

    /**
     * Rollouter Rollout ID
     *
     * @return string
     */
    public function getVendorId(): string
    {
        return (string) $this->required('vendorId');
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->required('name');
    }

    /**
     * @return string
     */
    public function getIdentifier(): string
    {
        return (string) $this->required('identifier');
    }

    /**
     * @return float
     */
    public function getPlan(): float
    {
        return (float) $this->required('plan');
    }

    /**
     * @return float
     */
    public function getClientLimit(): float
    {
        return (float) $this->required('clientLimit');
    }

    /**
     * @return bool
     */
    public function getIsActivated(): bool
    {
        return (bool) $this->required('isActivated');
    }
}
