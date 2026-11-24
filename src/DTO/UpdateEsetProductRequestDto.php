<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class UpdateEsetProductRequestDto extends AbstractDto
{
    /**
     * @return bool|null
     */
    public function getActivatable(): ?bool
    {
        $v = $this->data['activatable'] ?? null;
        return $v === null ? null : (bool) $v;
    }

    /**
     * Set the "activatable" field.
     *
     * @return static
     */
    public function withActivatable(?bool $value): static
    {
        return $this->with('activatable', $value);
    }

    /**
     * @return bool|null
     */
    public function getBookable(): ?bool
    {
        $v = $this->data['bookable'] ?? null;
        return $v === null ? null : (bool) $v;
    }

    /**
     * Set the "bookable" field.
     *
     * @return static
     */
    public function withBookable(?bool $value): static
    {
        return $this->with('bookable', $value);
    }

    /**
     * @return bool|null
     */
    public function getFullService(): ?bool
    {
        $v = $this->data['fullService'] ?? null;
        return $v === null ? null : (bool) $v;
    }

    /**
     * Set the "fullService" field.
     *
     * @return static
     */
    public function withFullService(?bool $value): static
    {
        return $this->with('fullService', $value);
    }

    /**
     * Default sorting priority; higher values appear first
     *
     * @return float|null
     */
    public function getSortPriority(): ?float
    {
        $v = $this->data['sortPriority'] ?? null;
        return $v === null ? null : (float) $v;
    }

    /**
     * Set the "sortPriority" field. Default sorting priority; higher values appear first
     *
     * @return static
     */
    public function withSortPriority(?float $value): static
    {
        return $this->with('sortPriority', $value);
    }
}
