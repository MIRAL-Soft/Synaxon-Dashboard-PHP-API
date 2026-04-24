<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CustomerRankingDto extends AbstractDto
{
    /**
     * List of customers with their scores, sorted by score descending (best first)
     *
     * @return list<CustomerRankingItemDto>
     */
    public function getCustomers(): array
    {
        $out = [];
        foreach ((array) ($this->data['customers'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = CustomerRankingItemDto::fromArray($item);
            } elseif ($item instanceof CustomerRankingItemDto) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * Total number of customers with at least one active module
     *
     * @return float
     */
    public function getTotalCustomers(): float
    {
        return (float) $this->data['totalCustomers'];
    }
}
