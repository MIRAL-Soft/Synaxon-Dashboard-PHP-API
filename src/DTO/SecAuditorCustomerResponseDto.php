<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class SecAuditorCustomerResponseDto extends AbstractDto
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
     * The tenant id of the customer
     *
     * @return string
     */
    public function getTenantId(): string
    {
        return (string) $this->data['tenantId'];
    }

    /**
     * The vendor id of the customer in Sec Auditor
     *
     * @return string
     */
    public function getVendorId(): string
    {
        return (string) $this->data['vendorId'];
    }

    /**
     * The display name of the customer
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->data['name'];
    }

    /**
     * Customer file id
     *
     * @return float
     */
    public function getCustomerId(): float
    {
        return (float) $this->data['customerId'];
    }

    /**
     * The number of employees at the customer
     *
     * @return float
     */
    public function getEmployees(): float
    {
        return (float) $this->data['employees'];
    }

    /**
     * Parent identifier in Sec Auditor hierarchy
     *
     * @return string
     */
    public function getParentId(): string
    {
        return (string) $this->data['parentId'];
    }

    /**
     * Creation status of the customer in Sec Auditor
     *
     * @return string
     */
    public function getCreationStatus(): string
    {
        return (string) $this->data['creationStatus'];
    }

    /**
     * Operating mode of the customer in Sec Auditor
     *
     * @return string
     */
    public function getMode(): string
    {
        return (string) $this->data['mode'];
    }

    /**
     * Billing mode for the Sec Auditor customer
     *
     * @return string
     */
    public function getBillingCycle(): string
    {
        return (string) $this->data['billingCycle'];
    }

    /**
     * Indicates if this is an NFR (not-for-resale) customer
     *
     * @return bool
     */
    public function getNfr(): bool
    {
        return (bool) $this->data['nfr'];
    }
}
