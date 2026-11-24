<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class FindPatchTargetsResponseDto extends AbstractDto
{
    /**
     * Total number of devices affected
     *
     * @return float
     */
    public function getTotalDevices(): float
    {
        return (float) $this->required('totalDevices');
    }

    /**
     * List of affected customers with their sites and device counts
     *
     * @return list<CustomerTargetSummaryResponseDto>
     */
    public function getAffectedCustomers(): array
    {
        $out = [];
        foreach ((array) ($this->data['affectedCustomers'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = CustomerTargetSummaryResponseDto::fromArray($item);
            } elseif ($item instanceof CustomerTargetSummaryResponseDto) {
                $out[] = $item;
            }
        }
        return $out;
    }
}
