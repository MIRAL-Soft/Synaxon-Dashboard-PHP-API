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
        return (float) $this->required('activeLicenses');
    }

    /**
     * Protect Entry On-Prem license quantity
     *
     * @return float
     */
    public function getProductProtectEntryOnPremQuantity(): float
    {
        return (float) $this->required('productProtectEntryOnPremQuantity');
    }

    /**
     * Protect Entry On-Prem license usage
     *
     * @return float
     */
    public function getProductProtectEntryOnPremUsage(): float
    {
        return (float) $this->required('productProtectEntryOnPremUsage');
    }

    /**
     * Protect Advanced license quantity
     *
     * @return float
     */
    public function getProductProtectAdvancedQuantity(): float
    {
        return (float) $this->required('productProtectAdvancedQuantity');
    }

    /**
     * Protect Advanced license usage
     *
     * @return float
     */
    public function getProductProtectAdvancedUsage(): float
    {
        return (float) $this->required('productProtectAdvancedUsage');
    }

    /**
     * Protect Complete license quantity
     *
     * @return float
     */
    public function getProductProtectCompleteQuantity(): float
    {
        return (float) $this->required('productProtectCompleteQuantity');
    }

    /**
     * Protect Complete license usage
     *
     * @return float
     */
    public function getProductProtectCompleteUsage(): float
    {
        return (float) $this->required('productProtectCompleteUsage');
    }
}
