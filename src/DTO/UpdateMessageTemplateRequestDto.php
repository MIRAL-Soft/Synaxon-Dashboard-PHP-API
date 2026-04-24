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
     * Set the "name" field. The name identifier of the message template
     *
     * @return static
     */
    public function withName(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('name', $value);
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
     * Set the "messageDe" field. The content of the message in german
     *
     * @return static
     */
    public function withMessageDe(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('messageDe', $value);
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
     * Set the "messageEn" field. The content of the message in english
     *
     * @return static
     */
    public function withMessageEn(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('messageEn', $value);
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
     * Set the "subject" field. The subject line of the message
     *
     * @return static
     */
    public function withSubject(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('subject', $value);
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
     * Set the "link" field. Optional URL link associated with the message
     *
     * @return static
     */
    public function withLink(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('link', $value);
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
     * Set the "tags" field. Tags for categorizing the message (e.g., products, breaking news)
     *
     * @return static
     */
    public function withTags(?array $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('tags', $value);
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
     * Set the "target" field. The target of the message
     *
     * @return static
     */
    public function withTarget(mixed $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('target', $value);
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
     * Set the "targetType" field. The target type of the message
     *
     * @return static
     */
    public function withTargetType(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('targetType', $value);
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
     * Set the "scheduledAt" field. The scheduled date and time for sending the message
     *
     * @return static
     */
    public function withScheduledAt(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('scheduledAt', $value);
    }
}
