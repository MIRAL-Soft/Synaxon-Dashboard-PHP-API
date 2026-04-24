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
     * The eset id of the partner
     *
     * @return string
     */
    public function getVendorId(): string
    {
        return (string) $this->data['vendorId'];
    }

    /**
     * The type of the partner
     *
     * @return float
     */
    public function getType(): float
    {
        return (float) $this->data['type'];
    }

    /**
     * The status of the partner
     *
     * @return float
     */
    public function getStatus(): float
    {
        return (float) $this->data['status'];
    }

    /**
     * The tenant id of the partner
     *
     * @return string
     */
    public function getTenantId(): string
    {
        return (string) $this->data['tenantId'];
    }

    /**
     * The email of the partner
     *
     * @return string
     */
    public function getEmail(): string
    {
        return (string) $this->data['email'];
    }

    /**
     * The protect region of the partner
     *
     * @return string
     */
    public function getProtectRegion(): string
    {
        return (string) $this->data['protectRegion'];
    }

    /**
     * The management type of the partner
     *
     * @return string
     */
    public function getManagementType(): string
    {
        return (string) $this->data['managementType'];
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
