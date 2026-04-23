<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class AcronisMetricsDTO extends AbstractDto
{
    /**
     * @return MetricValueDto
     */
    public function getWorkstations(): MetricValueDto
    {
        $v = $this->data['workstations'] ?? null;
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
    public function getServers(): MetricValueDto
    {
        $v = $this->data['servers'] ?? null;
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
    public function getVms(): MetricValueDto
    {
        $v = $this->data['vms'] ?? null;
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
    public function getM365Seats(): MetricValueDto
    {
        $v = $this->data['m365Seats'] ?? null;
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
    public function getM365Mailboxes(): MetricValueDto
    {
        $v = $this->data['m365Mailboxes'] ?? null;
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
    public function getM365Onedrive(): MetricValueDto
    {
        $v = $this->data['m365Onedrive'] ?? null;
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
    public function getM365SharepointSites(): MetricValueDto
    {
        $v = $this->data['m365SharepointSites'] ?? null;
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
    public function getM365Teams(): MetricValueDto
    {
        $v = $this->data['m365Teams'] ?? null;
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
    public function getGoogleMail(): MetricValueDto
    {
        $v = $this->data['googleMail'] ?? null;
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
    public function getGoogleDrive(): MetricValueDto
    {
        $v = $this->data['googleDrive'] ?? null;
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
    public function getGoogleTeamDrive(): MetricValueDto
    {
        $v = $this->data['googleTeamDrive'] ?? null;
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
    public function getNas(): MetricValueDto
    {
        $v = $this->data['nas'] ?? null;
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
    public function getPolicies(): MetricValueDto
    {
        $v = $this->data['policies'] ?? null;
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
    public function getLocalStorage(): MetricValueDto
    {
        $v = $this->data['localStorage'] ?? null;
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
    public function getStorage(): MetricValueDto
    {
        $v = $this->data['storage'] ?? null;
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
    public function getStorageTotal(): MetricValueDto
    {
        $v = $this->data['storageTotal'] ?? null;
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
    public function getClass1Storage(): MetricValueDto
    {
        $v = $this->data['class1Storage'] ?? null;
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
    public function getClass2Storage(): MetricValueDto
    {
        $v = $this->data['class2Storage'] ?? null;
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
    public function getServerStorage(): MetricValueDto
    {
        $v = $this->data['serverStorage'] ?? null;
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
    public function getVmStorage(): MetricValueDto
    {
        $v = $this->data['vmStorage'] ?? null;
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
    public function getWorkstationStorage(): MetricValueDto
    {
        $v = $this->data['workstationStorage'] ?? null;
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
    public function getMailboxStorage(): MetricValueDto
    {
        $v = $this->data['mailboxStorage'] ?? null;
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
    public function getO365TeamsStorage(): MetricValueDto
    {
        $v = $this->data['o365TeamsStorage'] ?? null;
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
    public function getOnedriveStorage(): MetricValueDto
    {
        $v = $this->data['onedriveStorage'] ?? null;
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
    public function getNasStorage(): MetricValueDto
    {
        $v = $this->data['nasStorage'] ?? null;
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
    public function getImmutableStorage(): MetricValueDto
    {
        $v = $this->data['immutableStorage'] ?? null;
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
    public function getC2cStorage(): MetricValueDto
    {
        $v = $this->data['c2cStorage'] ?? null;
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
    public function getPackAdvBackupWorkstations(): MetricValueDto
    {
        $v = $this->data['packAdvBackupWorkstations'] ?? null;
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
    public function getPackAdvBackupServers(): MetricValueDto
    {
        $v = $this->data['packAdvBackupServers'] ?? null;
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
    public function getPackAdvBackupVms(): MetricValueDto
    {
        $v = $this->data['packAdvBackupVms'] ?? null;
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
    public function getPackAdvManagement(): MetricValueDto
    {
        $v = $this->data['packAdvManagement'] ?? null;
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
    public function getPackAdvSecurity(): MetricValueDto
    {
        $v = $this->data['packAdvSecurity'] ?? null;
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
    public function getPackAdvSecurityMdr(): MetricValueDto
    {
        $v = $this->data['packAdvSecurityMdr'] ?? null;
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
    public function getPackAdvSecurityWithoutEdr(): MetricValueDto
    {
        $v = $this->data['packAdvSecurityWithoutEdr'] ?? null;
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
    public function getPackAdvSecurityWithEdr(): MetricValueDto
    {
        $v = $this->data['packAdvSecurityWithEdr'] ?? null;
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
    public function getPackAdvSecurityEdrWorkloads(): MetricValueDto
    {
        $v = $this->data['packAdvSecurityEdrWorkloads'] ?? null;
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
    public function getPackAdvSecurityEdrWorkloadsG1(): MetricValueDto
    {
        $v = $this->data['packAdvSecurityEdrWorkloadsG1'] ?? null;
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
    public function getPackAdvSecurityM365Seats(): MetricValueDto
    {
        $v = $this->data['packAdvSecurityM365Seats'] ?? null;
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
    public function getPackAdvEmailSecurity(): MetricValueDto
    {
        $v = $this->data['packAdvEmailSecurity'] ?? null;
        if (is_array($v)) {
            return MetricValueDto::fromArray($v);
        }
        if ($v instanceof MetricValueDto) {
            return $v;
        }
        return MetricValueDto::fromArray([]);
    }
}
