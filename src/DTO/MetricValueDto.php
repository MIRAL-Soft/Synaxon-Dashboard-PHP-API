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
     * @return float|null
     */
    public function getPrev(): ?float
    {
        $v = $this->requiredNullable('prev');
        return $v === null ? null : (float) $v;
    }
}
