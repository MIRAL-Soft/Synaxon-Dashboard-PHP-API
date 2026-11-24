<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class UpdateRollouterCustomerRequestDto extends AbstractDto
{
    /**
     * Customer id reference; set to null to remove it
     *
     * @return float|null
     */
    public function getCustomerId(): ?float
    {
        $v = $this->data['customerId'] ?? null;
        return $v === null ? null : (float) $v;
    }

    /**
     * Set the "customerId" field. Customer id reference; set to null to remove it
     *
     * @return static
     */
    public function withCustomerId(?float $value): static
    {
        return $this->with('customerId', $value);
    }
}
