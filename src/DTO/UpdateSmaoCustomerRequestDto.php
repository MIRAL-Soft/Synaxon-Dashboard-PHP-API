<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class UpdateSmaoCustomerRequestDto extends AbstractDto
{
    /**
     * The customer id (set to null to remove reference)
     *
     * @return float|null
     */
    public function getCustomerId(): ?float
    {
        $v = $this->data['customerId'] ?? null;
        return $v === null ? null : (float) $v;
    }

    /**
     * Set the "customerId" field. The customer id (set to null to remove reference)
     *
     * @return static
     */
    public function withCustomerId(?float $value): static
    {
        return $this->with('customerId', $value);
    }
}
