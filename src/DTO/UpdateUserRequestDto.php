<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class UpdateUserRequestDto extends AbstractDto
{
    /**
     * User role
     *
     * @return string|null
     */
    public function getRole(): ?string
    {
        $v = $this->data['role'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Set the "role" field. User role
     *
     * @return static
     */
    public function withRole(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('role', $value);
    }

    /**
     * User permissions
     *
     * @return list<UpdateUserPermissions>
     */
    public function getPermissions(): array
    {
        $out = [];
        foreach ((array) ($this->data['permissions'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = UpdateUserPermissions::fromArray($item);
            } elseif ($item instanceof UpdateUserPermissions) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * Set the "permissions" field. User permissions
     *
     * @return static
     */
    public function withPermissions(?array $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('permissions', $value);
    }

    /**
     * Email notification preference
     *
     * @return string|null
     */
    public function getEmailNotification(): ?string
    {
        $v = $this->data['emailNotification'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Set the "emailNotification" field. Email notification preference
     *
     * @return static
     */
    public function withEmailNotification(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('emailNotification', $value);
    }

    /**
     * User interface language
     *
     * @return string|null
     */
    public function getLanguage(): ?string
    {
        $v = $this->data['language'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Set the "language" field. User interface language
     *
     * @return static
     */
    public function withLanguage(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('language', $value);
    }

    /**
     * Completed tours
     *
     * @return list<string>
     */
    public function getCompletedTours(): array
    {
        return (array) ($this->data['completedTours'] ?? []);
    }

    /**
     * Set the "completedTours" field. Completed tours
     *
     * @return static
     */
    public function withCompletedTours(?array $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('completedTours', $value);
    }
}
