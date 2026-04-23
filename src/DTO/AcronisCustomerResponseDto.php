<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class AcronisCustomerResponseDto extends AbstractDto
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
     * The customer id of the customer
     *
     * @return float
     */
    public function getCustomerId(): float
    {
        return (float) $this->data['customerId'];
    }

    /**
     * The name of the customer
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->data['name'];
    }

    /**
     * The acronis tenantId of the customer
     *
     * @return string
     */
    public function getVendorId(): string
    {
        return (string) $this->data['vendorId'];
    }

    /**
     * The acronis legacy ID of the customer (cached from resolveId call)
     *
     * @return string|null
     */
    public function getVendorLegacyId(): ?string
    {
        $v = $this->data['vendorLegacyId'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * If access is enabled for the partner
     *
     * @return bool
     */
    public function getRestrictedAccess(): bool
    {
        return (bool) $this->data['restrictedAccess'];
    }

    /**
     * The tenantId of the customer
     *
     * @return string
     */
    public function getTenantId(): string
    {
        return (string) $this->data['tenantId'];
    }

    /**
     * The acronis partnerId of the customer
     *
     * @return string
     */
    public function getParentId(): string
    {
        return (string) $this->data['parentId'];
    }

    /**
     * The type of the customer
     *
     * @return string
     */
    public function getType(): string
    {
        return (string) $this->data['type'];
    }

    /**
     * The metrics of the customer
     *
     * @return mixed
     */
    public function getMetrics(): mixed
    {
        return $this->data['metrics'] ?? null;
    }
}
