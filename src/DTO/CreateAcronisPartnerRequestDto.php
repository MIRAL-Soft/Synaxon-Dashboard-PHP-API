<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CreateAcronisPartnerRequestDto extends AbstractDto
{
    /**
     * The tenantId of the partner
     *
     * @return string
     */
    public function getTenantId(): string
    {
        return (string) $this->required('tenantId');
    }

    /**
     * Set the "tenantId" field. The tenantId of the partner
     *
     * @return static
     */
    public function withTenantId(?string $value): static
    {
        return $this->with('tenantId', $value);
    }

    /**
     * The type of the partner
     *
     * @return string
     */
    public function getType(): string
    {
        return (string) $this->required('type');
    }

    /**
     * Set the "type" field. The type of the partner
     *
     * @return static
     */
    public function withType(?string $value): static
    {
        return $this->with('type', $value);
    }

    /**
     * The email address for first user
     *
     * @return string
     */
    public function getEmail(): string
    {
        return (string) $this->required('email');
    }

    /**
     * Set the "email" field. The email address for first user
     *
     * @return static
     */
    public function withEmail(?string $value): static
    {
        return $this->with('email', $value);
    }
}
