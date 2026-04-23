<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Util;

use Generator;
use InvalidArgumentException;
use IteratorAggregate;

/**
 * Simple cursor-style iterator that walks a paginated endpoint.
 *
 * The iterator invokes the supplied fetch closure with an increasing page
 * number until the closure returns an empty list or a short page (fewer
 * items than the configured limit, which signals the last page).
 *
 * A hard upper bound on the number of pages visited (MAX_PAGES) protects
 * against a misbehaving server that always returns a full page — the
 * iterator will terminate with an InvalidArgumentException rather than
 * spin forever.
 *
 * @template T
 * @implements IteratorAggregate<int, T>
 */
final class PaginationIterator implements IteratorAggregate
{
    public const MAX_PAGES = 100_000;

    /**
     * @param callable(int $page, int $limit): list<T> $fetch
     */
    public function __construct(
        private readonly mixed $fetch,
        private readonly int $limit = 100,
        private readonly int $startPage = 1,
    ) {
        if (!is_callable($this->fetch)) {
            throw new InvalidArgumentException('$fetch must be callable');
        }
        if ($this->limit < 1) {
            throw new InvalidArgumentException('$limit must be >= 1');
        }
        if ($this->startPage < 0) {
            throw new InvalidArgumentException('$startPage must be >= 0');
        }
    }

    /**
     * @return Generator<int, T>
     */
    public function getIterator(): Generator
    {
        $page = $this->startPage;
        $fetch = $this->fetch;
        $visited = 0;

        while (true) {
            /** @var mixed $batch */
            $batch = $fetch($page, $this->limit);

            // Defensive: a non-array return terminates iteration cleanly
            // rather than producing a TypeError deep in user code.
            if (!is_array($batch) || $batch === []) {
                return;
            }

            foreach ($batch as $item) {
                /** @var T $item */
                yield $item;
            }

            if (count($batch) < $this->limit) {
                return;
            }

            $page++;
            $visited++;
            if ($visited >= self::MAX_PAGES) {
                throw new InvalidArgumentException(sprintf(
                    'PaginationIterator aborted: exceeded MAX_PAGES (%d) — server likely never returns a short page.',
                    self::MAX_PAGES
                ));
            }
        }
    }
}
