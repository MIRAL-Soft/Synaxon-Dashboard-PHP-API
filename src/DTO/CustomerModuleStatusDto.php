<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CustomerModuleStatusDto extends AbstractDto
{
    /**
     * Module identifier (managed-rmm, managed-backup, managed-endpoint-security, managed-email-archiving, managed-security-audit)
     *
     * @return string
     */
    public function getModule(): string
    {
        return (string) $this->data['module'];
    }

    /**
     * Total items (devices, sites, etc.) for this module
     *
     * @return float
     */
    public function getTotal(): float
    {
        return (float) $this->data['total'];
    }

    /**
     * Number of items with errors
     *
     * @return float
     */
    public function getErrors(): float
    {
        return (float) $this->data['errors'];
    }

    /**
     * Score as percentage (0-100)
     *
     * @return float
     */
    public function getScore(): float
    {
        return (float) $this->data['score'];
    }
}
