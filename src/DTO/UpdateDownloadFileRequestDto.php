<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class UpdateDownloadFileRequestDto extends AbstractDto
{
    /**
     * Indicates if the document is public for everyone
     *
     * @return bool|null
     */
    public function getPublic(): ?bool
    {
        $v = $this->data['public'] ?? null;
        return $v === null ? null : (bool) $v;
    }

    /**
     * Indicates which tenant the document belongs to. Must be undefined when public is true.
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
    public function getCount(): ?float
    {
        $v = $this->data['count'] ?? null;
        return $v === null ? null : (float) $v;
    }

    /**
     * Display name of the link
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        $v = $this->data['name'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Type of the file
     *
     * @return string|null
     */
    public function getType(): ?string
    {
        $v = $this->data['type'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Describes which product the document belongs to (based on ProductAgreementType). Can be empty, meaning "general".
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
     * Original file name
     *
     * @return string|null
     */
    public function getFileName(): ?string
    {
        $v = $this->data['fileName'] ?? null;
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
}
