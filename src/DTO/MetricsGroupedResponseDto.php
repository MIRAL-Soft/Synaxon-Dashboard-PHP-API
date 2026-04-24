<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class MetricsGroupedResponseDto extends AbstractDto
{
    /**
     * Time period in YYYY-MM-DD (daily) or YYYY-MM (monthly) format
     *
     * @return string
     */
    public function getPeriod(): string
    {
        return (string) $this->data['period'];
    }

    /**
     * Metadata about the grouped metrics
     *
     * @return mixed
     */
    public function getMetadata(): mixed
    {
        return $this->data['metadata'] ?? null;
    }

    /**
     * Metrics with statistics for each field. Each field contains min, avg, and max statistics.
     *
     * @return array<string, mixed>
     */
    public function getValue(): array
    {
        return (array) ($this->data['value'] ?? []);
    }
}
