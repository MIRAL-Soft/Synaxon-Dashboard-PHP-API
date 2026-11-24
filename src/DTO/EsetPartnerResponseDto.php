<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class EsetPartnerResponseDto extends AbstractDto
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
     * The eset id of the partner
     *
     * @return string
     */
    public function getVendorId(): string
    {
        return (string) $this->required('vendorId');
    }

    /**
     * The type of the partner
     *
     * @return float
     */
    public function getType(): float
    {
        return (float) $this->required('type');
    }

    /**
     * The status of the partner
     *
     * @return float
     */
    public function getStatus(): float
    {
        return (float) $this->required('status');
    }

    /**
     * The tenant id of the partner
     *
     * @return string
     */
    public function getTenantId(): string
    {
        return (string) $this->required('tenantId');
    }

    /**
     * The email of the partner
     *
     * @return string
     */
    public function getEmail(): string
    {
        return (string) $this->required('email');
    }

    /**
     * The protect region of the partner
     *
     * @return string
     */
    public function getProtectRegion(): string
    {
        return (string) $this->required('protectRegion');
    }

    /**
     * The management type of the partner
     *
     * @return string
     */
    public function getManagementType(): string
    {
        return (string) $this->required('managementType');
    }

    /**
     * The license statistics of the partner
     *
     * @return list<EsetLicenseStat>
     */
    public function getLicenseStats(): array
    {
        $out = [];
        foreach ((array) ($this->data['licenseStats'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = EsetLicenseStat::fromArray($item);
            } elseif ($item instanceof EsetLicenseStat) {
                $out[] = $item;
            }
        }
        return $out;
    }
}
