<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CreateDashboardLayoutRequestDto extends AbstractDto
{
    /**
     * User ID for user-specific layouts (optional)
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
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->data['name'];
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
     * @return list<CreateLayoutItemDto>
     */
    public function getMeaLayout(): array
    {
        $out = [];
        foreach ((array) ($this->data['meaLayout'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = CreateLayoutItemDto::fromArray($item);
            } elseif ($item instanceof CreateLayoutItemDto) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * Remote Monitoring & Management layout items
     *
     * @return list<CreateLayoutItemDto>
     */
    public function getRmmLayout(): array
    {
        $out = [];
        foreach ((array) ($this->data['rmmLayout'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = CreateLayoutItemDto::fromArray($item);
            } elseif ($item instanceof CreateLayoutItemDto) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * Managed Security Audit layout items
     *
     * @return list<CreateLayoutItemDto>
     */
    public function getMsaLayout(): array
    {
        $out = [];
        foreach ((array) ($this->data['msaLayout'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = CreateLayoutItemDto::fromArray($item);
            } elseif ($item instanceof CreateLayoutItemDto) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * Managed Endpoint Security layout items
     *
     * @return list<CreateLayoutItemDto>
     */
    public function getMesLayout(): array
    {
        $out = [];
        foreach ((array) ($this->data['mesLayout'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = CreateLayoutItemDto::fromArray($item);
            } elseif ($item instanceof CreateLayoutItemDto) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * Managed Backup layout items
     *
     * @return list<CreateLayoutItemDto>
     */
    public function getMbLayout(): array
    {
        $out = [];
        foreach ((array) ($this->data['mbLayout'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = CreateLayoutItemDto::fromArray($item);
            } elseif ($item instanceof CreateLayoutItemDto) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * Type of dashboard layout
     *
     * @return string
     */
    public function getType(): string
    {
        return (string) $this->data['type'];
    }
}
