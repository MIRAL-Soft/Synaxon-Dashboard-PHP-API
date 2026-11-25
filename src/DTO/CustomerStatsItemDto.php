<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CustomerStatsItemDto extends AbstractDto
{
    /**
     * Customer ID (null if not linked)
     *
     * @return float|null
     */
    public function getCustomerId(): ?float
    {
        $v = $this->requiredNullable('customerId');
        return $v === null ? null : (float) $v;
    }

    /**
     * Customer name (from site name)
     *
     * @return string
     */
    public function getCustomerName(): string
    {
        return (string) $this->required('customerName');
    }

    /**
     * Total number of sites for this customer
     *
     * @return float
     */
    public function getTotal(): float
    {
        return (float) $this->required('total');
    }

    /**
     * Number of sites with failing checks
     *
     * @return float
     */
    public function getErrors(): float
    {
        return (float) $this->required('errors');
    }
}
