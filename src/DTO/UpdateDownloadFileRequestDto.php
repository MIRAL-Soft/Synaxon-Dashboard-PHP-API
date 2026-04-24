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
     * Set the "public" field. Indicates if the document is public for everyone
     *
     * @return static
     */
    public function withPublic(?bool $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('public', $value);
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
     * Set the "tenantId" field. Indicates which tenant the document belongs to. Must be undefined when public is true.
     *
     * @return static
     */
    public function withTenantId(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('tenantId', $value);
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
     * Set the "url" field. The actual download URL
     *
     * @return static
     */
    public function withUrl(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('url', $value);
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
     * Set the "count" field. Number of times the URL was accessed
     *
     * @return static
     */
    public function withCount(?float $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('count', $value);
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
     * Set the "name" field. Display name of the link
     *
     * @return static
     */
    public function withName(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('name', $value);
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
     * Set the "type" field. Type of the file
     *
     * @return static
     */
    public function withType(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('type', $value);
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
     * Set the "product" field. Describes which product the document belongs to (based on ProductAgreementType). Can be empty, meaning "general".
     *
     * @return static
     */
    public function withProduct(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('product', $value);
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
     * Set the "platform" field. Target platform for the download file
     *
     * @return static
     */
    public function withPlatform(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('platform', $value);
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
     * Set the "availableUntil" field. Date until when the file is available for download
     *
     * @return static
     */
    public function withAvailableUntil(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('availableUntil', $value);
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
     * Set the "fileName" field. Original file name
     *
     * @return static
     */
    public function withFileName(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('fileName', $value);
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
     * Set the "hidden" field. Indicates if the document is hidden
     *
     * @return static
     */
    public function withHidden(?bool $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('hidden', $value);
    }
}
