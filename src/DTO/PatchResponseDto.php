<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class PatchResponseDto extends AbstractDto
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
     * N-Sight Patch ID
     *
     * @return float
     */
    public function getPatchId(): float
    {
        return (float) $this->data['patchId'];
    }

    /**
     * Patch qualification status
     *
     * @return string
     */
    public function getStatus(): string
    {
        return (string) $this->data['status'];
    }

    /**
     * Patch URL
     *
     * @return string|null
     */
    public function getUrl(): ?string
    {
        $v = $this->data['url'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Patch qualification reason
     *
     * @return string|null
     */
    public function getReason(): ?string
    {
        $v = $this->data['reason'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * URL with further information about the patch
     *
     * @return string|null
     */
    public function getPatchUrl(): ?string
    {
        $v = $this->data['patchUrl'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Name of patch
     *
     * @return string
     */
    public function getPatchTitle(): string
    {
        return (string) $this->data['patchTitle'];
    }

    /**
     * Product of patch
     *
     * @return string
     */
    public function getProduct(): string
    {
        return (string) $this->data['product'];
    }

    /**
     * Severity of patch
     *
     * @return string|null
     */
    public function getSeverity(): ?string
    {
        $v = $this->data['severity'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Release date of patch
     *
     * @return string|null
     */
    public function getReleaseDate(): ?string
    {
        $v = $this->data['releaseDate'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Classification of patch
     *
     * @return string|null
     */
    public function getClassification(): ?string
    {
        $v = $this->data['classification'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Device type of patch
     *
     * @return string
     */
    public function getDeviceType(): string
    {
        return (string) $this->data['deviceType'];
    }
}
