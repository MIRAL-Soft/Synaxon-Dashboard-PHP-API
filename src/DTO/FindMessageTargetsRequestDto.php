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
     * Set the "target" field. The target of the message
     *
     * @return static
     */
    public function withTarget(mixed $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('target', $value);
    }

    /**
     * The target type of the message
     *
     * @return string
     */
    public function getTargetType(): string
    {
        return (string) $this->required('targetType');
    }

    /**
     * Set the "targetType" field. The target type of the message
     *
     * @return static
     */
    public function withTargetType(?string $value): static
    {
        return $this->with('targetType', $value);
    }

    /**
     * Indicates whether the message content is an advertisement
     *
     * @return bool|null
     */
    public function getIsAdvertisement(): ?bool
    {
        $v = $this->data['isAdvertisement'] ?? null;
        return $v === null ? null : (bool) $v;
    }

    /**
     * Set the "isAdvertisement" field. Indicates whether the message content is an advertisement
     *
     * @return static
     */
    public function withIsAdvertisement(?bool $value): static
    {
        return $this->with('isAdvertisement', $value);
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

    /**
     * Set the "sendToAllUsersOfTenants" field. Send message to all users of tenants (Has been disabled)
     *
     * @return static
     */
    public function withSendToAllUsersOfTenants(?bool $value): static
    {
        return $this->with('sendToAllUsersOfTenants', $value);
    }
}
