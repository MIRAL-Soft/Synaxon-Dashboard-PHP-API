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
        return (string) $this->required('currTimestamp');
    }

    /**
     * Timestamp of previous metrics for comparison
     *
     * @return string|null
     */
    public function getPrevTimestamp(): ?string
    {
        $v = $this->requiredNullable('prevTimestamp');
        return $v === null ? null : (string) $v;
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
