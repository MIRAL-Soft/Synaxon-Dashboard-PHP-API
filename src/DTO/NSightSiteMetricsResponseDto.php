<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class NSightSiteMetricsResponseDto extends AbstractDto
{
    /**
     * Timestamp when current metrics were generated
     *
     * @return string
     */
    public function getCurrTimestamp(): string
    {
        return (string) $this->data['currTimestamp'];
    }

    /**
     * Timestamp of previous metrics for comparison
     *
     * @return string
     */
    public function getPrevTimestamp(): string
    {
        return (string) $this->data['prevTimestamp'];
    }

    /**
     * Metrics values with current and previous comparison
     *
     * @return mixed
     */
    public function getValues(): mixed
    {
        return $this->data['values'] ?? null;
    }
}
