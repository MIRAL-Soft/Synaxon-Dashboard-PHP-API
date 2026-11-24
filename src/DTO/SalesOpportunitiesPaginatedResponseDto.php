<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class SalesOpportunitiesPaginatedResponseDto extends AbstractDto
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
     * @return list<SalesOpportunitiesResponseDto>
     */
    public function getData(): array
    {
        $out = [];
        foreach ((array) ($this->data['data'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = SalesOpportunitiesResponseDto::fromArray($item);
            } elseif ($item instanceof SalesOpportunitiesResponseDto) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * @return list<SalesOpportunitiesRecommendationStatsDto>
     */
    public function getRecommendationStats(): array
    {
        $out = [];
        foreach ((array) ($this->data['recommendationStats'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = SalesOpportunitiesRecommendationStatsDto::fromArray($item);
            } elseif ($item instanceof SalesOpportunitiesRecommendationStatsDto) {
                $out[] = $item;
            }
        }
        return $out;
    }
}
