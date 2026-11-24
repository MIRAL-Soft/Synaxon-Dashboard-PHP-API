<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CloudallyTaskPaginatedResponseDto extends AbstractDto
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
     * @return list<CloudallyTaskResponseDto>
     */
    public function getData(): array
    {
        $out = [];
        foreach ((array) ($this->data['data'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = CloudallyTaskResponseDto::fromArray($item);
            } elseif ($item instanceof CloudallyTaskResponseDto) {
                $out[] = $item;
            }
        }
        return $out;
    }
}
