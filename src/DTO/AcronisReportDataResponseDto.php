<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class AcronisReportDataResponseDto extends AbstractDto
{
    /**
     * Storage statistics
     *
     * @return mixed|null
     */
    public function getStorageUsage(): mixed
    {
        return $this->data['storageUsage'] ?? null;
    }

    /**
     * List of backup devices
     *
     * @return list<AcronisDeviceDto>
     */
    public function getDeviceList(): array
    {
        $out = [];
        foreach ((array) ($this->data['deviceList'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = AcronisDeviceDto::fromArray($item);
            } elseif ($item instanceof AcronisDeviceDto) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * List of devices with errors
     *
     * @return list<AcronisErrorDto>
     */
    public function getFailuresList(): array
    {
        $out = [];
        foreach ((array) ($this->data['failuresList'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = AcronisErrorDto::fromArray($item);
            } elseif ($item instanceof AcronisErrorDto) {
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
     * @return list<AcronisCustomerStatsItemDto>
     */
    public function getCustomerStats(): array
    {
        $out = [];
        foreach ((array) ($this->data['customerStats'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = AcronisCustomerStatsItemDto::fromArray($item);
            } elseif ($item instanceof AcronisCustomerStatsItemDto) {
                $out[] = $item;
            }
        }
        return $out;
    }
}
