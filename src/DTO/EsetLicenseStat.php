<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class EsetLicenseStat extends AbstractDto
{
    /**
     * The product code of the license
     *
     * @return string
     */
    public function getProductCode(): string
    {
        return (string) $this->data['productCode'];
    }

    /**
     * The product name of the license
     *
     * @return string
     */
    public function getProductName(): string
    {
        return (string) $this->data['productName'];
    }

    /**
     * The quantity of the license
     *
     * @return float
     */
    public function getQuantity(): float
    {
        return (float) $this->data['quantity'];
    }

    /**
     * The usage of the license
     *
     * @return float
     */
    public function getUsage(): float
    {
        return (float) $this->data['usage'];
    }
}
