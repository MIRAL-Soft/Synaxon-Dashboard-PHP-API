<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Support;

use ReflectionClass;
use ReflectionMethod;
use ReflectionNamedType;
use ReflectionParameter;
use ReflectionType;

/**
 * Renders the public surface of the library, one line per public method:
 * class, method, parameters and return type. tests/Fixtures/public-api.txt
 * holds the approved version, and PublicApiTest compares the two, so a
 * renamed or removed method (an upstream operationId change, a schema field
 * rename) cannot slip into a release unnoticed.
 *
 * Refresh the approved file deliberately with `composer public-api`, after
 * checking that every difference is intended and noted in the CHANGELOG.
 */
final class PublicApi
{
    public const FIXTURE = __DIR__ . '/../Fixtures/public-api.txt';

    public static function render(): string
    {
        $root = dirname(__DIR__, 2) . '/src';
        $lines = [];
        $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($root, \FilesystemIterator::SKIP_DOTS));
        foreach ($iterator as $file) {
            if (!$file instanceof \SplFileInfo || $file->getExtension() !== 'php') {
                continue;
            }
            $relative = substr($file->getPathname(), strlen($root) + 1, -4);
            $class = 'miralsoft\\synaxon\\api\\' . str_replace(['/', '\\'], '\\', $relative);
            if (!class_exists($class) && !interface_exists($class) && !enum_exists($class)) {
                continue;
            }
            $reflection = new ReflectionClass($class);
            foreach ($reflection->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
                if ($method->getDeclaringClass()->getName() !== $class) {
                    continue;
                }
                $lines[] = sprintf(
                    '%s::%s%s(%s)%s',
                    substr($class, strlen('miralsoft\\synaxon\\api\\')),
                    $method->isStatic() ? 'static ' : '',
                    $method->getName(),
                    implode(', ', array_map(static fn (ReflectionParameter $p): string => self::parameter($p, $class), $method->getParameters())),
                    $method->hasReturnType() ? ': ' . self::type($method->getReturnType(), $class) : '',
                );
            }
        }
        sort($lines, SORT_STRING);

        return implode("\n", $lines) . "\n";
    }

    private static function parameter(ReflectionParameter $p, string $class): string
    {
        $out = ($p->hasType() ? self::type($p->getType(), $class) . ' ' : '') . ($p->isVariadic() ? '...' : '') . '$' . $p->getName();
        if ($p->isDefaultValueAvailable()) {
            $out .= ' = ' . var_export($p->getDefaultValue(), true);
        }

        return $out;
    }

    /**
     * The type as written, independent of the PHP version: PHP 8.4 reports
     * `self` as "self", PHP 8.5 as the resolved class name, so `self` is
     * always rendered as the class it means.
     */
    private static function type(?ReflectionType $type, string $class): string
    {
        if ($type instanceof ReflectionNamedType) {
            $name = $type->getName();
            if (strtolower($name) === 'self') {
                $name = $class;
            }
            $short = str_starts_with($name, 'miralsoft\\synaxon\\api\\') ? substr($name, strrpos($name, '\\') + 1) : $name;

            return ($type->allowsNull() && $name !== 'mixed' && $name !== 'null' ? '?' : '') . $short;
        }

        return (string) $type;
    }
}
