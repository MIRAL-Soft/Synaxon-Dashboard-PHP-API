<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CreateRollouterPartnerRequestDto extends AbstractDto
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

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return (string) $this->required('firstname');
    }

    /**
     * Set the "firstname" field.
     *
     * @return static
     */
    public function withFirstname(?string $value): static
    {
        return $this->with('firstname', $value);
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return (string) $this->required('lastname');
    }

    /**
     * Set the "lastname" field.
     *
     * @return static
     */
    public function withLastname(?string $value): static
    {
        return $this->with('lastname', $value);
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return (string) $this->required('password');
    }

    /**
     * Set the "password" field.
     *
     * @return static
     */
    public function withPassword(?string $value): static
    {
        return $this->with('password', $value);
    }
}
