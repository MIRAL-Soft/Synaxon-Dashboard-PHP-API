<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CreateAcronisCustomerRequestDto extends AbstractDto
{
    /**
     * The id of the customer
     *
     * @return float|null
     */
    public function getCustomerId(): ?float
    {
        $v = $this->data['customerId'] ?? null;
        return $v === null ? null : (float) $v;
    }

    /**
     * Set the "customerId" field. The id of the customer
     *
     * @return static
     */
    public function withCustomerId(?float $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('customerId', $value);
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
     * The name of the customer
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->data['name'];
    }

    /**
     * Set the "name" field. The name of the customer
     *
     * @return static
     */
    public function withName(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('name', $value);
    }

    /**
     * The type of the customer
     *
     * @return string
     */
    public function getType(): string
    {
        return (string) $this->data['type'];
    }

    /**
     * Set the "type" field. The type of the customer
     *
     * @return static
     */
    public function withType(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('type', $value);
    }

    /**
     * The storage location of the customer
     *
     * @return string
     */
    public function getStorage(): string
    {
        return (string) $this->data['storage'];
    }

    /**
     * Set the "storage" field. The storage location of the customer
     *
     * @return static
     */
    public function withStorage(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('storage', $value);
    }
}
