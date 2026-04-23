<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class ReportSettingResponseDto extends AbstractDto
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
     * Tenant ID
     *
     * @return string
     */
    public function getTenantId(): string
    {
        return (string) $this->data['tenantId'];
    }

    /**
     * Report type
     *
     * @return string
     */
    public function getType(): string
    {
        return (string) $this->data['type'];
    }

    /**
     * Customer ID (only for customer reports)
     *
     * @return string|null
     */
    public function getCustomerId(): ?string
    {
        $v = $this->data['customerId'] ?? null;
        return $v === null ? null : (string) $v;
    }

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
     * Cron expression for scheduled reports
     *
     * @return string|null
     */
    public function getCronExpression(): ?string
    {
        $v = $this->data['cronExpression'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Timezone for cron expression interpretation
     *
     * @return string
     */
    public function getTimezone(): string
    {
        return (string) $this->data['timezone'];
    }

    /**
     * Report language
     *
     * @return string
     */
    public function getLanguage(): string
    {
        return (string) $this->data['language'];
    }

    /**
     * Email recipients
     *
     * @return list<string>
     */
    public function getRecipients(): array
    {
        return (array) ($this->data['recipients'] ?? []);
    }

    /**
     * Report modules
     *
     * @return list<string>
     */
    public function getModules(): array
    {
        return (array) ($this->data['modules'] ?? []);
    }
}
