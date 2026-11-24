<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CreateCloudallyCustomerRequestDto extends AbstractDto
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->required('name');
    }

    /**
     * Set the "name" field.
     *
     * @return static
     */
    public function withName(?string $value): static
    {
        return $this->with('name', $value);
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return (string) $this->required('email');
    }

    /**
     * Set the "email" field.
     *
     * @return static
     */
    public function withEmail(?string $value): static
    {
        return $this->with('email', $value);
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return (string) $this->required('password');
    }

    /**
     * Set the "password" field.
     *
     * @return static
     */
    public function withPassword(?string $value): static
    {
        return $this->with('password', $value);
    }
}
