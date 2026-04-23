<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class LywandCustomerCountDto extends AbstractDto
{
    /**
     * Number of Lywand customers for this tenant
     *
     * @return float
     */
    public function getCount(): float
    {
        return (float) $this->data['count'];
    }
}
