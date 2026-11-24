<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class AcronisPolicyResponseDto extends AbstractDto
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
     * The name of the policy
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->required('name');
    }

    /**
     * The count associated with the policy
     *
     * @return float
     */
    public function getCount(): float
    {
        return (float) $this->required('count');
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
     * The Acronis ID
     *
     * @return string
     */
    public function getVendorId(): string
    {
        return (string) $this->required('vendorId');
    }

    /**
     * Retention settings for the policy
     *
     * @return array<string, mixed>
     */
    public function getRetention(): array
    {
        return (array) ($this->data['retention'] ?? []);
    }
}
