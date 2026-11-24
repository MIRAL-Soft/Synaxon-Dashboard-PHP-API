<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CyanSecurityPartnerPaginatedResponseDto extends AbstractDto
{
    /**
     * Number of items per page
     *
     * @return float
     */
    public function getLimit(): float
    {
        return (float) $this->required('limit');
    }

    /**
     * Current page
     *
     * @return float
     */
    public function getPage(): float
    {
        return (float) $this->required('page');
    }

    /**
     * Total number of items
     *
     * @return float
     */
    public function getTotalItems(): float
    {
        return (float) $this->required('totalItems');
    }

    /**
     * @return list<CyanSecurityPartnerResponseDto>
     */
    public function getData(): array
    {
        $out = [];
        foreach ((array) ($this->data['data'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = CyanSecurityPartnerResponseDto::fromArray($item);
            } elseif ($item instanceof CyanSecurityPartnerResponseDto) {
                $out[] = $item;
            }
        }
        return $out;
    }
}
