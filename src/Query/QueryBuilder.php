<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Query;

/**
 * Fluent builder for query parameters used with list/find endpoints.
 *
 * The builder produces an associative array for a resource method's $query
 * argument. The SYNAXON list endpoints accept `page` (counted from 0),
 * `limit` (at most 100), `orderBy`, `orderDirection` and `search`, plus
 * endpoint-specific parameters that with() sets.
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

    /**
     * @deprecated No SYNAXON endpoint declares an `offset` parameter, so the
     *             server ignores it. Use page() and limit(). Kept for
     *             compatibility; will be removed in the next major version.
     */
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
     * Free-text search, supported by every list endpoint.
     */
    public function search(string $term): self
    {
        $this->params['search'] = $term;

        return $this;
    }

    /**
     * @param scalar|list<scalar> $value
     *
     * @deprecated No SYNAXON endpoint declares a `filter` parameter, so the
     *             server ignores these entries. Use with() with the
     *             endpoint's own parameters (for example `status`). Kept for
     *             compatibility; will be removed in the next major version.
     */
    public function where(string $field, FilterOperator $op, int|float|string|bool|array $value): self
    {
        $serialised = is_array($value)
            ? implode(',', array_map(self::scalarToString(...), $value))
            : self::scalarToString($value);

        $this->filters[] = sprintf('%s=%s:%s', $field, $op->value, $serialised);

        return $this;
    }

    /**
     * Set an endpoint-specific parameter. A list is sent as repeated keys
     * (`status=a&status=b`), as the API declares for list parameters.
     *
     * @param scalar|list<scalar> $value
     */
    public function with(string $key, int|float|string|bool|array $value): self
    {
        $this->params[$key] = $value;

        return $this;
    }

    private static function scalarToString(int|float|string|bool $value): string
    {
        return is_bool($value) ? ($value ? 'true' : 'false') : (string) $value;
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
