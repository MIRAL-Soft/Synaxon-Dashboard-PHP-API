<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CloudallyCustomerStatsDto extends AbstractDto
{
    /**
     * @return array<string, mixed>
     */
    public function getCustomerId(): array
    {
        return (array) ($this->data['customerId'] ?? []);
    }

    /**
     * @return string
     */
    public function getCustomerName(): string
    {
        return (string) $this->required('customerName');
    }

    /**
     * Total number of statuses for this customer
     *
     * @return float
     */
    public function getTotal(): float
    {
        return (float) $this->required('total');
    }

    /**
     * Number of statuses with errors (non-active)
     *
     * @return float
     */
    public function getErrors(): float
    {
        return (float) $this->required('errors');
    }
}
