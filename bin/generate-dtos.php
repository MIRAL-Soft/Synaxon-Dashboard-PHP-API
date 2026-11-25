<?php

declare(strict_types=1);

/**
 * One-shot code generator: emits a typed PHP DTO class for every schema
 * declared in docs/openapi.json.
 *
 * This script is committed for reproducibility but NEVER runs at runtime:
 * its output (src/DTO/*.php) is the source of truth.
 *
 * Usage:
 *   php bin/generate-dtos.php
 */

require_once __DIR__ . '/lib/generator-safety.php';

$root = dirname(__DIR__);
$specPath = $root . '/docs/openapi.json';
$outDir = $root . '/src/DTO';

if (!is_file($specPath)) {
    fwrite(STDERR, "Spec not found: {$specPath}\n");
    exit(1);
}

/** @var array<string, mixed> $spec */
$spec = loadSpecForGeneration($specPath);
$schemas = $spec['components']['schemas'] ?? [];

if (!is_dir($outDir)) {
    mkdir($outDir, 0o755, true);
}

$generated = 0;
foreach ($schemas as $name => $schema) {
    if (!is_string($name) || !is_array($schema)) {
        continue;
    }
    if ($name === 'AbstractDto') {
        continue;
    }
    file_put_contents($outDir . '/' . $name . '.php', renderDto($name, $schema));
    $generated++;
}

fwrite(STDOUT, "Generated {$generated} DTO classes in src/DTO/\n");

/**
 * @param array<string, mixed> $schema
 */
function renderDto(string $name, array $schema): string
{
    $required = array_flip((array) ($schema['required'] ?? []));
    $props = (array)  ($schema['properties'] ?? []);
    $docLines = [];
    $methods = [];
    $isRequestDto = str_ends_with($name, 'RequestDto') || str_ends_with($name, 'Request');

    if (isset($schema['description']) && is_string($schema['description'])) {
        $docLines[] = wordwrap(trim($schema['description']), 100, "\n * ");
        $docLines[] = '';
    }

    foreach ($props as $propName => $propSchema) {
        if (!is_string($propName) || !is_array($propSchema)) {
            continue;
        }
        $isRequired = isset($required[$propName]);
        // Required and nullable: the key is always there, its value may be
        // null ("null if no previous data"). The type is nullable, and only
        // a missing key is an error.
        $isNullable = !empty($propSchema['nullable'])
            || (is_array($propSchema['type'] ?? null) && in_array('null', $propSchema['type'], true));
        [$phpType, $docType] = mapType($propSchema, $isRequired && !$isNullable);

        $getter = 'get' . studly($propName);
        $comment = '';
        if (isset($propSchema['description']) && is_string($propSchema['description'])) {
            $comment = trim($propSchema['description']);
        }

        $docBlock = "    /**\n";
        if ($comment !== '') {
            $docBlock .= '     * ' . str_replace("\n", "\n     * ", $comment) . "\n     *\n";
        }
        $docBlock .= "     * @return {$docType}\n";
        $docBlock .= "     */\n";

        $body = renderAccessorBody($propName, $propSchema, $isRequired && !$isNullable, $phpType, $isRequired && $isNullable);

        $methods[] = $docBlock
            . "    public function {$getter}(): {$phpType}\n"
            . "    {\n"
            . $body
            . '    }';

        if ($isRequestDto) {
            $methods[] = renderWithSetter($propName, $propSchema, $isRequired, $comment);
        }
    }

    $classDoc = '';
    if ($docLines !== []) {
        $classDoc = "/**\n * " . implode("\n * ", $docLines) . "\n */\n";
    }

    $out = "<?php\n\n"
        . "declare(strict_types=1);\n\n"
        . "namespace miralsoft\\synaxon\\api\\DTO;\n\n"
        . $classDoc
        . "class {$name} extends AbstractDto\n"
        . "{\n"
        . implode("\n\n", $methods)
        . (count($methods) > 0 ? "\n" : '')
        . "}\n";

    return $out;
}

/**
 * @param array<string, mixed> $schema
 *
 * @return array{0: string, 1: string} [phpType, phpDocType]
 */
