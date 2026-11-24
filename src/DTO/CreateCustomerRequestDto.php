<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CreateCustomerRequestDto extends AbstractDto
{
    /**
     * The name of the customer
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->required('name');
    }

    /**
     * Set the "name" field. The name of the customer
     *
     * @return static
     */
    public function withName(?string $value): static
    {
        return $this->with('name', $value);
    }

    /**
     * The customer number
     *
     * @return string
     */
    public function getCustomerNumber(): string
    {
        return (string) $this->required('customerNumber');
    }

    /**
     * Set the "customerNumber" field. The customer number
     *
     * @return static
     */
    public function withCustomerNumber(?string $value): static
    {
        return $this->with('customerNumber', $value);
    }

    /**
     * Defines if the customer is a corporate customer
     *
     * @return bool
     */
    public function getCorporateCustomer(): bool
    {
        return (bool) $this->required('corporateCustomer');
    }

    /**
     * Set the "corporateCustomer" field. Defines if the customer is a corporate customer
     *
     * @return static
     */
    public function withCorporateCustomer(?bool $value): static
    {
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
        return $this->with('comment', $value);
    }

    /**
     * The salutation of the customer
     *
     * @return string
     */
    public function getSalutation(): string
    {
        return (string) $this->required('salutation');
    }

    /**
     * Set the "salutation" field. The salutation of the customer
     *
     * @return static
     */
    public function withSalutation(?string $value): static
    {
        return $this->with('salutation', $value);
    }

    /**
     * The street of the customer
     *
     * @return string
     */
    public function getStreet(): string
    {
        return (string) $this->required('street');
    }

    /**
     * Set the "street" field. The street of the customer
     *
     * @return static
     */
    public function withStreet(?string $value): static
    {
        return $this->with('street', $value);
    }

    /**
     * The postal code of the customer
     *
     * @return string
     */
    public function getPostalCode(): string
    {
        return (string) $this->required('postalCode');
    }

    /**
     * Set the "postalCode" field. The postal code of the customer
     *
     * @return static
     */
    public function withPostalCode(?string $value): static
    {
        return $this->with('postalCode', $value);
    }

    /**
     * The city of the customer
     *
     * @return string
     */
    public function getCity(): string
    {
        return (string) $this->required('city');
    }

    /**
     * Set the "city" field. The city of the customer
     *
     * @return static
     */
    public function withCity(?string $value): static
    {
        return $this->with('city', $value);
    }

    /**
     * Country ISO 3166-1 A-2 code
     *
     * @return string
     */
    public function getCountry(): string
    {
        return (string) $this->required('country');
    }

    /**
     * Set the "country" field. Country ISO 3166-1 A-2 code
     *
     * @return static
     */
    public function withCountry(?string $value): static
    {
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
        return $this->with('phone', $value);
    }
}
