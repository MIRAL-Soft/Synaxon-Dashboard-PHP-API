<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class LywandStatsDto extends AbstractDto
{
    /**
     * Overall security score (0-100)
     *
     * @return float
     */
    public function getScore(): float
    {
        return (float) $this->data['score'];
    }

    /**
     * Number of high severity vulnerabilities
     *
     * @return float
     */
    public function getVulnerabilitiesHigh(): float
    {
        return (float) $this->data['vulnerabilitiesHigh'];
    }

    /**
     * Number of medium severity vulnerabilities
     *
     * @return float
     */
    public function getVulnerabilitiesMedium(): float
    {
        return (float) $this->data['vulnerabilitiesMedium'];
    }

    /**
     * Number of low severity vulnerabilities
     *
     * @return float
     */
    public function getVulnerabilitiesLow(): float
    {
        return (float) $this->data['vulnerabilitiesLow'];
    }

    /**
     * Number of endpoints in scope
     *
     * @return float
     */
    public function getInScopeEndpoints(): float
    {
        return (float) $this->data['inScopeEndpoints'];
    }

    /**
     * Number of domains in scope
     *
     * @return float
     */
    public function getInScopeDomains(): float
    {
        return (float) $this->data['inScopeDomains'];
    }

    /**
     * Number of emails in scope
     *
     * @return float
     */
    public function getInScopeEmails(): float
    {
        return (float) $this->data['inScopeEmails'];
    }

    /**
     * Number of IP addresses in scope
     *
     * @return float
     */
    public function getInScopeIpAddresses(): float
    {
        return (float) $this->data['inScopeIpAddresses'];
    }

    /**
     * Number of endpoints out of scope
     *
     * @return float
     */
    public function getOutOfScopeEndpoints(): float
    {
        return (float) $this->data['outOfScopeEndpoints'];
    }

    /**
     * Number of domains out of scope
     *
     * @return float
     */
    public function getOutOfScopeDomains(): float
    {
        return (float) $this->data['outOfScopeDomains'];
    }

    /**
     * Number of emails out of scope
     *
     * @return float
     */
    public function getOutOfScopeEmails(): float
    {
        return (float) $this->data['outOfScopeEmails'];
    }

    /**
     * Number of IP addresses out of scope
     *
     * @return float
     */
    public function getOutOfScopeIpAddresses(): float
    {
        return (float) $this->data['outOfScopeIpAddresses'];
    }
}
