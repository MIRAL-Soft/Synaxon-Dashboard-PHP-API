<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class DeployPatchesBulkResponseDto extends AbstractDto
{
    /**
     * List of affected customers with device counts
     *
     * @return list<AffectedCustomerResponseDto>
     */
    public function getAffectedCustomers(): array
    {
        $out = [];
        foreach ((array) ($this->data['affectedCustomers'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = AffectedCustomerResponseDto::fromArray($item);
            } elseif ($item instanceof AffectedCustomerResponseDto) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * Total number of devices queued for patch deployment
     *
     * @return float
     */
    public function getTotalDevicesQueued(): float
    {
        return (float) $this->required('totalDevicesQueued');
    }
}
