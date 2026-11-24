<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class UpdateCoveCustomerRequestDto extends AbstractDto
{
    /**
     * Customer file id
     *
     * @return float|null
     */
    public function getCustomerId(): ?float
    {
        $v = $this->data['customerId'] ?? null;
        return $v === null ? null : (float) $v;
    }

    /**
     * Set the "customerId" field. Customer file id
     *
     * @return static
     */
    public function withCustomerId(?float $value): static
    {
        return $this->with('customerId', $value);
    }
}
