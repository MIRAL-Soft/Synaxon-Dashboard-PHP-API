<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Unit;

use miralsoft\synaxon\api\Compat\ApiCompatibility;
use miralsoft\synaxon\api\Compat\ApiSurface;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionMethod;

/**
 * Offline compatibility: the committed spec is fully covered, and the surface
 * ApiCompatibility reports (Compat\ApiSurface) is the one the code really
 * has, so an application calling ApiCompatibility gets a true answer.
 */
final class ApiCompatibilityTest extends TestCase
{
    public function testCommittedSpecIsFullyImplemented(): void
    {
        /** @var array<string, mixed> $spec */
        $spec = json_decode((string) file_get_contents(dirname(__DIR__, 2) . '/docs/openapi.json'), true, 512, JSON_THROW_ON_ERROR);

        $report = ApiCompatibility::compareSpec($spec);

        self::assertTrue($report->isCompatible(), json_encode($report->toArray(), JSON_PRETTY_PRINT) ?: '');
    }

    public function testSurfaceOperationsMatchTheResourceMethods(): void
    {
        $annotated = [];
        foreach (glob(dirname(__DIR__, 2) . '/src/Resource/*Resource.php') ?: [] as $file) {
            $base = basename($file, '.php');
            if ($base === 'AbstractResource') {
                continue;
            }
            $class = 'miralsoft\\synaxon\\api\\Resource\\' . $base;
            foreach (new ReflectionClass($class)->getMethods(ReflectionMethod::IS_PUBLIC) as $m) {
                if ($m->class === $class && preg_match('/@synaxon-endpoint\s+(\S+)\s+(\S+)/', (string) $m->getDocComment(), $match) === 1) {
                    $annotated[] = strtoupper($match[1]) . ' ' . $match[2];
                }
            }
        }
        sort($annotated, SORT_STRING);

        self::assertSame(ApiSurface::OPERATIONS, $annotated);
    }

    public function testEverySurfaceSchemaHasADtoClass(): void
    {
        $missing = array_values(array_filter(
            ApiSurface::SCHEMAS,
            static fn (string $schema): bool => !class_exists('miralsoft\\synaxon\\api\\DTO\\' . $schema),
        ));

        self::assertSame([], $missing);
    }
}
