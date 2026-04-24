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
     * Set the "status" field. Patch qualification status
     *
     * @return static
     */
    public function withStatus(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('status', $value);
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
     * Set the "reason" field. Patch qualification reason
     *
     * @return static
     */
    public function withReason(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('reason', $value);
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

    /**
     * Set the "url" field. Patch qualification url
     *
     * @return static
     */
    public function withUrl(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('url', $value);
    }
}
