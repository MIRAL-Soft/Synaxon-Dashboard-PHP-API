<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class SendSmtpConfigTestEmailRequestDto extends AbstractDto
{
    /**
     * SMTP server host. Defaults to the saved config if omitted.
     *
     * @return string|null
     */
    public function getHost(): ?string
    {
        $v = $this->data['host'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Set the "host" field. SMTP server host. Defaults to the saved config if omitted.
     *
     * @return static
     */
    public function withHost(?string $value): static
    {
        return $this->with('host', $value);
    }

    /**
     * SMTP server port. Defaults to the saved config if omitted.
     *
     * @return float|null
     */
    public function getPort(): ?float
    {
        $v = $this->data['port'] ?? null;
        return $v === null ? null : (float) $v;
    }

    /**
     * Set the "port" field. SMTP server port. Defaults to the saved config if omitted.
     *
     * @return static
     */
    public function withPort(?float $value): static
    {
        return $this->with('port', $value);
    }

    /**
     * Encryption mode. Defaults to the saved config if omitted.
     *
     * @return string|null
     */
    public function getEncryption(): ?string
    {
        $v = $this->data['encryption'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Set the "encryption" field. Encryption mode. Defaults to the saved config if omitted.
     *
     * @return static
     */
    public function withEncryption(?string $value): static
    {
        return $this->with('encryption', $value);
    }

    /**
     * SMTP username. Defaults to the saved config if omitted.
     *
     * @return string|null
     */
    public function getUsername(): ?string
    {
        $v = $this->data['username'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Set the "username" field. SMTP username. Defaults to the saved config if omitted.
     *
     * @return static
     */
    public function withUsername(?string $value): static
    {
        return $this->with('username', $value);
    }

    /**
     * SMTP password. Defaults to the saved config if omitted.
     *
     * @return string|null
     */
    public function getPassword(): ?string
    {
        $v = $this->data['password'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Set the "password" field. SMTP password. Defaults to the saved config if omitted.
     *
     * @return static
     */
    public function withPassword(?string $value): static
    {
        return $this->with('password', $value);
    }

    /**
     * Sender email address. Defaults to the saved config if omitted.
     *
     * @return string|null
     */
    public function getFromAddress(): ?string
    {
        $v = $this->data['fromAddress'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Set the "fromAddress" field. Sender email address. Defaults to the saved config if omitted.
     *
     * @return static
     */
    public function withFromAddress(?string $value): static
    {
        return $this->with('fromAddress', $value);
    }

    /**
     * Sender display name. Defaults to the saved config if omitted.
     *
     * @return string|null
     */
    public function getFromDisplayName(): ?string
    {
        $v = $this->data['fromDisplayName'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Set the "fromDisplayName" field. Sender display name. Defaults to the saved config if omitted.
     *
     * @return static
     */
    public function withFromDisplayName(?string $value): static
    {
        return $this->with('fromDisplayName', $value);
    }
}
