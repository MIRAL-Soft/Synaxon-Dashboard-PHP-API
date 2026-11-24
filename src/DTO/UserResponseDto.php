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
        return (string) $this->required('id');
    }

    /**
     * Entity creation date and time
     *
     * @return string
     */
    public function getCreatedAt(): string
    {
        return (string) $this->required('createdAt');
    }

    /**
     * Date and time of last update
     *
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return (string) $this->required('updatedAt');
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
     * Authentication provider
     *
     * @return string
     */
    public function getProvider(): string
    {
        return (string) $this->required('provider');
    }

    /**
     * Authentication provider ID
     *
     * @return string
     */
    public function getProviderId(): string
    {
        return (string) $this->required('providerId');
    }

    /**
     * Tenant ID
     *
     * @return string
     */
    public function getTenantId(): string
    {
        return (string) $this->required('tenantId');
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
        return (string) $this->required('familyName');
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
        return (string) $this->required('role');
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
        return (string) $this->required('partnerNo');
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
     * Weekday for weekly email digests
     *
     * @return string|null
     */
    public function getWeeklyDigestDay(): ?string
    {
        $v = $this->data['weeklyDigestDay'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Whether the user wants to receive advertisement emails
     *
     * @return bool
     */
    public function getReceivesAdvertisementEmails(): bool
    {
        return (bool) $this->required('receivesAdvertisementEmails');
    }

    /**
     * User interface language
     *
     * @return string
     */
    public function getLanguage(): string
    {
        return (string) $this->required('language');
    }

    /**
     * Completed tours
     *
     * @return list<string>
     */
    public function getCompletedTours(): array
    {
        return array_values(array_map('strval', (array) ($this->data['completedTours'] ?? [])));
    }

    /**
     * Date when user was blocked
     *
     * @return string|null
     */
    public function getBlockedAt(): ?string
    {
        $v = $this->data['blockedAt'] ?? null;
        return $v === null ? null : (string) $v;
    }
}
