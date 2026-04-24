<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class UpdateEsetPartnerRequestDto extends AbstractDto
{
    /**
     * ESET PROTECT region
     *
     * @return string|null
     */
    public function getProtectRegion(): ?string
    {
        $v = $this->data['protectRegion'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Set the "protectRegion" field. ESET PROTECT region
     *
     * @return static
     */
    public function withProtectRegion(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('protectRegion', $value);
    }

    /**
     * Management type of the partner
     *
     * @return string|null
     */
    public function getManagementType(): ?string
    {
        $v = $this->data['managementType'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Set the "managementType" field. Management type of the partner
     *
     * @return static
     */
    public function withManagementType(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('managementType', $value);
    }
}
