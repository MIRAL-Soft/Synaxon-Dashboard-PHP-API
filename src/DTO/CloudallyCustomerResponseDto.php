<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CloudallyCustomerResponseDto extends AbstractDto
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
     * The customer ID
     *
     * @return float
     */
    public function getCustomerId(): float
    {
        return (float) $this->required('customerId');
    }

    /**
     * The name of the customer
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->required('name');
    }

    /**
     * The tenant ID of the customer
     *
     * @return string
     */
    public function getTenantId(): string
    {
        return (string) $this->required('tenantId');
    }

    /**
     * The parent partner ID of the customer
     *
     * @return string
     */
    public function getParentId(): string
    {
        return (string) $this->required('parentId');
    }

    /**
     * The vendor ID of the customer
     *
     * @return string
     */
    public function getVendorId(): string
    {
        return (string) $this->required('vendorId');
    }

    /**
     * The storage metrics of the customer by source
     *
     * @return array<string, mixed>
     */
    public function getMetrics(): array
    {
        return (array) ($this->data['metrics'] ?? []);
    }
}
