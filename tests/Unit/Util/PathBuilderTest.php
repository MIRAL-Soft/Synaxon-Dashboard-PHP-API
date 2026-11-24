<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Unit\Util;

use InvalidArgumentException;
use miralsoft\synaxon\api\Util\PathBuilder;
use PHPUnit\Framework\Attributes\DataProvider;
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

    /**
     * URI resolution removes dot segments, so ".." as an id would turn
     * DELETE /v1/customers/abc/references/.. into DELETE /v1/customers/abc/.
     */
    #[DataProvider('dotSegmentProvider')]
    public function testRejectsDotSegmentParam(string $value): void
    {
        $this->expectException(InvalidArgumentException::class);
        PathBuilder::expand('/v1/customers/{id}/references/{refId}', ['id' => 'abc', 'refId' => $value]);
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function dotSegmentProvider(): iterable
    {
        yield 'current' => ['.'];
        yield 'parent' => ['..'];
    }

    public function testKeepsDotsInsideValues(): void
    {
        self::assertSame('/v1/files/a..b', PathBuilder::expand('/v1/files/{id}', ['id' => 'a..b']));
        self::assertSame('/v1/files/..%2Fx', PathBuilder::expand('/v1/files/{id}', ['id' => '../x']));
    }
}
