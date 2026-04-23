<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class NSightClientMetrics extends AbstractDto
{
    /**
     * @return MetricValueDto
     */
    public function getServerCount(): MetricValueDto
    {
        $v = $this->data['serverCount'] ?? null;
        if (is_array($v)) {
            return MetricValueDto::fromArray($v);
        }
        if ($v instanceof MetricValueDto) {
            return $v;
        }
        return MetricValueDto::fromArray([]);
    }

    /**
     * @return MetricValueDto
     */
    public function getWorkstationCount(): MetricValueDto
    {
        $v = $this->data['workstationCount'] ?? null;
        if (is_array($v)) {
            return MetricValueDto::fromArray($v);
        }
        if ($v instanceof MetricValueDto) {
            return $v;
        }
        return MetricValueDto::fromArray([]);
    }

    /**
     * @return MetricValueDto
     */
    public function getFailingChecksCount(): MetricValueDto
    {
        $v = $this->data['failingChecksCount'] ?? null;
        if (is_array($v)) {
            return MetricValueDto::fromArray($v);
        }
        if ($v instanceof MetricValueDto) {
            return $v;
        }
        return MetricValueDto::fromArray([]);
    }

    /**
     * @return MetricValueDto
     */
    public function getSitesCount(): MetricValueDto
    {
        $v = $this->data['sitesCount'] ?? null;
        if (is_array($v)) {
            return MetricValueDto::fromArray($v);
        }
        if ($v instanceof MetricValueDto) {
            return $v;
        }
        return MetricValueDto::fromArray([]);
    }
}
