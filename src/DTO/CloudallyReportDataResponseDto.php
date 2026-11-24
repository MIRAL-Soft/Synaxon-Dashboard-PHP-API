<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CloudallyReportDataResponseDto extends AbstractDto
{
    /**
     * @return array<string, mixed>
     */
    public function getCustomerCount(): array
    {
        return (array) ($this->data['customerCount'] ?? []);
    }

    /**
     * @return list<CloudallyCustomerStatsDto>
     */
    public function getCustomerStats(): array
    {
        $out = [];
        foreach ((array) ($this->data['customerStats'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = CloudallyCustomerStatsDto::fromArray($item);
            } elseif ($item instanceof CloudallyCustomerStatsDto) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * @return CloudallyStorageSummaryDto|null
     */
    public function getStorage(): ?CloudallyStorageSummaryDto
    {
        $v = $this->data['storage'] ?? null;
        if (is_array($v)) {
            return CloudallyStorageSummaryDto::fromArray($v);
        }
        if ($v instanceof CloudallyStorageSummaryDto) {
            return $v;
        }
        return null;
    }

    /**
     * @return list<CloudallyTaskListDto>
     */
    public function getTaskList(): array
    {
        $out = [];
        foreach ((array) ($this->data['taskList'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = CloudallyTaskListDto::fromArray($item);
            } elseif ($item instanceof CloudallyTaskListDto) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * @return list<CloudallyErrorDto>
     */
    public function getErrorList(): array
    {
        $out = [];
        foreach ((array) ($this->data['errorList'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = CloudallyErrorDto::fromArray($item);
            } elseif ($item instanceof CloudallyErrorDto) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * @return CloudallyScoreDto|null
     */
    public function getScore(): ?CloudallyScoreDto
    {
        $v = $this->data['score'] ?? null;
        if (is_array($v)) {
            return CloudallyScoreDto::fromArray($v);
        }
        if ($v instanceof CloudallyScoreDto) {
            return $v;
        }
        return null;
    }
}
