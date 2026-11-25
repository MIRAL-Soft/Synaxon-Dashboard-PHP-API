<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Unit\DTO;

use miralsoft\synaxon\api\DTO\AbstractDto;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionMethod;
use ReflectionNamedType;

/**
 * Hydrates every DTO with the example values SYNAXON publishes in its own
 * OpenAPI document (docs/openapi.json) and checks that each getter hands the
 * value back with the type the spec declares.
 *
 * The values are read out of the spec, not invented, so this test makes a
 * claim about the real wire format rather than about what the generator
 * happens to assume. Properties without a published example are not covered
 * here; HydrationTest covers the empty-payload case for all of them.
 */
final class SpecExampleHydrationTest extends TestCase
{
    /** @var array<string, array<string, mixed>>|null */
    private static ?array $schemas = null;

    /**
     * @return array<string, array<string, mixed>>
     */
    private static function schemas(): array
    {
        if (self::$schemas === null) {
            $spec = json_decode(
                (string) file_get_contents(dirname(__DIR__, 3) . '/docs/openapi.json'),
                true,
                512,
                JSON_THROW_ON_ERROR,
            );
            /** @var array<string, array<string, mixed>> $schemas */
            $schemas = $spec['components']['schemas'] ?? [];
            self::$schemas = $schemas;
        }

        return self::$schemas;
    }

    /**
     * Payload built only from published examples, nested schemas included.
     *
     * @param list<string> $seen schema names on the current path, to stop cycles
     *
     * @return array<string, mixed>
     */
    private static function examplePayload(string $schemaName, array $seen = []): array
    {
        if (in_array($schemaName, $seen, true)) {
            return [];
        }
        $seen[] = $schemaName;

        $payload = [];
        foreach ((array) (self::schemas()[$schemaName]['properties'] ?? []) as $prop => $propSchema) {
            if (!is_string($prop) || !is_array($propSchema)) {
                continue;
            }
            if (array_key_exists('example', $propSchema)) {
                $payload[$prop] = $propSchema['example'];
                continue;
            }
            if (isset($propSchema['$ref']) && is_string($propSchema['$ref'])) {
                $nested = self::examplePayload(self::refName($propSchema['$ref']), $seen);
                if ($nested !== []) {
                    $payload[$prop] = $nested;
                }
            }
        }

        return $payload;
    }

    private static function refName(string $ref): string
    {
        $parts = explode('/', $ref);

        return (string) end($parts);
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function schemaProvider(): iterable
    {
        foreach (array_keys(self::schemas()) as $name) {
            if (self::examplePayload($name) !== []) {
                yield $name => [$name];
            }
        }
    }

    #[DataProvider('schemaProvider')]
    public function testGettersReturnPublishedExamplesWithDeclaredTypes(string $schemaName): void
    {
        /** @var class-string<AbstractDto> $class */
        $class = 'miralsoft\\synaxon\\api\\DTO\\' . $schemaName;
        $payload = self::examplePayload($schemaName);
        $dto = $class::fromArray($payload);

        self::assertSame($payload, $dto->toArray(), 'hydration must preserve the payload unchanged');

        $getters = [];
        foreach (new ReflectionClass($class)->getMethods(ReflectionMethod::IS_PUBLIC) as $m) {
            $getters[strtolower($m->getName())] = $m;
        }

        $properties = (array) self::schemas()[$schemaName]['properties'];
        foreach ($payload as $prop => $value) {
            $getterKey = 'get' . strtolower((string) preg_replace('/[^A-Za-z0-9]+/', '', $prop));
            self::assertArrayHasKey($getterKey, $getters, "{$schemaName} has no getter for '{$prop}'");
            $getter = $getters[$getterKey];
            $result = $getter->invoke($dto);
            $where = "{$schemaName}::{$getter->getName()}()";

            /** @var array<string, mixed> $propSchema */
            $propSchema = $properties[$prop];
            $returnType = $getter->getReturnType();
            $typeName = $returnType instanceof ReflectionNamedType ? $returnType->getName() : 'mixed';

            if (isset($propSchema['$ref']) && is_string($propSchema['$ref'])) {
                $refClass = 'miralsoft\\synaxon\\api\\DTO\\' . self::refName($propSchema['$ref']);
                self::assertInstanceOf($refClass, $result, $where);
                if (is_array($value)) {
                    self::assertSame($value, $result->toArray(), $where);
                }
                continue;
            }

            $items = $propSchema['items'] ?? null;
            if (is_array($items) && isset($items['$ref']) && is_string($items['$ref']) && is_array($value)) {
                $refClass = 'miralsoft\\synaxon\\api\\DTO\\' . self::refName($items['$ref']);
                self::assertIsArray($result, $where);
                self::assertCount(count(array_filter($value, 'is_array')), $result, $where);
                self::assertContainsOnlyInstancesOf($refClass, $result, $where);
                continue;
            }

            // A scalar example whose JSON type already matches the declared
            // type must come back unchanged. Where the spec's example has a
            // different JSON type than its own declaration, the getter's cast
            // is what the declaration promises, and only the type is checked.
            $matches = match ($typeName) {
                'string' => is_string($value),
                'int' => is_int($value),
                'float' => is_float($value) || is_int($value),
                'bool' => is_bool($value),
                'array' => is_array($value),
                default => true,
            };
            if ($matches) {
                self::assertEquals($value, $result, $where);
                continue;
            }
            self::assertSame(
                $typeName,
                get_debug_type($result),
                "{$where} must return the declared type even for a mismatching example",
            );
        }
    }
}
