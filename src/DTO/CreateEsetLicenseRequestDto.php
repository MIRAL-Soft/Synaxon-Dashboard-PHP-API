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
     * Product code
     *
     * @return string
     */
    public function getProductCode(): string
    {
        return (string) $this->data['productCode'];
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
}
