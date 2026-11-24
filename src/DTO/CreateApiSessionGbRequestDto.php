<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CreateApiSessionGbRequestDto extends AbstractDto
{
    /**
     * Grant type
     *
     * @return string
     */
    public function getGrantType(): string
    {
        return (string) $this->required('grant_type');
    }

    /**
     * Set the "grant_type" field. Grant type
     *
     * @return static
     */
    public function withGrantType(?string $value): static
    {
        return $this->with('grant_type', $value);
    }

    /**
     * Scope
     *
     * @return string
     */
    public function getScope(): string
    {
        return (string) $this->required('scope');
    }

    /**
     * Set the "scope" field. Scope
     *
     * @return static
     */
    public function withScope(?string $value): static
    {
        return $this->with('scope', $value);
    }
}
