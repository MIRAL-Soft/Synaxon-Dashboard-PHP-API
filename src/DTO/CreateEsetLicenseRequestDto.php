<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CreateEsetLicenseRequestDto extends AbstractDto
{
    /**
     * Customer id
     *
     * @return string
     */
    public function getCustomerId(): string
    {
        return (string) $this->data['customerId'];
    }

    /**
     * Set the "customerId" field. Customer id
     *
     * @return static
     */
    public function withCustomerId(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('customerId', $value);
    }

    /**
     * Product code
     *
     * @return string
     */
    public function getProductCode(): string
    {
        return (string) $this->data['productCode'];
    }

    /**
     * Set the "productCode" field. Product code
     *
     * @return static
     */
    public function withProductCode(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('productCode', $value);
    }

    /**
     * Quantity
     *
     * @return float
     */
    public function getQuantity(): float
    {
        return (float) $this->data['quantity'];
    }

    /**
     * Set the "quantity" field. Quantity
     *
     * @return static
     */
    public function withQuantity(?float $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('quantity', $value);
    }
}
