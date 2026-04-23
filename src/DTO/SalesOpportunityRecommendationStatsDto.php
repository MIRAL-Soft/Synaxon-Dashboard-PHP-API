<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class SalesOpportunityRecommendationStatsDto extends AbstractDto
{
    /**
     * The recommendation for the device
     *
     * @return string
     */
    public function getRecommendation(): string
    {
        return (string) $this->data['recommendation'];
    }

    /**
     * The count of the recommendation
     *
     * @return float
     */
    public function getCount(): float
    {
        return (float) $this->data['count'];
    }
}
