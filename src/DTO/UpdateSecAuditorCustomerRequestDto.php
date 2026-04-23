<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class UpdateSecAuditorCustomerRequestDto extends AbstractDto
{
    /**
     * Customer file id
     *
     * @return float|null
     */
    public function getCustomerId(): ?float
    {
        $v = $this->data['customerId'] ?? null;
        return $v === null ? null : (float) $v;
    }
}
