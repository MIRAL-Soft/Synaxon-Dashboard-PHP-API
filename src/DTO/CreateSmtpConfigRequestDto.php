<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CreateSmtpConfigRequestDto extends AbstractDto
{
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
     * Set the "host" field. SMTP server host
     *
     * @return static
     */
    public function withHost(?string $value): static
    {
        return $this->with('host', $value);
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
     * Set the "port" field. SMTP server port
     *
     * @return static
     */
    public function withPort(?float $value): static
    {
        return $this->with('port', $value);
    }

    /**
     * Encryption mode to use for the SMTP connection
     *
     * @return string
     */
    public function getEncryption(): string
    {
        return (string) $this->required('encryption');
    }

    /**
     * Set the "encryption" field. Encryption mode to use for the SMTP connection
     *
     * @return static
     */
    public function withEncryption(?string $value): static
    {
        return $this->with('encryption', $value);
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
     * Set the "username" field. SMTP username
     *
     * @return static
     */
    public function withUsername(?string $value): static
    {
        return $this->with('username', $value);
    }

    /**
     * SMTP password
     *
     * @return string
     */
    public function getPassword(): string
    {
        return (string) $this->required('password');
    }

    /**
     * Set the "password" field. SMTP password
     *
     * @return static
     */
    public function withPassword(?string $value): static
    {
        return $this->with('password', $value);
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
     * Set the "fromAddress" field. Sender email address
     *
     * @return static
     */
    public function withFromAddress(?string $value): static
    {
        return $this->with('fromAddress', $value);
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
     * Set the "fromDisplayName" field. Sender display name
     *
     * @return static
     */
    public function withFromDisplayName(?string $value): static
    {
        return $this->with('fromDisplayName', $value);
    }
}
