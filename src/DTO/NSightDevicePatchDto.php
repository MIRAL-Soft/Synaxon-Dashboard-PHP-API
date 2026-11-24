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
        return (float) $this->required('patchId');
    }

    /**
     * The policy of the patch
     *
     * @return float
     */
    public function getPolicy(): float
    {
        return (float) $this->required('policy');
    }

    /**
     * The policy label of the patch
     *
     * @return string
     */
    public function getPolicyLabel(): string
    {
        return (string) $this->required('policyLabel');
    }

    /**
     * The patch icon of the patch
     *
     * @return string
     */
    public function getPatchIcon(): string
    {
        return (string) $this->required('patchIcon');
    }

    /**
     * The status of the patch
     *
     * @return float
     */
    public function getStatus(): float
    {
        return (float) $this->required('status');
    }

    /**
     * The select patch of the patch
     *
     * @return string
     */
    public function getSelectPatch(): string
    {
        return (string) $this->required('selectPatch');
    }

    /**
     * The status label of the patch
     *
     * @return string
     */
    public function getStatusLabel(): string
    {
        return (string) $this->required('statusLabel');
    }

    /**
     * The patch URL of the patch
     *
     * @return string
     */
    public function getPatchUrl(): string
    {
        return (string) $this->required('patchUrl');
    }

    /**
     * The patch title of the patch
     *
     * @return string
     */
    public function getPatchTitle(): string
    {
        return (string) $this->required('patchTitle');
    }

    /**
     * The product of the patch
     *
     * @return string
     */
    public function getProduct(): string
    {
        return (string) $this->required('product');
    }

    /**
     * The severity of the patch
     *
     * @return float
     */
    public function getSeverity(): float
    {
        return (float) $this->required('severity');
    }

    /**
     * The severity label of the patch
     *
     * @return string
     */
    public function getSeverityLabel(): string
    {
        return (string) $this->required('severityLabel');
    }

    /**
     * The release date of the patch
     *
     * @return string
     */
    public function getReleaseDate(): string
    {
        return (string) $this->required('releaseDate');
    }

    /**
     * The release date text of the patch
     *
     * @return string
     */
    public function getReleaseDateText(): string
    {
        return (string) $this->required('releaseDateText');
    }

    /**
     * The install date text of the patch
     *
     * @return string
     */
    public function getInstallDateText(): string
    {
        return (string) $this->required('installDateText');
    }

    /**
     * The deployable of the patch
     *
     * @return float
     */
    public function getDeployable(): float
    {
        return (float) $this->required('deployable');
    }

    /**
     * The uninstallable of the patch
     *
     * @return float
     */
    public function getUninstallable(): float
    {
        return (float) $this->required('uninstallable');
    }

    /**
     * The classification of the patch
     *
     * @return string
     */
    public function getClassification(): string
    {
        return (string) $this->required('classification');
    }
}
