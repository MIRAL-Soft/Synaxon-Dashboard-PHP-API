<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class DashboardLayoutPaginatedResponseDto extends AbstractDto
{
    /**
     * Number of items per page
     *
     * @return float
     */
    public function getLimit(): float
    {
        return (float) $this->data['limit'];
    }

    /**
     * Current page
     *
     * @return float
     */
    public function getPage(): float
    {
        return (float) $this->data['page'];
    }

    /**
     * Total number of items
     *
     * @return float
     */
    public function getTotalItems(): float
    {
        return (float) $this->data['totalItems'];
    }

    /**
     * Array of dashboard layouts
     *
     * @return list<DashboardLayoutResponseDto>
     */
    public function getData(): array
    {
        $out = [];
        foreach ((array) ($this->data['data'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = DashboardLayoutResponseDto::fromArray($item);
            } elseif ($item instanceof DashboardLayoutResponseDto) {
                $out[] = $item;
            }
        }
        return $out;
    }
}
