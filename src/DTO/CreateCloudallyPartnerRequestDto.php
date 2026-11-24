<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CreateCloudallyPartnerRequestDto extends AbstractDto
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
     * The email address for partner account
     *
     * @return string
     */
    public function getEmail(): string
    {
        return (string) $this->required('email');
    }

    /**
     * Set the "email" field. The email address for partner account
     *
     * @return static
     */
    public function withEmail(?string $value): static
    {
        return $this->with('email', $value);
    }

    /**
     * The name of the contact
     *
     * @return string
     */
    public function getContact(): string
    {
        return (string) $this->required('contact');
    }

    /**
     * Set the "contact" field. The name of the contact
     *
     * @return static
     */
    public function withContact(?string $value): static
    {
        return $this->with('contact', $value);
    }
}
