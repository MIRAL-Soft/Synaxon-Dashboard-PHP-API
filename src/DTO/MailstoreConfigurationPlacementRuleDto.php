<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class MailstoreConfigurationPlacementRuleDto extends AbstractDto
{
    /**
     * Tenant ID
     *
     * @return string
     */
    public function getTenantId(): string
    {
        return (string) $this->data['tenantId'];
    }

    /**
     * Host
     *
     * @return string
     */
    public function getHost(): string
    {
        return (string) $this->data['host'];
    }
}