function mapType(array $schema, bool $required): array
{
    if (isset($schema['$ref']) && is_string($schema['$ref'])) {
        $ref = refName($schema['$ref']);
        $php = $required ? $ref : ('?' . $ref);
        $doc = $required ? $ref : ($ref . '|null');
        return [$php, $doc];
    }

    if (isset($schema['oneOf']) || isset($schema['anyOf']) || isset($schema['allOf'])) {
        return ['mixed', $required ? 'mixed' : 'mixed|null'];
    }

    $type = $schema['type'] ?? 'mixed';
    if (is_array($type)) {
        $type = $type[0] ?? 'mixed';
    }

    switch ($type) {
        case 'string':
            return [$required ? 'string' : '?string', $required ? 'string' : 'string|null'];
        case 'integer':
            return [$required ? 'int' : '?int', $required ? 'int' : 'int|null'];
        case 'number':
            return [$required ? 'float' : '?float', $required ? 'float' : 'float|null'];
        case 'boolean':
            return [$required ? 'bool' : '?bool', $required ? 'bool' : 'bool|null'];
        case 'array':
            $items = $schema['items'] ?? [];
            if (is_array($items) && isset($items['$ref']) && is_string($items['$ref'])) {
                $ref = refName($items['$ref']);
                return ['array', "list<{$ref}>"];
            }
            if (is_array($items) && isset($items['type']) && is_string($items['type'])) {
                $inner = match ($items['type']) {
                    'string' => 'string',
                    'integer' => 'int',
                    'number' => 'float',
                    'boolean' => 'bool',
                    default => 'mixed',
                };
                return ['array', "list<{$inner}>"];
            }
            return ['array', 'array<int, mixed>'];
        case 'object':
            return ['array', 'array<string, mixed>'];
        default:
            return ['mixed', $required ? 'mixed' : 'mixed|null'];
    }
}

/**
 * @param array<string, mixed> $schema
 */
function renderAccessorBody(string $propName, array $schema, bool $required, string $phpType, bool $requiredNullable = false): string
{
    $key = var_export($propName, true);

    if ($requiredNullable && in_array($phpType, ['?string', '?int', '?float', '?bool'], true)) {
        $cast = substr($phpType, 1);

        return "        \$v = \$this->requiredNullable({$key});\n"
             . "        return \$v === null ? null : ({$cast}) \$v;\n";
    }

    if (isset($schema['$ref']) && is_string($schema['$ref'])) {
        $ref = refName($schema['$ref']);
        $code = "        \$v = \$this->data[{$key}] ?? null;\n";
        $code .= "        if (is_array(\$v)) {\n";
        $code .= "            return {$ref}::fromArray(\$v);\n";
        $code .= "        }\n";
        $code .= "        if (\$v instanceof {$ref}) {\n";
        $code .= "            return \$v;\n";
        $code .= "        }\n";
        if ($required) {
            $code .= "        return {$ref}::fromArray([]);\n";
        } else {
            $code .= "        return null;\n";
        }
        return $code;
    }

    if (($schema['type'] ?? null) === 'array') {
        $items = $schema['items'] ?? [];
        if (is_array($items) && isset($items['$ref']) && is_string($items['$ref'])) {
            $ref = refName($items['$ref']);
            return "        \$out = [];\n"
                 . "        foreach ((array) (\$this->data[{$key}] ?? []) as \$item) {\n"
                 . "            if (is_array(\$item)) {\n"
                 . "                \$out[] = {$ref}::fromArray(\$item);\n"
                 . "            } elseif (\$item instanceof {$ref}) {\n"
                 . "                \$out[] = \$item;\n"
                 . "            }\n"
                 . "        }\n"
                 . "        return \$out;\n";
        }
        // Scalar lists keep the getter's documented element type: the items
        // are cast the same way the scalar getters cast a single value.
        $cast = is_array($items) ? match ($items['type'] ?? null) {
            'string' => 'strval',
            'integer' => 'intval',
            'number' => 'floatval',
            'boolean' => 'boolval',
            default => null,
        } : null;
        if ($cast !== null) {
            return "        return array_values(array_map('{$cast}', (array) (\$this->data[{$key}] ?? [])));\n";
        }

        return "        return array_values((array) (\$this->data[{$key}] ?? []));\n";
    }

    if ($phpType === 'string') {
        return "        return (string) \$this->required({$key});\n";
    }
    if ($phpType === '?string') {
        return "        \$v = \$this->data[{$key}] ?? null;\n"
             . "        return \$v === null ? null : (string) \$v;\n";
    }
    if ($phpType === 'int') {
        return "        return (int) \$this->required({$key});\n";
    }
    if ($phpType === '?int') {
        return "        \$v = \$this->data[{$key}] ?? null;\n"
             . "        return \$v === null ? null : (int) \$v;\n";
    }
    if ($phpType === 'float') {
        return "        return (float) \$this->required({$key});\n";
    }
    if ($phpType === '?float') {
        return "        \$v = \$this->data[{$key}] ?? null;\n"
             . "        return \$v === null ? null : (float) \$v;\n";
    }
    if ($phpType === 'bool') {
        return "        return (bool) \$this->required({$key});\n";
    }
    if ($phpType === '?bool') {
        return "        \$v = \$this->data[{$key}] ?? null;\n"
             . "        return \$v === null ? null : (bool) \$v;\n";
    }
    if ($phpType === 'array') {
        return "        return (array) (\$this->data[{$key}] ?? []);\n";
    }

    return "        return \$this->data[{$key}] ?? null;\n";
}

