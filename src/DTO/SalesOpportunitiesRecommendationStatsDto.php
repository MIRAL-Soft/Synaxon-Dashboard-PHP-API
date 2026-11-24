<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class SalesOpportunitiesRecommendationStatsDto extends AbstractDto
{
    /**
     * The recommendation for the device
     *
     * @return string
     */
    public function getRecommendation(): string
    {
        return (string) $this->required('recommendation');
    }

    /**
     * The count of the recommendation
     *
     * @return float
     */
    public function getCount(): float
    {
        return (float) $this->required('count');
    }
}
