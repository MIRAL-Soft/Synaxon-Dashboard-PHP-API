<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Unit\Util;

use InvalidArgumentException;
use miralsoft\synaxon\api\Util\PathBuilder;
use PHPUnit\Framework\TestCase;

final class PathBuilderTest extends TestCase
{
    public function testExpandsParameters(): void
    {
        self::assertSame(
            '/v1/customers/42/references/abc',
            PathBuilder::expand('/v1/customers/{id}/references/{refId}', ['id' => 42, 'refId' => 'abc'])
        );
    }

    public function testUrlEncodesValues(): void
    {
        self::assertSame(
            '/v1/items/foo%20bar',
            PathBuilder::expand('/v1/items/{id}', ['id' => 'foo bar'])
        );
    }

    public function testRejectsMissingParam(): void
    {
        $this->expectException(InvalidArgumentException::class);
        PathBuilder::expand('/v1/items/{id}', []);
    }

    public function testRejectsEmptyParam(): void
    {
        $this->expectException(InvalidArgumentException::class);
        PathBuilder::expand('/v1/items/{id}', ['id' => '']);
    }
}
