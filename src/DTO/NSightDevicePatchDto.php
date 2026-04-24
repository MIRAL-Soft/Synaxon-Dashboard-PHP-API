<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class NSightDevicePatchDto extends AbstractDto
{
    /**
     * The patch ID of the patch
     *
     * @return float
     */
    public function getPatchId(): float
    {
        return (float) $this->data['patchId'];
    }

    /**
     * The policy of the patch
     *
     * @return float
     */
    public function getPolicy(): float
    {
        return (float) $this->data['policy'];
    }

    /**
     * The policy label of the patch
     *
     * @return string
     */
    public function getPolicyLabel(): string
    {
        return (string) $this->data['policyLabel'];
    }

    /**
     * The patch icon of the patch
     *
     * @return string
     */
    public function getPatchIcon(): string
    {
        return (string) $this->data['patchIcon'];
    }

    /**
     * The status of the patch
     *
     * @return float
     */
    public function getStatus(): float
    {
        return (float) $this->data['status'];
    }

    /**
     * The select patch of the patch
     *
     * @return string
     */
    public function getSelectPatch(): string
    {
        return (string) $this->data['selectPatch'];
    }

    /**
     * The status label of the patch
     *
     * @return string
     */
    public function getStatusLabel(): string
    {
        return (string) $this->data['statusLabel'];
    }

    /**
     * The patch URL of the patch
     *
     * @return string
     */
    public function getPatchUrl(): string
    {
        return (string) $this->data['patchUrl'];
    }

    /**
     * The patch title of the patch
     *
     * @return string
     */
    public function getPatchTitle(): string
    {
        return (string) $this->data['patchTitle'];
    }

    /**
     * The product of the patch
     *
     * @return string
     */
    public function getProduct(): string
    {
        return (string) $this->data['product'];
    }

    /**
     * The severity of the patch
     *
     * @return float
     */
    public function getSeverity(): float
    {
        return (float) $this->data['severity'];
    }

    /**
     * The severity label of the patch
     *
     * @return string
     */
    public function getSeverityLabel(): string
    {
        return (string) $this->data['severityLabel'];
    }

    /**
     * The release date of the patch
     *
     * @return string
     */
    public function getReleaseDate(): string
    {
        return (string) $this->data['releaseDate'];
    }

    /**
     * The release date text of the patch
     *
     * @return string
     */
    public function getReleaseDateText(): string
    {
        return (string) $this->data['releaseDateText'];
    }

    /**
     * The install date text of the patch
     *
     * @return string
     */
    public function getInstallDateText(): string
    {
        return (string) $this->data['installDateText'];
    }

    /**
     * The deployable of the patch
     *
     * @return float
     */
    public function getDeployable(): float
    {
        return (float) $this->data['deployable'];
    }

    /**
     * The uninstallable of the patch
     *
     * @return float
     */
    public function getUninstallable(): float
    {
        return (float) $this->data['uninstallable'];
    }

    /**
     * The classification of the patch
     *
     * @return string
     */
    public function getClassification(): string
    {
        return (string) $this->data['classification'];
    }
}
