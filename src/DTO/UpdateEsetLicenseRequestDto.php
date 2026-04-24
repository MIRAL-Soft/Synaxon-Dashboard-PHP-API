<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class UpdateEsetLicenseRequestDto extends AbstractDto
{
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
