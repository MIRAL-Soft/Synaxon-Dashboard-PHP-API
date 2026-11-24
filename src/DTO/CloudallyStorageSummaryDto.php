<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CloudallyStorageSummaryDto extends AbstractDto
{
    /**
     * Number of Google seats
     *
     * @return float
     */
    public function getGoogleSeats(): float
    {
        return (float) $this->required('googleSeats');
    }

    /**
     * Number of Microsoft 365 seats
     *
     * @return float
     */
    public function getMs365Seats(): float
    {
        return (float) $this->required('ms365Seats');
    }

    /**
     * MS365 Groups storage in bytes
     *
     * @return float
     */
    public function getMs365Groups(): float
    {
        return (float) $this->required('ms365Groups');
    }

    /**
     * SharePoint storage in bytes
     *
     * @return float
     */
    public function getSharepointMulti(): float
    {
        return (float) $this->required('sharepointMulti');
    }

    /**
     * OneDrive storage in bytes
     *
     * @return float
     */
    public function getOnedrive(): float
    {
        return (float) $this->required('onedrive');
    }

    /**
     * Dropbox storage in bytes
     *
     * @return float
     */
    public function getDropbox(): float
    {
        return (float) $this->required('dropbox');
    }
}
