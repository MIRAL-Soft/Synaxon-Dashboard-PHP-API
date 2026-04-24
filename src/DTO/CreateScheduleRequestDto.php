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
     * Set the "name" field. Schedule name
     *
     * @return static
     */
    public function withName(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('name', $value);
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
     * Set the "timeZone" field. Schedule time zone
     *
     * @return static
     */
    public function withTimeZone(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('timeZone', $value);
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
     * Set the "disabled" field. Schedule disabled
     *
     * @return static
     */
    public function withDisabled(?bool $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('disabled', $value);
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

    /**
     * Set the "cronExpression" field. Schedule cron expression
     *
     * @return static
     */
    public function withCronExpression(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('cronExpression', $value);
    }
}
