<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CreateNSightSiteRequestDto extends AbstractDto
{
    /**
     * The id of the customer
     *
     * @return float|null
     */
    public function getCustomerId(): ?float
    {
        $v = $this->data['customerId'] ?? null;
        return $v === null ? null : (float) $v;
    }

    /**
     * The id of the client
     *
     * @return string
     */
    public function getClientId(): string
    {
        return (string) $this->data['clientId'];
    }

    /**
     * The name of the site
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->data['name'];
    }
}
