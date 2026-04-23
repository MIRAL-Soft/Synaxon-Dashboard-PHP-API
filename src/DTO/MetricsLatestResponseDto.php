<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class MetricsLatestResponseDto extends AbstractDto
{
    /**
     * Metadata about the metric
     *
     * @return mixed
     */
    public function getMetadata(): mixed
    {
        return $this->data['metadata'] ?? null;
    }

    /**
     * Metric values - object with numeric properties for the specific metric type
     *
     * @return array<string, mixed>
     */
    public function getValue(): array
    {
        return (array) ($this->data['value'] ?? []);
    }

    /**
     * Timestamp when the metric was recorded
     *
     * @return string
     */
    public function getTimestamp(): string
    {
        return (string) $this->data['timestamp'];
    }
}
