<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class DeployPatchesRequestDto extends AbstractDto
{
    /**
     * Patch deployment status
     *
     * @return string
     */
    public function getStatus(): string
    {
        return (string) $this->data['status'];
    }

    /**
     * Set the "status" field. Patch deployment status
     *
     * @return static
     */
    public function withStatus(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('status', $value);
    }

    /**
     * Site IDs
     *
     * @return list<string>
     */
    public function getSiteIds(): array
    {
        return (array) ($this->data['siteIds'] ?? []);
    }

    /**
     * Set the "siteIds" field. Site IDs
     *
     * @return static
     */
    public function withSiteIds(?array $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('siteIds', $value);
    }

    /**
     * Patch IDs
     *
     * @return list<float>
     */
    public function getPatchIds(): array
    {
        return (array) ($this->data['patchIds'] ?? []);
    }

    /**
     * Set the "patchIds" field. Patch IDs
     *
     * @return static
     */
    public function withPatchIds(?array $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('patchIds', $value);
    }
}
