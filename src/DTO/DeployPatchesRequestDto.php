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
     * Site IDs
     *
     * @return list<string>
     */
    public function getSiteIds(): array
    {
        return (array) ($this->data['siteIds'] ?? []);
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
}
