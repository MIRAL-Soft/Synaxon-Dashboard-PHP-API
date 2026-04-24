<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class EsetLicenseDto extends AbstractDto
{
    /**
     * Number of active licenses
     *
     * @return float
     */
    public function getActiveLicenses(): float
    {
        return (float) $this->data['activeLicenses'];
    }

    /**
     * Protect Entry On-Prem license quantity
     *
     * @return float
     */
    public function getProductProtectEntryOnPremQuantity(): float
    {
        return (float) $this->data['productProtectEntryOnPremQuantity'];
    }

    /**
     * Protect Entry On-Prem license usage
     *
     * @return float
     */
    public function getProductProtectEntryOnPremUsage(): float
    {
        return (float) $this->data['productProtectEntryOnPremUsage'];
    }

    /**
     * Protect Advanced license quantity
     *
     * @return float
     */
    public function getProductProtectAdvancedQuantity(): float
    {
        return (float) $this->data['productProtectAdvancedQuantity'];
    }

    /**
     * Protect Advanced license usage
     *
     * @return float
     */
    public function getProductProtectAdvancedUsage(): float
    {
        return (float) $this->data['productProtectAdvancedUsage'];
    }

    /**
     * Protect Complete license quantity
     *
     * @return float
     */
    public function getProductProtectCompleteQuantity(): float
    {
        return (float) $this->data['productProtectCompleteQuantity'];
    }

    /**
     * Protect Complete license usage
     *
     * @return float
     */
    public function getProductProtectCompleteUsage(): float
    {
        return (float) $this->data['productProtectCompleteUsage'];
    }
}
