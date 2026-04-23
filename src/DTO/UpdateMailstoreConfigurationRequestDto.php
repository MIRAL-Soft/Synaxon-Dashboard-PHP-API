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
     * Default base directory
     *
     * @return string
     */
    public function getBaseDirectory(): string
    {
        return (string) $this->data['baseDirectory'];
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
     * SMTP hostname
     *
     * @return string
     */
    public function getSmtpHostname(): string
    {
        return (string) $this->data['smtpHostname'];
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
     * SMTP protocol
     *
     * @return string
     */
    public function getSmtpProtocol(): string
    {
        return (string) $this->data['smtpProtocol'];
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
     * SMTP authentication required
     *
     * @return bool
     */
    public function getSmtpAuthenticationRequired(): bool
    {
        return (bool) $this->data['smtpAuthenticationRequired'];
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
     * SMTP from display name
     *
     * @return string
     */
    public function getSmtpFromDisplayName(): string
    {
        return (string) $this->data['smtpFromDisplayName'];
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
     * SMTP recipient email address
     *
     * @return string
     */
    public function getSmtpRecipientEmailAddress(): string
    {
        return (string) $this->data['smtpRecipientEmailAddress'];
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
}
