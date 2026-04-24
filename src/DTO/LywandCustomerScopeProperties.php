<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class LywandCustomerScopeProperties extends AbstractDto
{
    /**
     * The number of endpoints
     *
     * @return float
     */
    public function getEndpoints(): float
    {
        return (float) $this->data['endpoints'];
    }

    /**
     * The number of domains
     *
     * @return float
     */
    public function getDomains(): float
    {
        return (float) $this->data['domains'];
    }

    /**
     * The number of emails
     *
     * @return float
     */
    public function getEmails(): float
    {
        return (float) $this->data['emails'];
    }

    /**
     * The number of IP addresses
     *
     * @return float
     */
    public function getIpAddresses(): float
    {
        return (float) $this->data['ipAddresses'];
    }
}
