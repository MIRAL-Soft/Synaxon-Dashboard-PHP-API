<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class ProductCountItemDto extends AbstractDto
{
    /**
     * Product identifier (rmm, acronis, eset, mailstore, lywand)
     *
     * @return string
     */
    public function getProduct(): string
    {
        return (string) $this->data['product'];
    }

    /**
     * Number of customers/instances for this product
     *
     * @return float
     */
    public function getCount(): float
    {
        return (float) $this->data['count'];
    }
}
