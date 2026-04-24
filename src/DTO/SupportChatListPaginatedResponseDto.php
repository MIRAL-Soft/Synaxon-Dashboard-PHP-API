<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class SupportChatListPaginatedResponseDto extends AbstractDto
{
    /**
     * Number of items per page
     *
     * @return float
     */
    public function getLimit(): float
    {
        return (float) $this->data['limit'];
    }

    /**
     * Current page
     *
     * @return float
     */
    public function getPage(): float
    {
        return (float) $this->data['page'];
    }

    /**
     * Total number of items
     *
     * @return float
     */
    public function getTotalItems(): float
    {
        return (float) $this->data['totalItems'];
    }

    /**
     * @return list<SupportChatListItemResponseDto>
     */
    public function getData(): array
    {
        $out = [];
        foreach ((array) ($this->data['data'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = SupportChatListItemResponseDto::fromArray($item);
            } elseif ($item instanceof SupportChatListItemResponseDto) {
                $out[] = $item;
            }
        }
        return $out;
    }
}
