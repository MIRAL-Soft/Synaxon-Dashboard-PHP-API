<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class DeployPatchesBulkRequestDto extends AbstractDto
{
    /**
     * Patch IDs to deploy
     *
     * @return list<float>
     */
    public function getPatchIds(): array
    {
        return array_values(array_map('floatval', (array) ($this->data['patchIds'] ?? [])));
    }

    /**
     * Set the "patchIds" field. Patch IDs to deploy
     *
     * @param list<float>|null $value
     * @return static
     */
    public function withPatchIds(?array $value): static
    {
        return $this->with('patchIds', $value);
    }

    /**
     * Patch deployment status
     *
     * @return string
     */
    public function getStatus(): string
    {
        return (string) $this->required('status');
    }

    /**
     * Set the "status" field. Patch deployment status
     *
     * @return static
     */
    public function withStatus(?string $value): static
    {
        return $this->with('status', $value);
    }

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
