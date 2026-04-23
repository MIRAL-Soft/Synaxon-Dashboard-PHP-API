<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class FindMessageTargetsRequestDto extends AbstractDto
{
    /**
     * The target of the message
     *
     * @return mixed
     */
    public function getTarget(): mixed
    {
        return $this->data['target'] ?? null;
    }

    /**
     * The target type of the message
     *
     * @return string
     */
    public function getTargetType(): string
    {
        return (string) $this->data['targetType'];
    }

    /**
     * Send message to all users of tenants (Has been disabled)
     *
     * @return bool|null
     */
    public function getSendToAllUsersOfTenants(): ?bool
    {
        $v = $this->data['sendToAllUsersOfTenants'] ?? null;
        return $v === null ? null : (bool) $v;
    }
}
