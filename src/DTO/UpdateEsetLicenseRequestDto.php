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
}
