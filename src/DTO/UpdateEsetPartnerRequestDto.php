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
     * Management type of the partner
     *
     * @return string|null
     */
    public function getManagementType(): ?string
    {
        $v = $this->data['managementType'] ?? null;
        return $v === null ? null : (string) $v;
    }
}
