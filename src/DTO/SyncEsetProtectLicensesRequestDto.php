<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class SyncEsetProtectLicensesRequestDto extends AbstractDto
{
    /**
     * ESET PROTECT region
     *
     * @return string
     */
    public function getRegion(): string
    {
        return (string) $this->data['region'];
    }

    /**
     * Force sync
     *
     * @return bool|null
     */
    public function getForce(): ?bool
    {
        $v = $this->data['force'] ?? null;
        return $v === null ? null : (bool) $v;
    }
}
