<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class MetricValueDto extends AbstractDto
{
    /**
     * Current value of the metric
     *
     * @return float
     */
    public function getCurr(): float
    {
        return (float) $this->required('curr');
    }

    /**
     * Previous value of the metric (null if no previous data)
     *
     * @return float
     */
    public function getPrev(): float
    {
        return (float) $this->required('prev');
    }
}
