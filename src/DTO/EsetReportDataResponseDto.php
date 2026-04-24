<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class EsetReportDataResponseDto extends AbstractDto
{
    /**
     * License information
     *
     * @return mixed|null
     */
    public function getStorage(): mixed
    {
        return $this->data['storage'] ?? null;
    }

    /**
     * List of protected devices
     *
     * @return list<EsetDeviceDto>
     */
    public function getDeviceList(): array
    {
        $out = [];
        foreach ((array) ($this->data['deviceList'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = EsetDeviceDto::fromArray($item);
            } elseif ($item instanceof EsetDeviceDto) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * List of devices with errors
     *
     * @return list<EsetDeviceDto>
     */
    public function getFailuresList(): array
    {
        $out = [];
        foreach ((array) ($this->data['failuresList'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = EsetDeviceDto::fromArray($item);
            } elseif ($item instanceof EsetDeviceDto) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * List of devices without licenses
     *
     * @return list<EsetDeviceDto>
     */
    public function getNoLicenseList(): array
    {
        $out = [];
        foreach ((array) ($this->data['noLicenseList'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = EsetDeviceDto::fromArray($item);
            } elseif ($item instanceof EsetDeviceDto) {
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
     * @return list<EsetCustomerStatsItemDto>
     */
    public function getCustomerStats(): array
    {
        $out = [];
        foreach ((array) ($this->data['customerStats'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = EsetCustomerStatsItemDto::fromArray($item);
            } elseif ($item instanceof EsetCustomerStatsItemDto) {
                $out[] = $item;
            }
        }
        return $out;
    }
}
