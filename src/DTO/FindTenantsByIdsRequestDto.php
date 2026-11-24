<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class FindTenantsByIdsRequestDto extends AbstractDto
{
    /**
     * List of tenant ids
     *
     * @return list<string>
     */
    public function getIds(): array
    {
        return array_values(array_map('strval', (array) ($this->data['ids'] ?? [])));
    }

    /**
     * Set the "ids" field. List of tenant ids
     *
     * @param list<string>|null $value
     * @return static
     */
    public function withIds(?array $value): static
    {
        return $this->with('ids', $value);
    }
}
