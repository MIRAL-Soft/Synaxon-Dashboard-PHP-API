<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class LywandCustomerStatsItemDto extends AbstractDto
{
    /**
     * Customer ID (null if not linked)
     *
     * @return float
     */
    public function getCustomerId(): float
    {
        return (float) $this->required('customerId');
    }

    /**
     * Customer name
     *
     * @return string
     */
    public function getCustomerName(): string
    {
        return (string) $this->required('customerName');
    }

    /**
     * Total number of customers (always 1 per entry)
     *
     * @return float
     */
    public function getTotal(): float
    {
        return (float) $this->required('total');
    }

    /**
     * Number of customers with high vulnerabilities
     *
     * @return float
     */
    public function getErrors(): float
    {
        return (float) $this->required('errors');
    }
}
