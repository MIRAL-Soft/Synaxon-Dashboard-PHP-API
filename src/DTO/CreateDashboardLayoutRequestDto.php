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
     * Set the "userId" field. User ID for user-specific layouts (optional)
     *
     * @return static
     */
    public function withUserId(?string $value): static
    {
        return $this->with('userId', $value);
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
     * Set the "name" field. The name of the dashboard layout
     *
     * @return static
     */
    public function withName(?string $value): static
    {
        return $this->with('name', $value);
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
     * Set the "layout" field. Order of layout categories to display
     *
     * @param list<string>|null $value
     * @return static
     */
    public function withLayout(?array $value): static
    {
        return $this->with('layout', $value);
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
     * Set the "meaLayout" field. Managed Email Archiving layout items
     *
     * @param list<CreateLayoutItemDto|array<string, mixed>>|null $value
     * @return static
     */
    public function withMeaLayout(?array $value): static
    {
        if ($value !== null) {
            $value = array_map(static fn (mixed $item): mixed => $item instanceof AbstractDto ? $item->toArray() : $item, $value);
        }
        return $this->with('meaLayout', $value);
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
     * Set the "rmmLayout" field. Remote Monitoring & Management layout items
     *
     * @param list<CreateLayoutItemDto|array<string, mixed>>|null $value
     * @return static
     */
    public function withRmmLayout(?array $value): static
    {
        if ($value !== null) {
            $value = array_map(static fn (mixed $item): mixed => $item instanceof AbstractDto ? $item->toArray() : $item, $value);
        }
        return $this->with('rmmLayout', $value);
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
     * Set the "msaLayout" field. Managed Security Audit layout items
     *
     * @param list<CreateLayoutItemDto|array<string, mixed>>|null $value
     * @return static
     */
    public function withMsaLayout(?array $value): static
    {
        if ($value !== null) {
            $value = array_map(static fn (mixed $item): mixed => $item instanceof AbstractDto ? $item->toArray() : $item, $value);
        }
        return $this->with('msaLayout', $value);
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
     * Set the "mesLayout" field. Managed Endpoint Security layout items
     *
     * @param list<CreateLayoutItemDto|array<string, mixed>>|null $value
     * @return static
     */
    public function withMesLayout(?array $value): static
    {
        if ($value !== null) {
            $value = array_map(static fn (mixed $item): mixed => $item instanceof AbstractDto ? $item->toArray() : $item, $value);
        }
        return $this->with('mesLayout', $value);
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
     * Set the "mbLayout" field. Managed Backup layout items
     *
     * @param list<CreateLayoutItemDto|array<string, mixed>>|null $value
     * @return static
     */
    public function withMbLayout(?array $value): static
    {
        if ($value !== null) {
            $value = array_map(static fn (mixed $item): mixed => $item instanceof AbstractDto ? $item->toArray() : $item, $value);
        }
        return $this->with('mbLayout', $value);
    }

    /**
     * Managed C2C layout items
     *
     * @return list<CreateLayoutItemDto>
     */
    public function getMc2cLayout(): array
    {
        $out = [];
        foreach ((array) ($this->data['mc2cLayout'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = CreateLayoutItemDto::fromArray($item);
            } elseif ($item instanceof CreateLayoutItemDto) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * Set the "mc2cLayout" field. Managed C2C layout items
     *
     * @param list<CreateLayoutItemDto|array<string, mixed>>|null $value
     * @return static
     */
    public function withMc2cLayout(?array $value): static
    {
        if ($value !== null) {
            $value = array_map(static fn (mixed $item): mixed => $item instanceof AbstractDto ? $item->toArray() : $item, $value);
        }
        return $this->with('mc2cLayout', $value);
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

    /**
     * Set the "type" field. Type of dashboard layout
     *
     * @return static
     */
    public function withType(?string $value): static
    {
        return $this->with('type', $value);
    }
}
