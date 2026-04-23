<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class UpdateLywandCustomerRequestDto extends AbstractDto
{
    /**
     * Lywand Partner name
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        $v = $this->data['name'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Customer id of customer file
     *
     * @return float|null
     */
    public function getCustomerId(): ?float
    {
        $v = $this->data['customerId'] ?? null;
        return $v === null ? null : (float) $v;
    }
}
