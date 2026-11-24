<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CreateCovePartnerRequestDto extends AbstractDto
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

    /**
     * The name of the partner
     *
     * @return string
     */
    public function getFirstname(): string
    {
        return (string) $this->required('firstname');
    }

    /**
     * Set the "firstname" field. The name of the partner
     *
     * @return static
     */
    public function withFirstname(?string $value): static
    {
        return $this->with('firstname', $value);
    }

    /**
     * The lastname of the first user
     *
     * @return string
     */
    public function getLastname(): string
    {
        return (string) $this->required('lastname');
    }

    /**
     * Set the "lastname" field. The lastname of the first user
     *
     * @return static
     */
    public function withLastname(?string $value): static
    {
        return $this->with('lastname', $value);
    }
}
