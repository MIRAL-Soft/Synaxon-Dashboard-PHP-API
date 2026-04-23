<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class ScheduleResponseDto extends AbstractDto
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
     * The name of the schedule
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->data['name'];
    }

    /**
     * The time zone of the schedule
     *
     * @return string|null
     */
    public function getTimeZone(): ?string
    {
        $v = $this->data['timeZone'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * The disabled status of the schedule
     *
     * @return bool
     */
    public function getDisabled(): bool
    {
        return (bool) $this->data['disabled'];
    }

    /**
     * The cron expression of the schedule
     *
     * @return string
     */
    public function getCronExpression(): string
    {
        return (string) $this->data['cronExpression'];
    }
}
