<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class AcronisCustomerStatsItemDto extends AbstractDto
{
    /**
     * Customer ID (null if not linked)
     *
     * @return float
     */
    public function getCustomerId(): float
    {
        return (float) $this->data['customerId'];
    }

    /**
     * Customer name
     *
     * @return string
     */
    public function getCustomerName(): string
    {
        return (string) $this->data['customerName'];
    }

    /**
     * Total number of devices for this customer
     *
     * @return float
     */
    public function getTotal(): float
    {
        return (float) $this->data['total'];
    }

    /**
     * Number of devices with errors
     *
     * @return float
     */
    public function getErrors(): float
    {
        return (float) $this->data['errors'];
    }
}
