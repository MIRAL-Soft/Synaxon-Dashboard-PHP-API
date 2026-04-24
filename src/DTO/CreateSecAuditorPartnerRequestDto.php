<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CreateSecAuditorPartnerRequestDto extends AbstractDto
{
    /**
     * The tenantId of the partner
     *
     * @return string
     */
    public function getTenantId(): string
    {
        return (string) $this->data['tenantId'];
    }

    /**
     * Set the "tenantId" field. The tenantId of the partner
     *
     * @return static
     */
    public function withTenantId(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('tenantId', $value);
    }

    /**
     * The type of the partner
     *
     * @return string
     */
    public function getType(): string
    {
        return (string) $this->data['type'];
    }

    /**
     * Set the "type" field. The type of the partner
     *
     * @return static
     */
    public function withType(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('type', $value);
    }

    /**
     * The email address for first user
     *
     * @return string
     */
    public function getEmail(): string
    {
        return (string) $this->data['email'];
    }

    /**
     * Set the "email" field. The email address for first user
     *
     * @return static
     */
    public function withEmail(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('email', $value);
    }

    /**
     * The firstname of the first user
     *
     * @return string
     */
    public function getFirstname(): string
    {
        return (string) $this->data['firstname'];
    }

    /**
     * Set the "firstname" field. The firstname of the first user
     *
     * @return static
     */
    public function withFirstname(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('firstname', $value);
    }

    /**
     * The lastname of the first user
     *
     * @return string
     */
    public function getLastname(): string
    {
        return (string) $this->data['lastname'];
    }

    /**
     * Set the "lastname" field. The lastname of the first user
     *
     * @return static
     */
    public function withLastname(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('lastname', $value);
    }
}
