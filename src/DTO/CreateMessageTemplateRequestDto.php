<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CreateMessageTemplateRequestDto extends AbstractDto
{
    /**
     * The content of the message in german
     *
     * @return string
     */
    public function getMessageDe(): string
    {
        return (string) $this->data['messageDe'];
    }

    /**
     * The content of the message in english
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
     * Tags for categorizing the message (e.g., products, breaking news)
     *
     * @return list<string>
     */
    public function getTags(): array
    {
        return (array) ($this->data['tags'] ?? []);
    }

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
     * The target type of the message
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
}
