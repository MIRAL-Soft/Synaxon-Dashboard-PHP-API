<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class UpdateCustomerReportSettingRequestDto extends AbstractDto
{
    /**
     * Custom display name for customer
     *
     * @return string|null
     */
    public function getCustomDisplayName(): ?string
    {
        $v = $this->data['customDisplayName'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Set the "customDisplayName" field. Custom display name for customer
     *
     * @return static
     */
    public function withCustomDisplayName(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('customDisplayName', $value);
    }

    /**
     * Introduction text
     *
     * @return string|null
     */
    public function getIntroductionText(): ?string
    {
        $v = $this->data['introductionText'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Set the "introductionText" field. Introduction text
     *
     * @return static
     */
    public function withIntroductionText(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('introductionText', $value);
    }

    /**
     * Cron expression, or null to clear
     *
     * @return string|null
     */
    public function getCronExpression(): ?string
    {
        $v = $this->data['cronExpression'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Set the "cronExpression" field. Cron expression, or null to clear
     *
     * @return static
     */
    public function withCronExpression(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('cronExpression', $value);
    }

    /**
     * Timezone for cron expression interpretation (European timezones only)
     *
     * @return string|null
     */
    public function getTimezone(): ?string
    {
        $v = $this->data['timezone'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Set the "timezone" field. Timezone for cron expression interpretation (European timezones only)
     *
     * @return static
     */
    public function withTimezone(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('timezone', $value);
    }

    /**
     * Report language
     *
     * @return string|null
     */
    public function getLanguage(): ?string
    {
        $v = $this->data['language'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Set the "language" field. Report language
     *
     * @return static
     */
    public function withLanguage(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('language', $value);
    }

    /**
     * Recipients
     *
     * @return list<string>
     */
    public function getRecipients(): array
    {
        return (array) ($this->data['recipients'] ?? []);
    }

    /**
     * Set the "recipients" field. Recipients
     *
     * @return static
     */
    public function withRecipients(?array $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('recipients', $value);
    }

    /**
     * Modules
     *
     * @return list<string>
     */
    public function getModules(): array
    {
        return (array) ($this->data['modules'] ?? []);
    }

    /**
     * Set the "modules" field. Modules
     *
     * @return static
     */
    public function withModules(?array $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('modules', $value);
    }
}
