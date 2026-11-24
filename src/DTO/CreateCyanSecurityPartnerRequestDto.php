<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CreateCyanSecurityPartnerRequestDto extends AbstractDto
{
    /**
     * @return string
     */
    public function getTenantId(): string
    {
        return (string) $this->required('tenantId');
    }

    /**
     * Set the "tenantId" field.
     *
     * @return static
     */
    public function withTenantId(?string $value): static
    {
        return $this->with('tenantId', $value);
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return (string) $this->required('email');
    }

    /**
     * Set the "email" field.
     *
     * @return static
     */
    public function withEmail(?string $value): static
    {
        return $this->with('email', $value);
    }
}
