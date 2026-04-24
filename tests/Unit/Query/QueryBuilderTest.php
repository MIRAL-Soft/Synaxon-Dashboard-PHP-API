<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Unit\Query;

use miralsoft\synaxon\api\Query\FilterOperator;
use miralsoft\synaxon\api\Query\QueryBuilder;
use PHPUnit\Framework\TestCase;

final class QueryBuilderTest extends TestCase
{
    public function testBuildsParameters(): void
    {
        $q = (new QueryBuilder())
            ->limit(50)
            ->offset(100)
            ->orderBy('createdAt', 'desc')
            ->where('status', FilterOperator::EQ, 'open')
            ->where('id', FilterOperator::IN, [1, 2, 3]);

        $arr = $q->toArray();

        self::assertSame(50, $arr['limit']);
        self::assertSame(100, $arr['offset']);
        self::assertSame('createdAt', $arr['orderBy']);
        self::assertSame('desc', $arr['orderDirection']);
        self::assertSame(['status=eq:open', 'id=in:1,2,3'], $arr['filter']);
    }

    public function testUnknownOrderDirectionFallsBackToAsc(): void
    {
        $q = (new QueryBuilder())->orderBy('id', 'sideways');
        self::assertSame('asc', $q->toArray()['orderDirection']);
    }
}
