<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CreateApiTokenRequestDto extends AbstractDto
{
    /**
     * Grant type
     *
     * @return string
     */
    public function getGrantType(): string
    {
        return (string) $this->data['grant_type'];
    }

    /**
     * Set the "grant_type" field. Grant type
     *
     * @return static
     */
    public function withGrantType(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('grant_type', $value);
    }

    /**
     * Scope
     *
     * @return string
     */
    public function getScope(): string
    {
        return (string) $this->data['scope'];
    }

    /**
     * Set the "scope" field. Scope
     *
     * @return static
     */
    public function withScope(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('scope', $value);
    }
}
