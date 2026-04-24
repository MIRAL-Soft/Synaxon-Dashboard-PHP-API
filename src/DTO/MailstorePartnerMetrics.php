<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class MailstorePartnerMetrics extends AbstractDto
{
    /**
     * @return MetricValueDto
     */
    public function getInstanceCount(): MetricValueDto
    {
        $v = $this->data['instanceCount'] ?? null;
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
    public function getArchiveCount(): MetricValueDto
    {
        $v = $this->data['archiveCount'] ?? null;
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
    public function getMessageCount(): MetricValueDto
    {
        $v = $this->data['messageCount'] ?? null;
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
    public function getSizeCount(): MetricValueDto
    {
        $v = $this->data['sizeCount'] ?? null;
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
    public function getAdditionalUsers(): MetricValueDto
    {
        $v = $this->data['additionalUsers'] ?? null;
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
    public function getAdditionalStorage(): MetricValueDto
    {
        $v = $this->data['additionalStorage'] ?? null;
        if (is_array($v)) {
            return MetricValueDto::fromArray($v);
        }
        if ($v instanceof MetricValueDto) {
            return $v;
        }
        return MetricValueDto::fromArray([]);
    }
}
