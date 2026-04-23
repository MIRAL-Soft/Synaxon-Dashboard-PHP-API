<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class SiteRankingItemDto extends AbstractDto
{
    /**
     * @return float
     */
    public function getRank(): float
    {
        return (float) $this->data['rank'];
    }

    /**
     * @return string
     */
    public function getSiteId(): string
    {
        return (string) $this->data['siteId'];
    }

    /**
     * @return string
     */
    public function getSiteName(): string
    {
        return (string) $this->data['siteName'];
    }

    /**
     * Score as percentage (0-100)
     *
     * @return float
     */
    public function getScore(): float
    {
        return (float) $this->data['score'];
    }
}
