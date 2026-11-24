<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CustomerTargetSummaryResponseDto extends AbstractDto
{
    /**
     * Customer ID
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
     * @return string|null
     */
    public function getCustomerName(): ?string
    {
        $v = $this->data['customerName'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Total number of devices for this customer
     *
     * @return float
     */
    public function getDeviceCount(): float
    {
        return (float) $this->required('deviceCount');
    }

    /**
     * Sites belonging to this customer
     *
     * @return list<SiteTargetSummaryResponseDto>
     */
    public function getSites(): array
    {
        $out = [];
        foreach ((array) ($this->data['sites'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = SiteTargetSummaryResponseDto::fromArray($item);
            } elseif ($item instanceof SiteTargetSummaryResponseDto) {
                $out[] = $item;
            }
        }
        return $out;
    }
}
