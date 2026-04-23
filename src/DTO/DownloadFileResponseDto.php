<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class DownloadFileResponseDto extends AbstractDto
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
     * Indicates if the document is public for everyone
     *
     * @return bool
     */
    public function getPublic(): bool
    {
        return (bool) $this->data['public'];
    }

    /**
     * Indicates which tenant the document belongs to
     *
     * @return string|null
     */
    public function getTenantId(): ?string
    {
        $v = $this->data['tenantId'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * The actual download URL
     *
     * @return string|null
     */
    public function getUrl(): ?string
    {
        $v = $this->data['url'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Number of times the URL was accessed
     *
     * @return float|null
     */
    public function getDownloads(): ?float
    {
        $v = $this->data['downloads'] ?? null;
        return $v === null ? null : (float) $v;
    }

    /**
     * Display name of the link
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->data['name'];
    }

    /**
     * Type of the file
     *
     * @return string
     */
    public function getType(): string
    {
        return (string) $this->data['type'];
    }

    /**
     * Describes which product the document belongs to
     *
     * @return string|null
     */
    public function getProduct(): ?string
    {
        $v = $this->data['product'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Target platform for the download file
     *
     * @return string|null
     */
    public function getPlatform(): ?string
    {
        $v = $this->data['platform'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Date until when the file is available for download
     *
     * @return string|null
     */
    public function getAvailableUntil(): ?string
    {
        $v = $this->data['availableUntil'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Indicates if the document is hidden
     *
     * @return bool|null
     */
    public function getHidden(): ?bool
    {
        $v = $this->data['hidden'] ?? null;
        return $v === null ? null : (bool) $v;
    }

    /**
     * Original file name
     *
     * @return string|null
     */
    public function getFileName(): ?string
    {
        $v = $this->data['fileName'] ?? null;
        return $v === null ? null : (string) $v;
    }
}
