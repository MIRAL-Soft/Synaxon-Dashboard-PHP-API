<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CustomerRankingItemDto extends AbstractDto
{
    /**
     * Customer ID from the customer module (omitted if not linked)
     *
     * @return float|null
     */
    public function getCustomerId(): ?float
    {
        $v = $this->data['customerId'] ?? null;
        return $v === null ? null : (float) $v;
    }

    /**
     * Customer name
     *
     * @return string
     */
    public function getCustomerName(): string
    {
        return (string) $this->data['customerName'];
    }

    /**
     * Status for each active module
     *
     * @return list<CustomerModuleStatusDto>
     */
    public function getModules(): array
    {
        $out = [];
        foreach ((array) ($this->data['modules'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = CustomerModuleStatusDto::fromArray($item);
            } elseif ($item instanceof CustomerModuleStatusDto) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * Total items across all modules
     *
     * @return float
     */
    public function getTotalItems(): float
    {
        return (float) $this->data['totalItems'];
    }

    /**
     * Total errors across all modules
     *
     * @return float
     */
    public function getTotalErrors(): float
    {
        return (float) $this->data['totalErrors'];
    }

    /**
     * Overall score as percentage (0-100), calculated across all modules
     *
     * @return float
     */
    public function getOverallScore(): float
    {
        return (float) $this->data['overallScore'];
    }
}
