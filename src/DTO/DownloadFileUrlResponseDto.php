<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class DownloadFileUrlResponseDto extends AbstractDto
{
    /**
     * The presigned URL or direct link to access the file
     *
     * @return string
     */
    public function getUrl(): string
    {
        return (string) $this->data['url'];
    }

    /**
     * The file name
     *
     * @return string
     */
    public function getFileName(): string
    {
        return (string) $this->data['fileName'];
    }
}
