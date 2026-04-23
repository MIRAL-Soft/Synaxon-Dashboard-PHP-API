<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class UpdateDashboardLayoutRequestDto extends AbstractDto
{
    /**
     * User ID for user-specific layouts (optional, set to null to remove)
     *
     * @return string|null
     */
    public function getUserId(): ?string
    {
        $v = $this->data['userId'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * The name of the dashboard layout
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        $v = $this->data['name'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Order of layout categories to display
     *
     * @return list<string>
     */
    public function getLayout(): array
    {
        return (array) ($this->data['layout'] ?? []);
    }

    /**
     * Managed Email Archiving layout items
     *
     * @return list<UpdateLayoutItemDto>
     */
    public function getMeaLayout(): array
    {
        $out = [];
        foreach ((array) ($this->data['meaLayout'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = UpdateLayoutItemDto::fromArray($item);
            } elseif ($item instanceof UpdateLayoutItemDto) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * Remote Monitoring & Management layout items
     *
     * @return list<UpdateLayoutItemDto>
     */
    public function getRmmLayout(): array
    {
        $out = [];
        foreach ((array) ($this->data['rmmLayout'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = UpdateLayoutItemDto::fromArray($item);
            } elseif ($item instanceof UpdateLayoutItemDto) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * Managed Security Audit layout items
     *
     * @return list<UpdateLayoutItemDto>
     */
    public function getMsaLayout(): array
    {
        $out = [];
        foreach ((array) ($this->data['msaLayout'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = UpdateLayoutItemDto::fromArray($item);
            } elseif ($item instanceof UpdateLayoutItemDto) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * Managed Endpoint Security layout items
     *
     * @return list<UpdateLayoutItemDto>
     */
    public function getMesLayout(): array
    {
        $out = [];
        foreach ((array) ($this->data['mesLayout'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = UpdateLayoutItemDto::fromArray($item);
            } elseif ($item instanceof UpdateLayoutItemDto) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * Managed Backup layout items
     *
     * @return list<UpdateLayoutItemDto>
     */
    public function getMbLayout(): array
    {
        $out = [];
        foreach ((array) ($this->data['mbLayout'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = UpdateLayoutItemDto::fromArray($item);
            } elseif ($item instanceof UpdateLayoutItemDto) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * Type of dashboard layout
     *
     * @return string|null
     */
    public function getType(): ?string
    {
        $v = $this->data['type'] ?? null;
        return $v === null ? null : (string) $v;
    }
}
