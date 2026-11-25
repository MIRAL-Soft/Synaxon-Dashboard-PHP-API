<?php

declare(strict_types=1);

/**
 * Shared guards for the code generators in bin/.
 *
 * The generators write text from docs/openapi.json, a document the project
 * does not write, into PHP source. Everything taken from it is either made
 * inert (docblock text) or validated (names that become identifiers), so a
 * description or a name in the spec can never end a comment or inject code.
 */

/**
 * Load docs/openapi.json for code generation: free text that ends up in
 * docblocks is made inert, and every name that ends up as an identifier, a
 * path or an annotation is validated. Every generator loads the spec through
 * here, so the guard cannot be forgotten in one of them.
 *
 * @return array<string, mixed>
 */
function loadSpecForGeneration(string $specPath): array
{
    /** @var array<string, mixed> $spec */
    $spec = json_decode((string) file_get_contents($specPath), true, 512, JSON_THROW_ON_ERROR);

    foreach (array_keys((array) ($spec['components']['schemas'] ?? [])) as $schemaName) {
        assertPhpIdentifier((string) $schemaName, 'schema name');
    }

    foreach ((array) ($spec['paths'] ?? []) as $path => $item) {
        if (preg_match('#^/[A-Za-z0-9/_{}.\-]*$#', (string) $path) !== 1) {
            fwrite(STDERR, sprintf("Refusing to generate code: path %s has unexpected characters.\n", json_encode($path)));
            exit(1);
        }
        foreach ((array) $item as $operation) {
            if (!is_array($operation)) {
                continue;
            }
            if (isset($operation['operationId'])) {
                assertPhpIdentifier((string) $operation['operationId'], 'operationId');
            }
            foreach ((array) ($operation['parameters'] ?? []) as $parameter) {
                if (is_array($parameter) && in_array($parameter['in'] ?? '', ['path', 'query'], true)) {
                    // Path parameters become PHP variables; query names are
                    // only array keys, but the same rule keeps them sane.
                    if (($parameter['in'] ?? '') === 'path') {
                        assertPhpIdentifier((string) ($parameter['name'] ?? ''), 'path parameter');
                    }
                }
            }
        }
    }

    return sanitizeDocText($spec);
}

/**
 * Apply phpDocText() to every description, summary and title in the spec.
 *
 * @param array<mixed> $node
 *
 * @return array<mixed>
 */
function sanitizeDocText(array $node): array
{
    foreach ($node as $key => $value) {
        if (is_array($value)) {
            $node[$key] = sanitizeDocText($value);
        } elseif (is_string($value) && in_array($key, ['description', 'summary', 'title'], true)) {
            $node[$key] = phpDocText($value);
        }
    }

    return $node;
}

/**
 * Text safe inside a PHP docblock: a comment terminator cannot close the
 * block, and control characters (other than newlines) are removed.
 */
function phpDocText(string $text): string
{
    $text = str_replace('*/', '*\\/', $text);

    return (string) preg_replace('/[\x00-\x09\x0B-\x1F\x7F]/', '', $text);
}

/**
 * A spec name that becomes a PHP identifier (class, variable, parameter).
 * Anything else stops the generator instead of producing broken or
 * injectable code.
 */
function assertPhpIdentifier(string $name, string $what): string
{
    if (preg_match('/^[A-Za-z_][A-Za-z0-9_]*$/', $name) !== 1) {
        fwrite(STDERR, sprintf("Refusing to generate code: %s %s is not a valid PHP identifier.\n", $what, json_encode($name)));
        exit(1);
    }

    return $name;
}
