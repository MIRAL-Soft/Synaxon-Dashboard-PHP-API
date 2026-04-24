<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class UpdateMailstoreConfigurationRequestDto extends AbstractDto
{
    /**
     * Default instance host
     *
     * @return string
     */
    public function getDefaultHost(): string
    {
        return (string) $this->data['defaultHost'];
    }

    /**
     * Set the "defaultHost" field. Default instance host
     *
     * @return static
     */
    public function withDefaultHost(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('defaultHost', $value);
    }

    /**
     * Default base directory
     *
     * @return string
     */
    public function getBaseDirectory(): string
    {
        return (string) $this->data['baseDirectory'];
    }

    /**
     * Set the "baseDirectory" field. Default base directory
     *
     * @return static
     */
    public function withBaseDirectory(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('baseDirectory', $value);
    }

    /**
     * Attachment index
     *
     * @return string
     */
    public function getAttachmentIndex(): string
    {
        return (string) $this->data['attachmentIndex'];
    }

    /**
     * Set the "attachmentIndex" field. Attachment index
     *
     * @return static
     */
    public function withAttachmentIndex(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('attachmentIndex', $value);
    }

    /**
     * SMTP hostname
     *
     * @return string
     */
    public function getSmtpHostname(): string
    {
        return (string) $this->data['smtpHostname'];
    }

    /**
     * Set the "smtpHostname" field. SMTP hostname
     *
     * @return static
     */
    public function withSmtpHostname(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('smtpHostname', $value);
    }

    /**
     * SMTP port
     *
     * @return float
     */
    public function getSmtpPort(): float
    {
        return (float) $this->data['smtpPort'];
    }

    /**
     * Set the "smtpPort" field. SMTP port
     *
     * @return static
     */
    public function withSmtpPort(?float $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('smtpPort', $value);
    }

    /**
     * SMTP protocol
     *
     * @return string
     */
    public function getSmtpProtocol(): string
    {
        return (string) $this->data['smtpProtocol'];
    }

    /**
     * Set the "smtpProtocol" field. SMTP protocol
     *
     * @return static
     */
    public function withSmtpProtocol(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('smtpProtocol', $value);
    }

    /**
     * SMTP ignore SSL policy errors
     *
     * @return bool
     */
    public function getSmtpIgnoreSslPolicyErrors(): bool
    {
        return (bool) $this->data['smtpIgnoreSslPolicyErrors'];
    }

    /**
     * Set the "smtpIgnoreSslPolicyErrors" field. SMTP ignore SSL policy errors
     *
     * @return static
     */
    public function withSmtpIgnoreSslPolicyErrors(?bool $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('smtpIgnoreSslPolicyErrors', $value);
    }

    /**
     * SMTP authentication required
     *
     * @return bool
     */
    public function getSmtpAuthenticationRequired(): bool
    {
        return (bool) $this->data['smtpAuthenticationRequired'];
    }

    /**
     * Set the "smtpAuthenticationRequired" field. SMTP authentication required
     *
     * @return static
     */
    public function withSmtpAuthenticationRequired(?bool $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('smtpAuthenticationRequired', $value);
    }

    /**
     * SMTP username
     *
     * @return string
     */
    public function getSmtpUsername(): string
    {
        return (string) $this->data['smtpUsername'];
    }

    /**
     * Set the "smtpUsername" field. SMTP username
     *
     * @return static
     */
    public function withSmtpUsername(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('smtpUsername', $value);
    }

    /**
     * SMTP password
     *
     * @return string|null
     */
    public function getSmtpPassword(): ?string
    {
        $v = $this->data['smtpPassword'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Set the "smtpPassword" field. SMTP password
     *
     * @return static
     */
    public function withSmtpPassword(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('smtpPassword', $value);
    }

    /**
     * SMTP from display name
     *
     * @return string
     */
    public function getSmtpFromDisplayName(): string
    {
        return (string) $this->data['smtpFromDisplayName'];
    }

    /**
     * Set the "smtpFromDisplayName" field. SMTP from display name
     *
     * @return static
     */
    public function withSmtpFromDisplayName(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('smtpFromDisplayName', $value);
    }

    /**
     * SMTP from email address
     *
     * @return string
     */
    public function getSmtpFromEmailAddress(): string
    {
        return (string) $this->data['smtpFromEmailAddress'];
    }

    /**
     * Set the "smtpFromEmailAddress" field. SMTP from email address
     *
     * @return static
     */
    public function withSmtpFromEmailAddress(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('smtpFromEmailAddress', $value);
    }

    /**
     * SMTP recipient email address
     *
     * @return string
     */
    public function getSmtpRecipientEmailAddress(): string
    {
        return (string) $this->data['smtpRecipientEmailAddress'];
    }

    /**
     * Set the "smtpRecipientEmailAddress" field. SMTP recipient email address
     *
     * @return static
     */
    public function withSmtpRecipientEmailAddress(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('smtpRecipientEmailAddress', $value);
    }

    /**
     * Placement rules
     *
     * @return list<MailstoreConfigurationPlacementRuleDto>
     */
    public function getPlacementRules(): array
    {
        $out = [];
        foreach ((array) ($this->data['placementRules'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = MailstoreConfigurationPlacementRuleDto::fromArray($item);
            } elseif ($item instanceof MailstoreConfigurationPlacementRuleDto) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * Set the "placementRules" field. Placement rules
     *
     * @return static
     */
    public function withPlacementRules(?array $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('placementRules', $value);
    }
}
