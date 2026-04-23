<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CreateAcronisCustomerRequestDto extends AbstractDto
{
    /**
     * The id of the customer
     *
     * @return float|null
     */
    public function getCustomerId(): ?float
    {
        $v = $this->data['customerId'] ?? null;
        return $v === null ? null : (float) $v;
    }

    /**
     * The email address for first user
     *
     * @return string
     */
    public function getEmail(): string
    {
        return (string) $this->data['email'];
    }

    /**
     * The name of the customer
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->data['name'];
    }

    /**
     * The type of the customer
     *
     * @return string
     */
    public function getType(): string
    {
        return (string) $this->data['type'];
    }

    /**
     * The storage location of the customer
     *
     * @return string
     */
    public function getStorage(): string
    {
        return (string) $this->data['storage'];
    }
}
