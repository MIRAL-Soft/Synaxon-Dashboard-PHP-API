<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Query;

/**
 * Fluent builder for query parameters used with list/find endpoints.
 *
 * The builder produces a flat associative array suitable for Guzzle's "query"
 * option. Filter entries are serialised as "<field>=<operator>:<value>".
 */
final class QueryBuilder
{
    /** @var array<string, scalar|array<int, scalar>> */
    private array $params = [];

    /** @var list<string> */
    private array $filters = [];

    public function limit(int $limit): self
    {
        $this->params['limit'] = $limit;

        return $this;
    }

    public function offset(int $offset): self
    {
        $this->params['offset'] = $offset;

        return $this;
    }

    public function page(int $page): self
    {
        $this->params['page'] = $page;

        return $this;
    }

    public function orderBy(string $field, string $direction = 'asc'): self
    {
        $direction = strtolower($direction) === 'desc' ? 'desc' : 'asc';
        $this->params['orderBy'] = $field;
        $this->params['orderDirection'] = $direction;

        return $this;
    }

    /**
     * @param scalar|list<scalar> $value
     */
    public function where(string $field, FilterOperator $op, int|float|string|bool|array $value): self
    {
        $serialised = is_array($value)
            ? implode(',', array_map(static fn ($v): string => (string) $v, $value))
            : (string) $value;

        $this->filters[] = sprintf('%s=%s:%s', $field, $op->value, $serialised);

        return $this;
    }

    /**
     * Merge an additional parameter into the query.
     */
    public function with(string $key, int|float|string|bool $value): self
    {
        $this->params[$key] = $value;

        return $this;
    }

    /**
     * @return array<string, scalar|array<int, scalar>>
     */
    public function toArray(): array
    {
        $out = $this->params;
        if ($this->filters !== []) {
            $out['filter'] = $this->filters;
        }

        return $out;
    }
}
