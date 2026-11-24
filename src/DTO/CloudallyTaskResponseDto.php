<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CloudallyTaskResponseDto extends AbstractDto
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
     * The tenant ID
     *
     * @return string
     */
    public function getTenantId(): string
    {
        return (string) $this->required('tenantId');
    }

    /**
     * The ID of the corresponding Cloudally customer
     *
     * @return string
     */
    public function getParentId(): string
    {
        return (string) $this->required('parentId');
    }

    /**
     * The vendor-side task ID
     *
     * @return string
     */
    public function getVendorId(): string
    {
        return (string) $this->required('vendorId');
    }

    /**
     * The type of the task
     *
     * @return string
     */
    public function getType(): string
    {
        return (string) $this->required('type');
    }

    /**
     * The status of the task
     *
     * @return string
     */
    public function getStatus(): string
    {
        return (string) $this->required('status');
    }

    /**
     * The display name (alias) of the task
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->required('name');
    }

    /**
     * The account associated with the task
     *
     * @return string
     */
    public function getAccount(): string
    {
        return (string) $this->required('account');
    }

    /**
     * The task size in bytes
     *
     * @return float
     */
    public function getSize(): float
    {
        return (float) $this->required('size');
    }

    /**
     * The scheduled next backup date
     *
     * @return string|null
     */
    public function getNextBackup(): ?string
    {
        $v = $this->data['nextBackup'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * The region of the task
     *
     * @return string|null
     */
    public function getRegion(): ?string
    {
        $v = $this->data['region'] ?? null;
        return $v === null ? null : (string) $v;
    }
}
