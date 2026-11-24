<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class SmtpConfigResponseDto extends AbstractDto
{
    /**
     * Entity unique identifier
     *
     * @return string
     */
    public function getId(): string
    {
        return (string) $this->required('id');
    }

    /**
     * Entity creation date and time
     *
     * @return string
     */
    public function getCreatedAt(): string
    {
        return (string) $this->required('createdAt');
    }

    /**
     * Date and time of last update
     *
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return (string) $this->required('updatedAt');
    }

    /**
     * Tenant ID
     *
     * @return string
     */
    public function getTenantId(): string
    {
        return (string) $this->required('tenantId');
    }

    /**
     * SMTP server host
     *
     * @return string
     */
    public function getHost(): string
    {
        return (string) $this->required('host');
    }

    /**
     * SMTP server port
     *
     * @return float
     */
    public function getPort(): float
    {
        return (float) $this->required('port');
    }

    /**
     * Encryption mode used for the SMTP connection
     *
     * @return string
     */
    public function getEncryption(): string
    {
        return (string) $this->required('encryption');
    }

    /**
     * SMTP username
     *
     * @return string
     */
    public function getUsername(): string
    {
        return (string) $this->required('username');
    }

    /**
     * Sender email address
     *
     * @return string
     */
    public function getFromAddress(): string
    {
        return (string) $this->required('fromAddress');
    }

    /**
     * Sender display name
     *
     * @return string|null
     */
    public function getFromDisplayName(): ?string
    {
        $v = $this->data['fromDisplayName'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * SMTP config status
     *
     * @return string
     */
    public function getStatus(): string
    {
        return (string) $this->required('status');
    }

    /**
     * Last error message encountered while verifying or using this SMTP config, if any
     *
     * @return string|null
     */
    public function getLastError(): ?string
    {
        $v = $this->data['lastError'] ?? null;
        return $v === null ? null : (string) $v;
    }
}
