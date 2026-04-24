<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class EsetCustomerCountDto extends AbstractDto
{
    /**
     * Number of ESET customers for this tenant
     *
     * @return float
     */
    public function getCount(): float
    {
        return (float) $this->data['count'];
    }
}
