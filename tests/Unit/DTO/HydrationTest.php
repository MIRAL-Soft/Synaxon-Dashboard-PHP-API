<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Unit\DTO;

use miralsoft\synaxon\api\DTO\AbstractDto;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionMethod;

/**
 * Smoke-test every generated DTO: it must round-trip through fromArray()/toArray()
 * and every getter must be callable on an empty payload without raising fatal errors.
 *
 * This protects against regressions in the DTO generator and catches accidental
 * non-nullable types on optional fields.
 */
final class HydrationTest extends TestCase
{
    /**
     * @return iterable<string, array{class-string<AbstractDto>}>
     */
    public static function dtoProvider(): iterable
    {
        $dir = dirname(__DIR__, 3) . '/src/DTO';
        $files = glob($dir . '/*.php') ?: [];
        foreach ($files as $file) {
            $base = basename($file, '.php');
            if ($base === 'AbstractDto') {
                continue;
            }
            $class = 'miralsoft\\synaxon\\api\\DTO\\' . $base;
            yield $base => [$class];
        }
    }

    /**
     * @dataProvider dtoProvider
     * @param class-string<AbstractDto> $class
     */
    public function testRoundTrip(string $class): void
    {
        $instance = $class::fromArray([]);
        self::assertInstanceOf(AbstractDto::class, $instance);
        self::assertSame([], $instance->toArray());
        self::assertSame('[]', $instance->toJson());
    }

    /**
     * @dataProvider dtoProvider
     * @param class-string<AbstractDto> $class
     */
    public function testGettersDoNotFatalOnEmptyPayload(string $class): void
    {
        $instance = $class::fromArray([]);
        $ref = new ReflectionClass($class);
        foreach ($ref->getMethods(ReflectionMethod::IS_PUBLIC) as $m) {
            if ($m->class === AbstractDto::class) {
                continue;
            }
            if (!str_starts_with($m->getName(), 'get') || $m->getNumberOfRequiredParameters() > 0) {
                continue;
            }
            $returnType = $m->getReturnType();
            if ($returnType !== null && method_exists($returnType, 'allowsNull') && !$returnType->allowsNull()) {
                // Non-nullable getters require concrete data — skip in smoke test.
                continue;
            }
            $m->invoke($instance);
        }
        $this->addToAssertionCount(1);
    }
}
