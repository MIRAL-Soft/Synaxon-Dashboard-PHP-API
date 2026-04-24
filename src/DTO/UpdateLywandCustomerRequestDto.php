<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class UpdateLywandCustomerRequestDto extends AbstractDto
{
    /**
     * Lywand Partner name
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        $v = $this->data['name'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Set the "name" field. Lywand Partner name
     *
     * @return static
     */
    public function withName(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('name', $value);
    }

    /**
     * Customer id of customer file
     *
     * @return float|null
     */
    public function getCustomerId(): ?float
    {
        $v = $this->data['customerId'] ?? null;
        return $v === null ? null : (float) $v;
    }

    /**
     * Set the "customerId" field. Customer id of customer file
     *
     * @return static
     */
    public function withCustomerId(?float $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('customerId', $value);
    }
}
