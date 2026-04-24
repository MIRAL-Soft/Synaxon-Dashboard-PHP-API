<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class LywandReportDataResponseDto extends AbstractDto
{
    /**
     * Aggregated metrics and statistics
     *
     * @return mixed|null
     */
    public function getMetrics(): mixed
    {
        return $this->data['metrics'] ?? null;
    }

    /**
     * List of scan targets
     *
     * @return list<LywandTargetDto>
     */
    public function getTargetList(): array
    {
        $out = [];
        foreach ((array) ($this->data['targetList'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = LywandTargetDto::fromArray($item);
            } elseif ($item instanceof LywandTargetDto) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * List of high severity vulnerabilities (risk >= 7.0)
     *
     * @return list<LywandVulnerabilityDto>
     */
    public function getVulnerabilitiesHigh(): array
    {
        $out = [];
        foreach ((array) ($this->data['vulnerabilitiesHigh'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = LywandVulnerabilityDto::fromArray($item);
            } elseif ($item instanceof LywandVulnerabilityDto) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * List of medium severity vulnerabilities (4.0 <= risk < 7.0)
     *
     * @return list<LywandVulnerabilityDto>
     */
    public function getVulnerabilitiesMedium(): array
    {
        $out = [];
        foreach ((array) ($this->data['vulnerabilitiesMedium'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = LywandVulnerabilityDto::fromArray($item);
            } elseif ($item instanceof LywandVulnerabilityDto) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * List of low severity vulnerabilities (risk < 4.0)
     *
     * @return list<LywandVulnerabilityDto>
     */
    public function getVulnerabilitiesLow(): array
    {
        $out = [];
        foreach ((array) ($this->data['vulnerabilitiesLow'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = LywandVulnerabilityDto::fromArray($item);
            } elseif ($item instanceof LywandVulnerabilityDto) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * Score calculation details
     *
     * @return mixed|null
     */
    public function getScore(): mixed
    {
        return $this->data['score'] ?? null;
    }

    /**
     * Customer count for partner reports
     *
     * @return mixed|null
     */
    public function getCustomerCount(): mixed
    {
        return $this->data['customerCount'] ?? null;
    }

    /**
     * Customer statistics for partner reports
     *
     * @return list<LywandCustomerStatsItemDto>
     */
    public function getCustomerStats(): array
    {
        $out = [];
        foreach ((array) ($this->data['customerStats'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = LywandCustomerStatsItemDto::fromArray($item);
            } elseif ($item instanceof LywandCustomerStatsItemDto) {
                $out[] = $item;
            }
        }
        return $out;
    }
}
