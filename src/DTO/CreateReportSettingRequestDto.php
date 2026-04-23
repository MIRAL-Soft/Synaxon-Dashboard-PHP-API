<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CreateReportSettingRequestDto extends AbstractDto
{
    /**
     * Custom display name
     *
     * @return string|null
     */
    public function getCustomDisplayName(): ?string
    {
        $v = $this->data['customDisplayName'] ?? null;
        return $v === null ? null : (string) $v;
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
     * Cron expression
     *
     * @return string|null
     */
    public function getCronExpression(): ?string
    {
        $v = $this->data['cronExpression'] ?? null;
        return $v === null ? null : (string) $v;
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
     * Recipients
     *
     * @return list<string>
     */
    public function getRecipients(): array
    {
        return (array) ($this->data['recipients'] ?? []);
    }

    /**
     * @return list<string>
     */
    public function getModules(): array
    {
        return (array) ($this->data['modules'] ?? []);
    }
}
