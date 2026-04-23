<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class EsetCustomerResponseDto extends AbstractDto
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
     * The customer id of the customer
     *
     * @return float|null
     */
    public function getCustomerId(): ?float
    {
        $v = $this->data['customerId'] ?? null;
        return $v === null ? null : (float) $v;
    }

    /**
     * The eset partner id of the customer
     *
     * @return string
     */
    public function getParentId(): string
    {
        return (string) $this->data['parentId'];
    }

    /**
     * The eset id of the customer
     *
     * @return string
     */
    public function getVendorId(): string
    {
        return (string) $this->data['vendorId'];
    }

    /**
     * The type of the customer
     *
     * @return float
     */
    public function getType(): float
    {
        return (float) $this->data['type'];
    }

    /**
     * The status of the customer
     *
     * @return float
     */
    public function getStatus(): float
    {
        return (float) $this->data['status'];
    }

    /**
     * The tenant id of the customer
     *
     * @return string
     */
    public function getTenantId(): string
    {
        return (string) $this->data['tenantId'];
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
     * The management type of the customer
     *
     * @return string
     */
    public function getManagementType(): string
    {
        return (string) $this->data['managementType'];
    }

    /**
     * The licenses of the customer
     *
     * @return list<EsetLicenseResponseDto>
     */
    public function getLicenses(): array
    {
        $out = [];
        foreach ((array) ($this->data['licenses'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = EsetLicenseResponseDto::fromArray($item);
            } elseif ($item instanceof EsetLicenseResponseDto) {
                $out[] = $item;
            }
        }
        return $out;
    }
}
