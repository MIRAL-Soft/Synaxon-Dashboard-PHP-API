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
     * Set the "userId" field. User ID for user-specific layouts (optional, set to null to remove)
     *
     * @return static
     */
    public function withUserId(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('userId', $value);
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
     * Set the "name" field. The name of the dashboard layout
     *
     * @return static
     */
    public function withName(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('name', $value);
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
     * Set the "layout" field. Order of layout categories to display
     *
     * @return static
     */
    public function withLayout(?array $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('layout', $value);
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
     * Set the "meaLayout" field. Managed Email Archiving layout items
     *
     * @return static
     */
    public function withMeaLayout(?array $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('meaLayout', $value);
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
     * Set the "rmmLayout" field. Remote Monitoring & Management layout items
     *
     * @return static
     */
    public function withRmmLayout(?array $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('rmmLayout', $value);
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
     * Set the "msaLayout" field. Managed Security Audit layout items
     *
     * @return static
     */
    public function withMsaLayout(?array $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('msaLayout', $value);
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
     * Set the "mesLayout" field. Managed Endpoint Security layout items
     *
     * @return static
     */
    public function withMesLayout(?array $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('mesLayout', $value);
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
     * Set the "mbLayout" field. Managed Backup layout items
     *
     * @return static
     */
    public function withMbLayout(?array $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('mbLayout', $value);
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

    /**
     * Set the "type" field. Type of dashboard layout
     *
     * @return static
     */
    public function withType(?string $value): static
    {
        $value = $value instanceof AbstractDto ? $value->toArray() : $value;
        return $this->with('type', $value);
    }
}
