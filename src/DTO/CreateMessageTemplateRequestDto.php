<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CreateMessageTemplateRequestDto extends AbstractDto
{
    /**
     * Client-provided UUID for idempotency. Re-sending the same request with the same id returns the original template instead of creating a duplicate.
     *
     * @return string|null
     */
    public function getIdempotencyKey(): ?string
    {
        $v = $this->data['idempotencyKey'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Set the "idempotencyKey" field. Client-provided UUID for idempotency. Re-sending the same request with the same id returns the original template instead of creating a duplicate.
     *
     * @return static
     */
    public function withIdempotencyKey(?string $value): static
    {
        return $this->with('idempotencyKey', $value);
    }

    /**
     * The content of the message in german
     *
     * @return string
     */
    public function getMessageDe(): string
    {
        return (string) $this->required('messageDe');
    }

    /**
     * Set the "messageDe" field. The content of the message in german
     *
     * @return static
     */
    public function withMessageDe(?string $value): static
    {
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
        return $this->with('messageEn', $value);
    }

    /**
     * The subject line of the message
     *
     * @return string
     */
    public function getSubject(): string
    {
        return (string) $this->required('subject');
    }

    /**
     * Set the "subject" field. The subject line of the message
     *
     * @return static
     */
    public function withSubject(?string $value): static
    {
        return $this->with('subject', $value);
    }

    /**
     * The subject line of the message in english
     *
     * @return string|null
     */
    public function getSubjectEn(): ?string
    {
        $v = $this->data['subjectEn'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Set the "subjectEn" field. The subject line of the message in english
     *
     * @return static
     */
    public function withSubjectEn(?string $value): static
    {
        return $this->with('subjectEn', $value);
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
        return $this->with('link', $value);
    }

    /**
     * Tags for categorizing the message (e.g., products, breaking news)
     *
     * @return list<string>
     */
    public function getTags(): array
    {
        return array_values(array_map('strval', (array) ($this->data['tags'] ?? [])));
    }

    /**
     * Set the "tags" field. Tags for categorizing the message (e.g., products, breaking news)
     *
     * @param list<string>|null $value
     * @return static
     */
    public function withTags(?array $value): static
    {
        return $this->with('tags', $value);
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
     * @return string
     */
    public function getTargetType(): string
    {
        return (string) $this->required('targetType');
    }

    /**
     * Set the "targetType" field. The target type of the message
     *
     * @return static
     */
    public function withTargetType(?string $value): static
    {
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
        return $this->with('scheduledAt', $value);
    }

    /**
     * Indicates whether the message content is an advertisement
     *
     * @return bool|null
     */
    public function getIsAdvertisement(): ?bool
    {
        $v = $this->data['isAdvertisement'] ?? null;
        return $v === null ? null : (bool) $v;
    }

    /**
     * Set the "isAdvertisement" field. Indicates whether the message content is an advertisement
     *
     * @return static
     */
    public function withIsAdvertisement(?bool $value): static
    {
        return $this->with('isAdvertisement', $value);
    }
}
