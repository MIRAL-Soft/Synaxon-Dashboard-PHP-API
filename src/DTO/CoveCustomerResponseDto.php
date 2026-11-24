<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CoveCustomerResponseDto extends AbstractDto
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
     * The tenant id of the customer
     *
     * @return string
     */
    public function getTenantId(): string
    {
        return (string) $this->required('tenantId');
    }

    /**
     * The vendor id of the customer in Cove
     *
     * @return string
     */
    public function getVendorId(): string
    {
        return (string) $this->required('vendorId');
    }

    /**
     * The display name of the customer
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->required('name');
    }

    /**
     * Customer file id
     *
     * @return float|null
     */
    public function getCustomerId(): ?float
    {
        $v = $this->data['customerId'] ?? null;
        return $v === null ? null : (float) $v;
    }

    /**
     * Parent identifier in Cove hierarchy
     *
     * @return string
     */
    public function getParentId(): string
    {
        return (string) $this->required('parentId');
    }

    /**
     * Whether the customer is in trial mode
     *
     * @return bool
     */
    public function getIsTrial(): bool
    {
        return (bool) $this->required('isTrial');
    }
}
