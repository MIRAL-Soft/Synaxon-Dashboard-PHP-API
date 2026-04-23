<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class EsetMetrics extends AbstractDto
{
    /**
     * @return MetricValueDto
     */
    public function getActiveLicenses(): MetricValueDto
    {
        $v = $this->data['activeLicenses'] ?? null;
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
    public function getProductProtectEntryOnPremQuantity(): MetricValueDto
    {
        $v = $this->data['productProtectEntryOnPremQuantity'] ?? null;
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
    public function getProductProtectEntryOnPremUsage(): MetricValueDto
    {
        $v = $this->data['productProtectEntryOnPremUsage'] ?? null;
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
    public function getProductProtectAdvancedQuantity(): MetricValueDto
    {
        $v = $this->data['productProtectAdvancedQuantity'] ?? null;
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
    public function getProductProtectAdvancedUsage(): MetricValueDto
    {
        $v = $this->data['productProtectAdvancedUsage'] ?? null;
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
    public function getProductProtectCompleteQuantity(): MetricValueDto
    {
        $v = $this->data['productProtectCompleteQuantity'] ?? null;
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
    public function getProductProtectCompleteUsage(): MetricValueDto
    {
        $v = $this->data['productProtectCompleteUsage'] ?? null;
        if (is_array($v)) {
            return MetricValueDto::fromArray($v);
        }
        if ($v instanceof MetricValueDto) {
            return $v;
        }
        return MetricValueDto::fromArray([]);
    }
}
