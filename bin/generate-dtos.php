<?php

declare(strict_types=1);

/**
 * One-shot code generator: emits a typed PHP DTO class for every schema
 * declared in docs/openapi.json.
 *
 * This script is committed for reproducibility but NEVER runs at runtime —
 * its output (src/DTO/*.php) is the source of truth.
 *
 * Usage:
 *   php bin/generate-dtos.php
 */

$root    = dirname(__DIR__);
$specPath = $root . '/docs/openapi.json';
$outDir   = $root . '/src/DTO';

if (!is_file($specPath)) {
    fwrite(STDERR, "Spec not found: {$specPath}\n");
    exit(1);
}

/** @var array<string, mixed> $spec */
$spec = json_decode((string) file_get_contents($specPath), true, 512, JSON_THROW_ON_ERROR);
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
    $required  = array_flip((array) ($schema['required'] ?? []));
    $props     = (array)  ($schema['properties'] ?? []);
    $docLines  = [];
    $methods   = [];

    if (isset($schema['description']) && is_string($schema['description'])) {
        $docLines[] = wordwrap(trim($schema['description']), 100, "\n * ");
        $docLines[] = '';
    }

    foreach ($props as $propName => $propSchema) {
        if (!is_string($propName) || !is_array($propSchema)) {
            continue;
        }
        $isRequired = isset($required[$propName]);
        [$phpType, $docType] = mapType($propSchema, $isRequired);

        $getter  = 'get' . studly($propName);
        $comment = '';
        if (isset($propSchema['description']) && is_string($propSchema['description'])) {
            $comment = trim($propSchema['description']);
        }

        $docBlock  = "    /**\n";
        if ($comment !== '') {
            $docBlock .= "     * " . str_replace("\n", "\n     * ", $comment) . "\n     *\n";
        }
        $docBlock .= "     * @return {$docType}\n";
        $docBlock .= "     */\n";

        $body = renderAccessorBody($propName, $propSchema, $isRequired, $phpType);

        $methods[] = $docBlock
            . "    public function {$getter}(): {$phpType}\n"
            . "    {\n"
            . $body
            . "    }";
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
                    'string'  => 'string',
                    'integer' => 'int',
                    'number'  => 'float',
                    'boolean' => 'bool',
                    default   => 'mixed',
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
function renderAccessorBody(string $propName, array $schema, bool $required, string $phpType): string
{
    $key = var_export($propName, true);

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
        return "        return (array) (\$this->data[{$key}] ?? []);\n";
    }

    if ($phpType === 'string') {
        return "        return (string) \$this->data[{$key}];\n";
    }
    if ($phpType === '?string') {
        return "        \$v = \$this->data[{$key}] ?? null;\n"
             . "        return \$v === null ? null : (string) \$v;\n";
    }
    if ($phpType === 'int') {
        return "        return (int) \$this->data[{$key}];\n";
    }
    if ($phpType === '?int') {
        return "        \$v = \$this->data[{$key}] ?? null;\n"
             . "        return \$v === null ? null : (int) \$v;\n";
    }
    if ($phpType === 'float') {
        return "        return (float) \$this->data[{$key}];\n";
    }
    if ($phpType === '?float') {
        return "        \$v = \$this->data[{$key}] ?? null;\n"
             . "        return \$v === null ? null : (float) \$v;\n";
    }
    if ($phpType === 'bool') {
        return "        return (bool) \$this->data[{$key}];\n";
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

function studly(string $name): string
{
    $clean = preg_replace('/[^A-Za-z0-9]+/', ' ', $name) ?? $name;
    return str_replace(' ', '', ucwords($clean));
}
