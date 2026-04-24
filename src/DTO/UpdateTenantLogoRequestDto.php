<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class UpdateTenantLogoRequestDto extends AbstractDto
{
    /**
     * Tenant logo
     *
     * @return string
     */
    public function getLogo(): string
    {
        return (string) $this->data['logo'];
    }

    /**
     * Set the "logo" field. Tenant logo
     *
     * @return static
     */
    public function withLogo(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('logo', $value);
    }
}
