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
     * Completed tours
     *
     * @return list<string>
     */
    public function getCompletedTours(): array
    {
        return (array) ($this->data['completedTours'] ?? []);
    }
}
