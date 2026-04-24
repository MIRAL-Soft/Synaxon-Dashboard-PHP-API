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
     * Set the "customerId" field. The id of the customer
     *
     * @return static
     */
    public function withCustomerId(?float $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('customerId', $value);
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
     * Set the "clientId" field. The id of the client
     *
     * @return static
     */
    public function withClientId(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('clientId', $value);
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

    /**
     * Set the "name" field. The name of the site
     *
     * @return static
     */
    public function withName(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('name', $value);
    }
}
