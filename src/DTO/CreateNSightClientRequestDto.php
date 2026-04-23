<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CreateNSightClientRequestDto extends AbstractDto
{
    /**
     * The name of the client
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        $v = $this->data['name'] ?? null;
        return $v === null ? null : (string) $v;
    }
}
