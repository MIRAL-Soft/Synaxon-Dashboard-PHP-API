<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class UpdateScheduleRequestDto extends AbstractDto
{
    /**
     * Schedule name
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        $v = $this->data['name'] ?? null;
        return $v === null ? null : (string) $v;
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
     * @return bool|null
     */
    public function getDisabled(): ?bool
    {
        $v = $this->data['disabled'] ?? null;
        return $v === null ? null : (bool) $v;
    }

    /**
     * Schedule cron expression
     *
     * @return string|null
     */
    public function getCronExpression(): ?string
    {
        $v = $this->data['cronExpression'] ?? null;
        return $v === null ? null : (string) $v;
    }
}