function refName(string $ref): string
{
    $parts = explode('/', $ref);
    return (string) end($parts);
}

/**
 * Emit a fluent typed setter (`withFooBar(...)`) for a request DTO field.
 *
 * The setter accepts the field's PHP type, returns a clone (immutability),
 * and is null-tolerant for optional fields.
 *
 * @param array<string, mixed> $schema
 */
function renderWithSetter(string $propName, array $schema, bool $isRequired, string $comment): string
{
    [$phpType, $docType] = mapType($schema, $isRequired);

    // For setters we always allow null (caller can clear an optional value)
    // and we relax sub-DTO references to "DtoClass|array" so callers can pass
    // either a typed DTO instance or a raw associative array.
    $setterType = $phpType;
    if (isset($schema['$ref']) && is_string($schema['$ref'])) {
        $ref = refName($schema['$ref']);
        $setterType = $isRequired ? "{$ref}|array" : "{$ref}|array|null";
    } elseif (str_starts_with($phpType, '?') === false && $phpType !== 'mixed') {
        // Setters always allow null so the caller can unset a previously
        // assigned field on a builder chain.
        $setterType = '?' . $phpType;
    }

    $methodName = 'with' . studly($propName);
    $key = var_export($propName, true);

    $docBlock = "    /**\n";
    if ($comment !== '') {
        $docBlock .= '     * Set the "' . $propName . '" field. ' . str_replace("\n", "\n     * ", $comment) . "\n     *\n";
    } else {
        $docBlock .= '     * Set the "' . $propName . "\" field.\n     *\n";
    }
    // The parameter's element types, for arrays and DTO references.
    $paramDoc = null;
    if (isset($schema['$ref']) && is_string($schema['$ref'])) {
        $paramDoc = refName($schema['$ref']) . '|array<string, mixed>' . ($isRequired ? '' : '|null');
    } elseif ($phpType === 'array') {
        $paramDoc = $docType . '|null';
        $itemRef = $schema['items']['$ref'] ?? null;
        if (is_string($itemRef)) {
            $paramDoc = 'list<' . refName($itemRef) . '|array<string, mixed>>|null';
        }
    }
    if ($paramDoc !== null) {
        $docBlock .= "     * @param {$paramDoc} \$value\n";
    }
    $docBlock .= "     * @return static\n";
    $docBlock .= "     */\n";

    // Only a DTO reference, a list of them or an untyped value can hold a DTO
    // instance; scalar setters store the value as given.
    if (isset($schema['$ref']) || $phpType === 'mixed') {
        $body = "        \$value = \$value instanceof AbstractDto ? \$value->toArray() : \$value;\n"
              . "        return \$this->with({$key}, \$value);\n";
    } elseif (is_string($schema['items']['$ref'] ?? null)) {
        $body = "        if (\$value !== null) {\n"
              . "            \$value = array_map(static fn (mixed \$item): mixed => \$item instanceof AbstractDto ? \$item->toArray() : \$item, \$value);\n"
              . "        }\n"
              . "        return \$this->with({$key}, \$value);\n";
    } else {
        $body = "        return \$this->with({$key}, \$value);\n";
    }

    return $docBlock
         . "    public function {$methodName}({$setterType} \$value): static\n"
         . "    {\n"
         . $body
         . '    }';
}

function studly(string $name): string
{
    $clean = preg_replace('/[^A-Za-z0-9]+/', ' ', $name) ?? $name;
    return str_replace(' ', '', ucwords($clean));
}
