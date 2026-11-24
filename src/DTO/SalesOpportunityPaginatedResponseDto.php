<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class SalesOpportunityPaginatedResponseDto extends AbstractDto
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
     * @return list<SalesOpportunityResponseDto>
     */
    public function getData(): array
    {
        $out = [];
        foreach ((array) ($this->data['data'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = SalesOpportunityResponseDto::fromArray($item);
            } elseif ($item instanceof SalesOpportunityResponseDto) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * @return list<SalesOpportunityRecommendationStatsDto>
     */
    public function getRecommendationStats(): array
    {
        $out = [];
        foreach ((array) ($this->data['recommendationStats'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = SalesOpportunityRecommendationStatsDto::fromArray($item);
            } elseif ($item instanceof SalesOpportunityRecommendationStatsDto) {
                $out[] = $item;
            }
        }
        return $out;
    }
}
