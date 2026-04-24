<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class MessageTemplateResponseDto extends AbstractDto
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
     * The content of the message template
     *
     * @return string
     */
    public function getMessage(): string
    {
        return (string) $this->data['message'];
    }

    /**
     * The English version of the message template
     *
     * @return string|null
     */
    public function getMessageEn(): ?string
    {
        $v = $this->data['messageEn'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * The subject line of the message
     *
     * @return string
     */
    public function getSubject(): string
    {
        return (string) $this->data['subject'];
    }

    /**
     * Optional URL link associated with the message
     *
     * @return string|null
     */
    public function getLink(): ?string
    {
        $v = $this->data['link'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Tags for categorizing the message
     *
     * @return list<string>
     */
    public function getTags(): array
    {
        return (array) ($this->data['tags'] ?? []);
    }

    /**
     * The target of the message template
     *
     * @return list<string>
     */
    public function getTarget(): array
    {
        return (array) ($this->data['target'] ?? []);
    }

    /**
     * The type of target for message creation
     *
     * @return string
     */
    public function getTargetType(): string
    {
        return (string) $this->data['targetType'];
    }

    /**
     * The scheduled date and time for sending the message
     *
     * @return string|null
     */
    public function getScheduledAt(): ?string
    {
        $v = $this->data['scheduledAt'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Indicates whether the template has been sent
     *
     * @return bool
     */
    public function getIsSent(): bool
    {
        return (bool) $this->data['isSent'];
    }

    /**
     * Indicates whether all messages from this template have been marked as read
     *
     * @return bool
     */
    public function getMarkedAsRead(): bool
    {
        return (bool) $this->data['markedAsRead'];
    }

    /**
     * Date and time of deletion
     *
     * @return string|null
     */
    public function getDeletedAt(): ?string
    {
        $v = $this->data['deletedAt'] ?? null;
        return $v === null ? null : (string) $v;
    }
}
