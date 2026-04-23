<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class UpdateMessageTemplateRequestDto extends AbstractDto
{
    /**
     * The name identifier of the message template
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        $v = $this->data['name'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * The content of the message in german
     *
     * @return string|null
     */
    public function getMessageDe(): ?string
    {
        $v = $this->data['messageDe'] ?? null;
        return $v === null ? null : (string) $v;
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
     * @return mixed|null
     */
    public function getTarget(): mixed
    {
        return $this->data['target'] ?? null;
    }

    /**
     * The target type of the message
     *
     * @return string|null
     */
    public function getTargetType(): ?string
    {
        $v = $this->data['targetType'] ?? null;
        return $v === null ? null : (string) $v;
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
