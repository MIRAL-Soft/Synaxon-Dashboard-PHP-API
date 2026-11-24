<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CreateCoveCustomerRequestDto extends AbstractDto
{
    /**
     * The customer file id of the customer
     *
     * @return float|null
     */
    public function getCustomerId(): ?float
    {
        $v = $this->data['customerId'] ?? null;
        return $v === null ? null : (float) $v;
    }

    /**
     * Set the "customerId" field. The customer file id of the customer
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
