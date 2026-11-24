<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class DashboardLayoutResponseDto extends AbstractDto
{
    /**
     * Entity unique identifier
     *
     * @return string
     */
    public function getId(): string
    {
        return (string) $this->required('id');
    }

    /**
     * Entity creation date and time
     *
     * @return string
     */
    public function getCreatedAt(): string
    {
        return (string) $this->required('createdAt');
    }

    /**
     * Date and time of last update
     *
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return (string) $this->required('updatedAt');
    }

    /**
     * The tenant ID that owns this layout
     *
     * @return string
     */
    public function getTenantId(): string
    {
        return (string) $this->required('tenantId');
    }

    /**
     * The user ID for user-specific layouts (optional)
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
        return (string) $this->required('name');
    }

    /**
     * Whether this is a default layout
     *
     * @return bool
     */
    public function getDefault(): bool
    {
        return (bool) $this->required('default');
    }

    /**
     * Order of layout categories to display
     *
     * @return list<string>
     */
    public function getLayout(): array
    {
        return array_values(array_map('strval', (array) ($this->data['layout'] ?? [])));
    }

    /**
     * Managed Email Archiving layout items
     *
     * @return list<LayoutItemDto>
     */
    public function getMeaLayout(): array
    {
        $out = [];
        foreach ((array) ($this->data['meaLayout'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = LayoutItemDto::fromArray($item);
            } elseif ($item instanceof LayoutItemDto) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * Remote Monitoring & Management layout items
     *
     * @return list<LayoutItemDto>
     */
    public function getRmmLayout(): array
    {
        $out = [];
        foreach ((array) ($this->data['rmmLayout'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = LayoutItemDto::fromArray($item);
            } elseif ($item instanceof LayoutItemDto) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * Managed Security Audit layout items
     *
     * @return list<LayoutItemDto>
     */
    public function getMsaLayout(): array
    {
        $out = [];
        foreach ((array) ($this->data['msaLayout'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = LayoutItemDto::fromArray($item);
            } elseif ($item instanceof LayoutItemDto) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * Managed Endpoint Security layout items
     *
     * @return list<LayoutItemDto>
     */
    public function getMesLayout(): array
    {
        $out = [];
        foreach ((array) ($this->data['mesLayout'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = LayoutItemDto::fromArray($item);
            } elseif ($item instanceof LayoutItemDto) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * Managed Backup layout items
     *
     * @return list<LayoutItemDto>
     */
    public function getMbLayout(): array
    {
        $out = [];
        foreach ((array) ($this->data['mbLayout'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = LayoutItemDto::fromArray($item);
            } elseif ($item instanceof LayoutItemDto) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * Managed C2C layout items
     *
     * @return list<LayoutItemDto>
     */
    public function getMc2cLayout(): array
    {
        $out = [];
        foreach ((array) ($this->data['mc2cLayout'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = LayoutItemDto::fromArray($item);
            } elseif ($item instanceof LayoutItemDto) {
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
        return (string) $this->required('type');
    }
}
