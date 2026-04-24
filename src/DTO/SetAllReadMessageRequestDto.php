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

    /**
     * Set the "messageTargetType" field. Message target type
     *
     * @return static
     */
    public function withMessageTargetType(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('messageTargetType', $value);
    }
}
