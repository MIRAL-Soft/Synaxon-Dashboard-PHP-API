<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CloudallyPartnerMetricsResponseDto extends AbstractDto
{
    /**
     * Timestamp of current metrics
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
     * @return string
     */
    public function getPrevTimestamp(): string
    {
        return (string) $this->required('prevTimestamp');
    }

    /**
     * Dynamic metrics with current and previous values
     *
     * @return array<string, mixed>
     */
    public function getValues(): array
    {
        return (array) ($this->data['values'] ?? []);
    }
}
