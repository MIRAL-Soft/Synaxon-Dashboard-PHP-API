<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CreateGuardian360CustomerRequestDto extends AbstractDto
{
    /**
     * The customer id reference
     *
     * @return float|null
     */
    public function getCustomerId(): ?float
    {
        $v = $this->data['customerId'] ?? null;
        return $v === null ? null : (float) $v;
    }

    /**
     * Set the "customerId" field. The customer id reference
     *
     * @return static
     */
    public function withCustomerId(?float $value): static
    {
        return $this->with('customerId', $value);
    }

    /**
     * The name of the customer
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->required('name');
    }

    /**
     * Set the "name" field. The name of the customer
     *
     * @return static
     */
    public function withName(?string $value): static
    {
        return $this->with('name', $value);
    }

    /**
     * The email of the customer owner
     *
     * @return string
     */
    public function getEmail(): string
    {
        return (string) $this->required('email');
    }

    /**
     * Set the "email" field. The email of the customer owner
     *
     * @return static
     */
    public function withEmail(?string $value): static
    {
        return $this->with('email', $value);
    }

    /**
     * The phone number of the customer
     *
     * @return string
     */
    public function getPhone(): string
    {
        return (string) $this->required('phone');
    }

    /**
     * Set the "phone" field. The phone number of the customer
     *
     * @return static
     */
    public function withPhone(?string $value): static
    {
        return $this->with('phone', $value);
    }

    /**
     * The firstname of the customer owner
     *
     * @return string
     */
    public function getFirstname(): string
    {
        return (string) $this->required('firstname');
    }

    /**
     * Set the "firstname" field. The firstname of the customer owner
     *
     * @return static
     */
    public function withFirstname(?string $value): static
    {
        return $this->with('firstname', $value);
    }

    /**
     * The lastname of the customer owner
     *
     * @return string
     */
    public function getLastname(): string
    {
        return (string) $this->required('lastname');
    }

    /**
     * Set the "lastname" field. The lastname of the customer owner
     *
     * @return static
     */
    public function withLastname(?string $value): static
    {
        return $this->with('lastname', $value);
    }
}
