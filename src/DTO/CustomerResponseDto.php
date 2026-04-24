<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CustomerResponseDto extends AbstractDto
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
     * The name of the customer
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->data['name'];
    }

    /**
     * The customer number
     *
     * @return string
     */
    public function getCustomerNumber(): string
    {
        return (string) $this->data['customerNumber'];
    }

    /**
     * Defines if the customer is a corporate customer
     *
     * @return bool
     */
    public function getCorporateCustomer(): bool
    {
        return (bool) $this->data['corporateCustomer'];
    }

    /**
     * The comment of the customer
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
     * @return string
     */
    public function getSalutation(): string
    {
        return (string) $this->data['salutation'];
    }

    /**
     * The street of the customer
     *
     * @return string
     */
    public function getStreet(): string
    {
        return (string) $this->data['street'];
    }

    /**
     * The postal code of the customer
     *
     * @return string
     */
    public function getPostalCode(): string
    {
        return (string) $this->data['postalCode'];
    }

    /**
     * The city of the customer
     *
     * @return string
     */
    public function getCity(): string
    {
        return (string) $this->data['city'];
    }

    /**
     * The country of the customer
     *
     * @return string
     */
    public function getCountry(): string
    {
        return (string) $this->data['country'];
    }

    /**
     * The email of the customer
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
     * The mobile number of the customer
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

    /**
     * The references of the customer
     *
     * @return list<CustomerReferenceResponseDto>
     */
    public function getReferences(): array
    {
        $out = [];
        foreach ((array) ($this->data['references'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = CustomerReferenceResponseDto::fromArray($item);
            } elseif ($item instanceof CustomerReferenceResponseDto) {
                $out[] = $item;
            }
        }
        return $out;
    }
}
