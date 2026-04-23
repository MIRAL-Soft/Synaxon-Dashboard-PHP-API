<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Unit\Util;

use InvalidArgumentException;
use miralsoft\synaxon\api\Util\PaginationIterator;
use PHPUnit\Framework\TestCase;

final class PaginationIteratorTest extends TestCase
{
    public function testWalksAllPages(): void
    {
        $pages = [
            1 => [1, 2, 3, 4, 5],
            2 => [6, 7, 8],
        ];
        $iter = new PaginationIterator(
            fetch: fn (int $p, int $l): array => $pages[$p] ?? [],
            limit: 5,
        );

        self::assertSame([1, 2, 3, 4, 5, 6, 7, 8], iterator_to_array($iter, false));
    }

    public function testStopsOnEmptyBatch(): void
    {
        $iter = new PaginationIterator(
            fetch: fn (int $p, int $l): array => $p === 1 ? [1, 2, 3] : [],
            limit: 3,
        );

        self::assertSame([1, 2, 3], iterator_to_array($iter, false));
    }

    public function testTerminatesOnNonArrayReturn(): void
    {
        $iter = new PaginationIterator(
            fetch: fn (int $p, int $l): mixed => null,
            limit: 10,
        );

        self::assertSame([], iterator_to_array($iter, false));
    }

    public function testRejectsInvalidLimit(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new PaginationIterator(fetch: fn () => [], limit: 0);
    }

    public function testRejectsNegativeStartPage(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new PaginationIterator(fetch: fn () => [], startPage: -1);
    }

    public function testAbortsIfServerNeverReturnsShortPage(): void
    {
        $iter = new PaginationIterator(
            // Always returns exactly $limit items — a pathological server.
            fetch: fn (int $p, int $l): array => array_fill(0, $l, $p),
            limit: 2,
        );

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessageMatches('/MAX_PAGES/');
        // Force full iteration.
        $count = 0;
        foreach ($iter as $_) {
            if (++$count > 250_000) {
                self::fail('iterator did not abort');
            }
        }
    }
}
