<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class MessageResponseDto extends AbstractDto
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
     * The content of the message
     *
     * @return string
     */
    public function getMessage(): string
    {
        return (string) $this->data['message'];
    }

    /**
     * The subject line of the message
     *
     * @return string|null
     */
    public function getSubject(): ?string
    {
        $v = $this->data['subject'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Optional URL link associated with the message
     *
     * @return string
     */
    public function getLink(): string
    {
        return (string) $this->data['link'];
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
     * Indicates whether the message has been read by the recipient
     *
     * @return bool
     */
    public function getMarkedAsRead(): bool
    {
        return (bool) $this->data['markedAsRead'];
    }

    /**
     * Indicates whether the message is marked as starred
     *
     * @return bool
     */
    public function getStarred(): bool
    {
        return (bool) $this->data['starred'];
    }

    /**
     * Indicates whether the message is marked as important
     *
     * @return bool
     */
    public function getImportant(): bool
    {
        return (bool) $this->data['important'];
    }

    /**
     * The type of message
     *
     * @return string
     */
    public function getTargetType(): string
    {
        return (string) $this->data['targetType'];
    }

    /**
     * Indicates whether the message is marked as deleted
     *
     * @return bool
     */
    public function getDeleted(): bool
    {
        return (bool) $this->data['deleted'];
    }
}
