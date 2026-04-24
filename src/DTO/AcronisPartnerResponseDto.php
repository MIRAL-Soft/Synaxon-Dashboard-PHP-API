<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class AcronisPartnerResponseDto extends AbstractDto
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
     * The name of the partner
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->data['name'];
    }

    /**
     * The acronis tenantId of the partner
     *
     * @return string
     */
    public function getVendorId(): string
    {
        return (string) $this->data['vendorId'];
    }

    /**
     * The tenantId of the partner
     *
     * @return string
     */
    public function getTenantId(): string
    {
        return (string) $this->data['tenantId'];
    }

    /**
     * The type of the partner
     *
     * @return string
     */
    public function getType(): string
    {
        return (string) $this->data['type'];
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
     * The metrics of the partner
     *
     * @return mixed
     */
    public function getMetrics(): mixed
    {
        return $this->data['metrics'] ?? null;
    }
}
