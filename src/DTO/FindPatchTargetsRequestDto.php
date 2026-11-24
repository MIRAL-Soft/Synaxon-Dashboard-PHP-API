<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class FindPatchTargetsRequestDto extends AbstractDto
{
    /**
     * Target scope for patch deployment
     *
     * @return string
     */
    public function getTargetScope(): string
    {
        return (string) $this->required('targetScope');
    }

    /**
     * Set the "targetScope" field. Target scope for patch deployment
     *
     * @return static
     */
    public function withTargetScope(?string $value): static
    {
        return $this->with('targetScope', $value);
    }

    /**
     * Filters for targeting specific devices or sites
     *
     * @return mixed|null
     */
    public function getFilters(): mixed
    {
        return $this->data['filters'] ?? null;
    }

    /**
     * Set the "filters" field. Filters for targeting specific devices or sites
     *
     * @return static
     */
    public function withFilters(mixed $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('filters', $value);
    }
}
