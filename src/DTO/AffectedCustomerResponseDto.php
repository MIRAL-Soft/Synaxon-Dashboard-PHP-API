<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class AffectedCustomerResponseDto extends AbstractDto
{
    /**
     * Customer UUID
     *
     * @return string
     */
    public function getId(): string
    {
        return (string) $this->required('id');
    }

    /**
     * Customer ID
     *
     * @return float|null
     */
    public function getCustomerId(): ?float
    {
        $v = $this->data['customerId'] ?? null;
        return $v === null ? null : (float) $v;
    }

    /**
     * Customer name
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        $v = $this->data['name'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Number of devices queued for this customer
     *
     * @return float
     */
    public function getDeviceCount(): float
    {
        return (float) $this->required('deviceCount');
    }
}
