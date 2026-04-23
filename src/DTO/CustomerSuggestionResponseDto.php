<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CustomerSuggestionResponseDto extends AbstractDto
{
    /**
     * @return CustomerResponseDto
     */
    public function getCustomer(): CustomerResponseDto
    {
        $v = $this->data['customer'] ?? null;
        if (is_array($v)) {
            return CustomerResponseDto::fromArray($v);
        }
        if ($v instanceof CustomerResponseDto) {
            return $v;
        }
        return CustomerResponseDto::fromArray([]);
    }

    /**
     * @return float
     */
    public function getScore(): float
    {
        return (float) $this->data['score'];
    }
}
