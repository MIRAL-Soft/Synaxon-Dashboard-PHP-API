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
     * The vendor id of the customer in Sec Auditor
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
     * @return float
     */
    public function getCustomerId(): float
    {
        return (float) $this->required('customerId');
    }

    /**
     * The number of employees at the customer
     *
     * @return float
     */
    public function getEmployees(): float
    {
        return (float) $this->required('employees');
    }

    /**
     * Parent identifier in Sec Auditor hierarchy
     *
     * @return string
     */
    public function getParentId(): string
    {
        return (string) $this->required('parentId');
    }

    /**
     * Creation status of the customer in Sec Auditor
     *
     * @return string
     */
    public function getCreationStatus(): string
    {
        return (string) $this->required('creationStatus');
    }

    /**
     * Operating mode of the customer in Sec Auditor
     *
     * @return string
     */
    public function getMode(): string
    {
        return (string) $this->required('mode');
    }

    /**
     * Billing mode for the Sec Auditor customer
     *
     * @return string
     */
    public function getBillingCycle(): string
    {
        return (string) $this->required('billingCycle');
    }

    /**
     * Indicates if this is an NFR (not-for-resale) customer
     *
     * @return bool
     */
    public function getNfr(): bool
    {
        return (bool) $this->required('nfr');
    }
}
