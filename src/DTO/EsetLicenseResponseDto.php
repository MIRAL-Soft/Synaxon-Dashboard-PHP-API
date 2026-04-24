<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class EsetLicenseResponseDto extends AbstractDto
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
     * The tenant id of the license
     *
     * @return string
     */
    public function getTenantId(): string
    {
        return (string) $this->data['tenantId'];
    }

    /**
     * The customer id of the license
     *
     * @return string
     */
    public function getCustomerId(): string
    {
        return (string) $this->data['customerId'];
    }

    /**
     * The eset customer id of the license
     *
     * @return string
     */
    public function getParentId(): string
    {
        return (string) $this->data['parentId'];
    }

    /**
     * The public license key of the license
     *
     * @return string
     */
    public function getPublicLicenseKey(): string
    {
        return (string) $this->data['publicLicenseKey'];
    }

    /**
     * The product code of the license
     *
     * @return string
     */
    public function getProductCode(): string
    {
        return (string) $this->data['productCode'];
    }

    /**
     * The product name of the license
     *
     * @return string
     */
    public function getProductName(): string
    {
        return (string) $this->data['productName'];
    }

    /**
     * The quantity of the license
     *
     * @return float
     */
    public function getQuantity(): float
    {
        return (float) $this->data['quantity'];
    }

    /**
     * The usage of the license
     *
     * @return float
     */
    public function getUsage(): float
    {
        return (float) $this->data['usage'];
    }

    /**
     * The state of the license
     *
     * @return float
     */
    public function getState(): float
    {
        return (float) $this->data['state'];
    }

    /**
     * If the license is trial
     *
     * @return bool
     */
    public function getTrial(): bool
    {
        return (bool) $this->data['trial'];
    }

    /**
     * The trial expiration of the license
     *
     * @return string|null
     */
    public function getTrialExpiration(): ?string
    {
        $v = $this->data['trialExpiration'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * The bundle products of the license
     *
     * @return list<string>
     */
    public function getBundleProducts(): array
    {
        return (array) ($this->data['bundleProducts'] ?? []);
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
}
