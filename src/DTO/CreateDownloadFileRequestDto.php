<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CreateDownloadFileRequestDto extends AbstractDto
{
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
     * The actual download URL or storage path
     *
     * @return string
     */
    public function getUrl(): string
    {
        return (string) $this->data['url'];
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
