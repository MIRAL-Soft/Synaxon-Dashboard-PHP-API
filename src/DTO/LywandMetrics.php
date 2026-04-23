<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class LywandMetrics extends AbstractDto
{
    /**
     * @return MetricValueDto
     */
    public function getScore(): MetricValueDto
    {
        $v = $this->data['score'] ?? null;
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
    public function getVulnerabilitiesHigh(): MetricValueDto
    {
        $v = $this->data['vulnerabilitiesHigh'] ?? null;
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
    public function getVulnerabilitiesMedium(): MetricValueDto
    {
        $v = $this->data['vulnerabilitiesMedium'] ?? null;
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
    public function getVulnerabilitiesLow(): MetricValueDto
    {
        $v = $this->data['vulnerabilitiesLow'] ?? null;
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
    public function getInScopeEndpoints(): MetricValueDto
    {
        $v = $this->data['inScopeEndpoints'] ?? null;
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
    public function getInScopeDomains(): MetricValueDto
    {
        $v = $this->data['inScopeDomains'] ?? null;
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
    public function getInScopeEmails(): MetricValueDto
    {
        $v = $this->data['inScopeEmails'] ?? null;
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
    public function getInScopeIpAddresses(): MetricValueDto
    {
        $v = $this->data['inScopeIpAddresses'] ?? null;
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
    public function getOutOfScopeEndpoints(): MetricValueDto
    {
        $v = $this->data['outOfScopeEndpoints'] ?? null;
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
    public function getOutOfScopeDomains(): MetricValueDto
    {
        $v = $this->data['outOfScopeDomains'] ?? null;
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
    public function getOutOfScopeEmails(): MetricValueDto
    {
        $v = $this->data['outOfScopeEmails'] ?? null;
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
    public function getOutOfScopeIpAddresses(): MetricValueDto
    {
        $v = $this->data['outOfScopeIpAddresses'] ?? null;
        if (is_array($v)) {
            return MetricValueDto::fromArray($v);
        }
        if ($v instanceof MetricValueDto) {
            return $v;
        }
        return MetricValueDto::fromArray([]);
    }
}
