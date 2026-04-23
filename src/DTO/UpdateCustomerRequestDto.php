<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class UpdateCustomerRequestDto extends AbstractDto
{
    /**
     * The name of the customer
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        $v = $this->data['name'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * The customer number
     *
     * @return string|null
     */
    public function getCustomerNumber(): ?string
    {
        $v = $this->data['customerNumber'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Defines if the customer is a corporate customer
     *
     * @return bool|null
     */
    public function getCorporateCustomer(): ?bool
    {
        $v = $this->data['corporateCustomer'] ?? null;
        return $v === null ? null : (bool) $v;
    }

    /**
     * Some additional information about the customer
     *
     * @return string|null
     */
    public function getComment(): ?string
    {
        $v = $this->data['comment'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * The salutation of the customer
     *
     * @return string|null
     */
    public function getSalutation(): ?string
    {
        $v = $this->data['salutation'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * The street of the customer
     *
     * @return string|null
     */
    public function getStreet(): ?string
    {
        $v = $this->data['street'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * The postal code of the customer
     *
     * @return string|null
     */
    public function getPostalCode(): ?string
    {
        $v = $this->data['postalCode'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * The city of the customer
     *
     * @return string|null
     */
    public function getCity(): ?string
    {
        $v = $this->data['city'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Country ISO 3166-1 A-2 code
     *
     * @return string|null
     */
    public function getCountry(): ?string
    {
        $v = $this->data['country'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * The email address of the customer
     *
     * @return string|null
     */
    public function getEmail(): ?string
    {
        $v = $this->data['email'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * The fax number of the customer
     *
     * @return string|null
     */
    public function getFax(): ?string
    {
        $v = $this->data['fax'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * The mobile phone number of the customer
     *
     * @return string|null
     */
    public function getMobile(): ?string
    {
        $v = $this->data['mobile'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * The phone number of the customer
     *
     * @return string|null
     */
    public function getPhone(): ?string
    {
        $v = $this->data['phone'] ?? null;
        return $v === null ? null : (string) $v;
    }
}
