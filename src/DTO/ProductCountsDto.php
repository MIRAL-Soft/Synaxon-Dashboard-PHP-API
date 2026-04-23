<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class ProductCountsDto extends AbstractDto
{
    /**
     * List of customer counts for each product
     *
     * @return list<ProductCountItemDto>
     */
    public function getCounts(): array
    {
        $out = [];
        foreach ((array) ($this->data['counts'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = ProductCountItemDto::fromArray($item);
            } elseif ($item instanceof ProductCountItemDto) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * Total count of all product customers/instances
     *
     * @return float
     */
    public function getTotalCount(): float
    {
        return (float) $this->data['totalCount'];
    }
}
