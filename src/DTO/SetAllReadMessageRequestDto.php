<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class SetAllReadMessageRequestDto extends AbstractDto
{
    /**
     * Message target type
     *
     * @return string|null
     */
    public function getMessageTargetType(): ?string
    {
        $v = $this->data['messageTargetType'] ?? null;
        return $v === null ? null : (string) $v;
    }
}
