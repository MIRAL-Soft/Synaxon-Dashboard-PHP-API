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
     * The name of the partner
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->required('name');
    }

    /**
     * The acronis tenantId of the partner
     *
     * @return string
     */
    public function getVendorId(): string
    {
        return (string) $this->required('vendorId');
    }

    /**
     * The tenantId of the partner
     *
     * @return string
     */
    public function getTenantId(): string
    {
        return (string) $this->required('tenantId');
    }

    /**
     * The type of the partner
     *
     * @return string
     */
    public function getType(): string
    {
        return (string) $this->required('type');
    }

    /**
     * If access is enabled for the partner
     *
     * @return bool
     */
    public function getRestrictedAccess(): bool
    {
        return (bool) $this->required('restrictedAccess');
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
