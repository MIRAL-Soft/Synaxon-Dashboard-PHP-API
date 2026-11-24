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
        return (float) $this->required('rank');
    }

    /**
     * @return string
     */
    public function getSiteId(): string
    {
        return (string) $this->required('siteId');
    }

    /**
     * @return string
     */
    public function getSiteName(): string
    {
        return (string) $this->required('siteName');
    }

    /**
     * Score as percentage (0-100)
     *
     * @return float
     */
    public function getScore(): float
    {
        return (float) $this->required('score');
    }
}
