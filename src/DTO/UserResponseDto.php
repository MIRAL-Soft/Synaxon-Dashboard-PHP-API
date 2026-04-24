<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class UserResponseDto extends AbstractDto
{
    /**
     * Entity unique identifier
     *
     * @return string
     */
    public function getId(): string
    {
        return (string) $this->data['id'];
    }

    /**
     * Entity creation date and time
     *
     * @return string
     */
    public function getCreatedAt(): string
    {
        return (string) $this->data['createdAt'];
    }

    /**
     * Date and time of last update
     *
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return (string) $this->data['updatedAt'];
    }

    /**
     * Username
     *
     * @return string|null
     */
    public function getUsername(): ?string
    {
        $v = $this->data['username'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Tenant ID
     *
     * @return string
     */
    public function getTenantId(): string
    {
        return (string) $this->data['tenantId'];
    }

    /**
     * Email
     *
     * @return string|null
     */
    public function getEmail(): ?string
    {
        $v = $this->data['email'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Family Name
     *
     * @return string
     */
    public function getFamilyName(): string
    {
        return (string) $this->data['familyName'];
    }

    /**
     * Given Name
     *
     * @return string|null
     */
    public function getGivenName(): ?string
    {
        $v = $this->data['givenName'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Phone Number
     *
     * @return string|null
     */
    public function getPhoneNumber(): ?string
    {
        $v = $this->data['phoneNumber'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Role
     *
     * @return string
     */
    public function getRole(): string
    {
        return (string) $this->data['role'];
    }

    /**
     * Permissions granted to the user
     *
     * @return list<PermissionResponseDto>
     */
    public function getPermissions(): array
    {
        $out = [];
        foreach ((array) ($this->data['permissions'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = PermissionResponseDto::fromArray($item);
            } elseif ($item instanceof PermissionResponseDto) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * Partner Number
     *
     * @return string
     */
    public function getPartnerNo(): string
    {
        return (string) $this->data['partnerNo'];
    }

    /**
     * Last Login date
     *
     * @return string|null
     */
    public function getLastLogin(): ?string
    {
        $v = $this->data['lastLogin'] ?? null;
        return $v === null ? null : (string) $v;
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
     * @return string
     */
    public function getLanguage(): string
    {
        return (string) $this->data['language'];
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
