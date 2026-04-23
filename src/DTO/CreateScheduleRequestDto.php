<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CreateScheduleRequestDto extends AbstractDto
{
    /**
     * Schedule name
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->data['name'];
    }

    /**
     * Schedule time zone
     *
     * @return string|null
     */
    public function getTimeZone(): ?string
    {
        $v = $this->data['timeZone'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Schedule disabled
     *
     * @return bool
     */
    public function getDisabled(): bool
    {
        return (bool) $this->data['disabled'];
    }

    /**
     * Schedule cron expression
     *
     * @return string
     */
    public function getCronExpression(): string
    {
        return (string) $this->data['cronExpression'];
    }
}
