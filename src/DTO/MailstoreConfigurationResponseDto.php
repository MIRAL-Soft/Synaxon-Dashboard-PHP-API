<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class MailstoreConfigurationResponseDto extends AbstractDto
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
     * Default instance host
     *
     * @return string
     */
    public function getDefaultHost(): string
    {
        return (string) $this->required('defaultHost');
    }

    /**
     * Default base directory
     *
     * @return string
     */
    public function getBaseDirectory(): string
    {
        return (string) $this->required('baseDirectory');
    }

    /**
     * Attachment index
     *
     * @return string
     */
    public function getAttachmentIndex(): string
    {
        return (string) $this->required('attachmentIndex');
    }

    /**
     * SMTP hostname
     *
     * @return string
     */
    public function getSmtpHostname(): string
    {
        return (string) $this->required('smtpHostname');
    }

    /**
     * SMTP port
     *
     * @return float
     */
    public function getSmtpPort(): float
    {
        return (float) $this->required('smtpPort');
    }

    /**
     * SMTP protocol
     *
     * @return string
     */
    public function getSmtpProtocol(): string
    {
        return (string) $this->required('smtpProtocol');
    }

    /**
     * SMTP ignore SSL policy errors
     *
     * @return bool
     */
    public function getSmtpIgnoreSslPolicyErrors(): bool
    {
        return (bool) $this->required('smtpIgnoreSslPolicyErrors');
    }

    /**
     * SMTP authentication required
     *
     * @return bool
     */
    public function getSmtpAuthenticationRequired(): bool
    {
        return (bool) $this->required('smtpAuthenticationRequired');
    }

    /**
     * SMTP username
     *
     * @return string
     */
    public function getSmtpUsername(): string
    {
        return (string) $this->required('smtpUsername');
    }

    /**
     * SMTP from display name
     *
     * @return string
     */
    public function getSmtpFromDisplayName(): string
    {
        return (string) $this->required('smtpFromDisplayName');
    }

    /**
     * SMTP from email address
     *
     * @return string
     */
    public function getSmtpFromEmailAddress(): string
    {
        return (string) $this->required('smtpFromEmailAddress');
    }

    /**
     * SMTP recipient email address
     *
     * @return string
     */
    public function getSmtpRecipientEmailAddress(): string
    {
        return (string) $this->required('smtpRecipientEmailAddress');
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
