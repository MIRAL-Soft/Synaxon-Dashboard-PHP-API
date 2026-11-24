<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class MetricStatisticsDto extends AbstractDto
{
    /**
     * Minimum value in the period
     *
     * @return float
     */
    public function getMin(): float
    {
        return (float) $this->required('min');
    }

    /**
     * Average value in the period
     *
     * @return float
     */
    public function getAvg(): float
    {
        return (float) $this->required('avg');
    }

    /**
     * Maximum value in the period
     *
     * @return float
     */
    public function getMax(): float
    {
        return (float) $this->required('max');
    }
}
