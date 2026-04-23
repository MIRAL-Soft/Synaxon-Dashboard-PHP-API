<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class AcceptTermRequestDto extends AbstractDto
{
    /**
     * @return list<string>
     */
    public function getTerms(): array
    {
        return (array) ($this->data['terms'] ?? []);
    }
}
