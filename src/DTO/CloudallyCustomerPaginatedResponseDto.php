<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CloudallyCustomerPaginatedResponseDto extends AbstractDto
{
    /**
     * Number of items per page
     *
     * @return float
     */
    public function getLimit(): float
    {
        return (float) $this->required('limit');
    }

    /**
     * Current page
     *
     * @return float
     */
    public function getPage(): float
    {
        return (float) $this->required('page');
    }

    /**
     * Total number of items
     *
     * @return float
     */
    public function getTotalItems(): float
    {
        return (float) $this->required('totalItems');
    }

    /**
     * @return list<CloudallyCustomerResponseDto>
     */
    public function getData(): array
    {
        $out = [];
        foreach ((array) ($this->data['data'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = CloudallyCustomerResponseDto::fromArray($item);
            } elseif ($item instanceof CloudallyCustomerResponseDto) {
                $out[] = $item;
            }
        }
        return $out;
    }
}
