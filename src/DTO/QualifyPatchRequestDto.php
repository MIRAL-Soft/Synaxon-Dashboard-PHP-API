<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class QualifyPatchRequestDto extends AbstractDto
{
    /**
     * Patch qualification status
     *
     * @return string
     */
    public function getStatus(): string
    {
        return (string) $this->data['status'];
    }

    /**
     * Patch qualification reason
     *
     * @return string|null
     */
    public function getReason(): ?string
    {
        $v = $this->data['reason'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Patch qualification url
     *
     * @return string|null
     */
    public function getUrl(): ?string
    {
        $v = $this->data['url'] ?? null;
        return $v === null ? null : (string) $v;
    }
}
