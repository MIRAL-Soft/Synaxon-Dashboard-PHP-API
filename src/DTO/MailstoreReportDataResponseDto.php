<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class MailstoreReportDataResponseDto extends AbstractDto
{
    /**
     * Storage statistics
     *
     * @return mixed|null
     */
    public function getStorage(): mixed
    {
        return $this->data['storage'] ?? null;
    }

    /**
     * List of archives
     *
     * @return list<MailstoreArchiveDto>
     */
    public function getArchiveList(): array
    {
        $out = [];
        foreach ((array) ($this->data['archiveList'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = MailstoreArchiveDto::fromArray($item);
            } elseif ($item instanceof MailstoreArchiveDto) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * List of instances with errors
     *
     * @return list<MailstoreErrorDto>
     */
    public function getFailuresList(): array
    {
        $out = [];
        foreach ((array) ($this->data['failuresList'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = MailstoreErrorDto::fromArray($item);
            } elseif ($item instanceof MailstoreErrorDto) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * Score calculation details
     *
     * @return mixed|null
     */
    public function getScore(): mixed
    {
        return $this->data['score'] ?? null;
    }

    /**
     * Customer count for partner reports
     *
     * @return mixed|null
     */
    public function getCustomerCount(): mixed
    {
        return $this->data['customerCount'] ?? null;
    }

    /**
     * Customer statistics for partner reports
     *
     * @return list<MailstoreCustomerStatsItemDto>
     */
    public function getCustomerStats(): array
    {
        $out = [];
        foreach ((array) ($this->data['customerStats'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = MailstoreCustomerStatsItemDto::fromArray($item);
            } elseif ($item instanceof MailstoreCustomerStatsItemDto) {
                $out[] = $item;
            }
        }
        return $out;
    }
}
