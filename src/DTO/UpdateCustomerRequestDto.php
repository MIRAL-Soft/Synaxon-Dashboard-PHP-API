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
     * Set the "name" field. The name of the customer
     *
     * @return static
     */
    public function withName(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('name', $value);
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
     * Set the "customerNumber" field. The customer number
     *
     * @return static
     */
    public function withCustomerNumber(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('customerNumber', $value);
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
     * Set the "corporateCustomer" field. Defines if the customer is a corporate customer
     *
     * @return static
     */
    public function withCorporateCustomer(?bool $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('corporateCustomer', $value);
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
     * Set the "comment" field. Some additional information about the customer
     *
     * @return static
     */
    public function withComment(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('comment', $value);
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
     * Set the "salutation" field. The salutation of the customer
     *
     * @return static
     */
    public function withSalutation(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('salutation', $value);
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
     * Set the "street" field. The street of the customer
     *
     * @return static
     */
    public function withStreet(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('street', $value);
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
     * Set the "postalCode" field. The postal code of the customer
     *
     * @return static
     */
    public function withPostalCode(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('postalCode', $value);
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
     * Set the "city" field. The city of the customer
     *
     * @return static
     */
    public function withCity(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('city', $value);
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
     * Set the "country" field. Country ISO 3166-1 A-2 code
     *
     * @return static
     */
    public function withCountry(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('country', $value);
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
     * Set the "email" field. The email address of the customer
     *
     * @return static
     */
    public function withEmail(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('email', $value);
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
     * Set the "fax" field. The fax number of the customer
     *
     * @return static
     */
    public function withFax(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('fax', $value);
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
     * Set the "mobile" field. The mobile phone number of the customer
     *
     * @return static
     */
    public function withMobile(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('mobile', $value);
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

    /**
     * Set the "phone" field. The phone number of the customer
     *
     * @return static
     */
    public function withPhone(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('phone', $value);
    }
}
