<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CreateEsetCustomerRequestDto extends AbstractDto
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
     * The email address
     *
     * @return string|null
     */
    public function getEmail(): ?string
    {
        $v = $this->data['email'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Set the "email" field. The email address
     *
     * @return static
     */
    public function withEmail(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('email', $value);
    }
}
