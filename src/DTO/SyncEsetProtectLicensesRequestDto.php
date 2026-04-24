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
     * Set the "region" field. ESET PROTECT region
     *
     * @return static
     */
    public function withRegion(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('region', $value);
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

    /**
     * Set the "force" field. Force sync
     *
     * @return static
     */
    public function withForce(?bool $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('force', $value);
    }
}
