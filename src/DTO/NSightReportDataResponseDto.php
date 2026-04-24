<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class NSightReportDataResponseDto extends AbstractDto
{
    /**
     * @return DevicesDto|null
     */
    public function getDevices(): ?DevicesDto
    {
        $v = $this->data['devices'] ?? null;
        if (is_array($v)) {
            return DevicesDto::fromArray($v);
        }
        if ($v instanceof DevicesDto) {
            return $v;
        }
        return null;
    }

    /**
     * @return list<UsedAntivirusDto>
     */
    public function getAntivirus(): array
    {
        $out = [];
        foreach ((array) ($this->data['antivirus'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = UsedAntivirusDto::fromArray($item);
            } elseif ($item instanceof UsedAntivirusDto) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * @return list<AntivirusCheckDeviceDto>
     */
    public function getOutdatedAntivirus(): array
    {
        $out = [];
        foreach ((array) ($this->data['outdatedAntivirus'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = AntivirusCheckDeviceDto::fromArray($item);
            } elseif ($item instanceof AntivirusCheckDeviceDto) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * @return list<AntivirusCheckDeviceDto>
     */
    public function getMissingAntivirusCheck(): array
    {
        $out = [];
        foreach ((array) ($this->data['missingAntivirusCheck'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = AntivirusCheckDeviceDto::fromArray($item);
            } elseif ($item instanceof AntivirusCheckDeviceDto) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * @return float|null
     */
    public function getInstalledPatches(): ?float
    {
        $v = $this->data['installedPatches'] ?? null;
        return $v === null ? null : (float) $v;
    }

    /**
     * @return float|null
     */
    public function getExecutedChecks(): ?float
    {
        $v = $this->data['executedChecks'] ?? null;
        return $v === null ? null : (float) $v;
    }

    /**
     * @return float|null
     */
    public function getProblemCount(): ?float
    {
        $v = $this->data['problemCount'] ?? null;
        return $v === null ? null : (float) $v;
    }

    /**
     * @return float|null
     */
    public function getSolvedProblems(): ?float
    {
        $v = $this->data['solvedProblems'] ?? null;
        return $v === null ? null : (float) $v;
    }

    /**
     * @return BackupChecksDto|null
     */
    public function getBackupChecks(): ?BackupChecksDto
    {
        $v = $this->data['backupChecks'] ?? null;
        if (is_array($v)) {
            return BackupChecksDto::fromArray($v);
        }
        if ($v instanceof BackupChecksDto) {
            return $v;
        }
        return null;
    }

    /**
     * @return OfflineDevicesDto|null
     */
    public function getOfflineDevices(): ?OfflineDevicesDto
    {
        $v = $this->data['offlineDevices'] ?? null;
        if (is_array($v)) {
            return OfflineDevicesDto::fromArray($v);
        }
        if ($v instanceof OfflineDevicesDto) {
            return $v;
        }
        return null;
    }

    /**
     * @return list<UnsupportedOSDeviceDto>
     */
    public function getUnsupportedOperatingSystemDevices(): array
    {
        $out = [];
        foreach ((array) ($this->data['unsupportedOperatingSystemDevices'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = UnsupportedOSDeviceDto::fromArray($item);
            } elseif ($item instanceof UnsupportedOSDeviceDto) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * @return list<LowDiskCapacityDeviceDto>
     */
    public function getLowStorageDevices(): array
    {
        $out = [];
        foreach ((array) ($this->data['lowStorageDevices'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = LowDiskCapacityDeviceDto::fromArray($item);
            } elseif ($item instanceof LowDiskCapacityDeviceDto) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * @return list<FailedLoginDeviceDto>
     */
    public function getFailedLogins(): array
    {
        $out = [];
        foreach ((array) ($this->data['failedLogins'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = FailedLoginDeviceDto::fromArray($item);
            } elseif ($item instanceof FailedLoginDeviceDto) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * @return list<FailingCheckDeviceDto>
     */
    public function getFailures(): array
    {
        $out = [];
        foreach ((array) ($this->data['failures'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = FailingCheckDeviceDto::fromArray($item);
            } elseif ($item instanceof FailingCheckDeviceDto) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * @return ScoreDto|null
     */
    public function getScore(): ?ScoreDto
    {
        $v = $this->data['score'] ?? null;
        if (is_array($v)) {
            return ScoreDto::fromArray($v);
        }
        if ($v instanceof ScoreDto) {
            return $v;
        }
        return null;
    }

    /**
     * @return list<SiteRankingItemDto>
     */
    public function getSiteRanking(): array
    {
        $out = [];
        foreach ((array) ($this->data['siteRanking'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = SiteRankingItemDto::fromArray($item);
            } elseif ($item instanceof SiteRankingItemDto) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * @return CustomerCountDto|null
     */
    public function getCustomerCount(): ?CustomerCountDto
    {
        $v = $this->data['customerCount'] ?? null;
        if (is_array($v)) {
            return CustomerCountDto::fromArray($v);
        }
        if ($v instanceof CustomerCountDto) {
            return $v;
        }
        return null;
    }

    /**
     * @return list<CustomerStatsItemDto>
     */
    public function getCustomerStats(): array
    {
        $out = [];
        foreach ((array) ($this->data['customerStats'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = CustomerStatsItemDto::fromArray($item);
            } elseif ($item instanceof CustomerStatsItemDto) {
                $out[] = $item;
            }
        }
        return $out;
    }
}
