<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Util;

use Generator;
use IteratorAggregate;

/**
 * Simple cursor-style iterator that walks a paginated endpoint.
 *
 * The iterator invokes the supplied fetch closure with an increasing page
 * number until the closure returns an empty list.
 *
 * @template T
 * @implements IteratorAggregate<int, T>
 */
final class PaginationIterator implements IteratorAggregate
{
    /**
     * @param callable(int $page, int $limit): list<T> $fetch
     */
    public function __construct(
        private readonly mixed $fetch,
        private readonly int $limit = 100,
        private readonly int $startPage = 1,
    ) {
    }

    /**
     * @return Generator<int, T>
     */
    public function getIterator(): Generator
    {
        $page = $this->startPage;
        $fetch = $this->fetch;

        while (true) {
            /** @var list<T> $batch */
            $batch = $fetch($page, $this->limit);
            if ($batch === []) {
                return;
            }
            foreach ($batch as $item) {
                yield $item;
            }
            if (count($batch) < $this->limit) {
                return;
            }
            $page++;
        }
    }
}
