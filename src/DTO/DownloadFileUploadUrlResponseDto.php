<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class DownloadFileUploadUrlResponseDto extends AbstractDto
{
    /**
     * The presigned URL or direct link to upload the file to
     *
     * @return string
     */
    public function getUrl(): string
    {
        return (string) $this->data['url'];
    }
}
