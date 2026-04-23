<?php

declare(strict_types=1);

/**
 * One-shot code generator: emits resource classes + a client facade
 * based on operation groupings in docs/openapi.json.
 *
 * Grouping rule: first path segment after /v1/ becomes the resource name.
 * Method naming rule: REST-conventional verbs where the shape matches
 * (list/find/create/update/delete), otherwise the human-readable suffix
 * from the operationId.
 *
 * This script is committed for reproducibility but is NEVER run at runtime —
 * its output (src/Resource/*.php + src/Client/SynaxonClient.php) is the
 * source of truth.
 *
 * Usage:
 *   php bin/generate-resources.php
 */

$root      = dirname(__DIR__);
$specPath  = $root . '/docs/openapi.json';
$resDir    = $root . '/src/Resource';
$clientDir = $root . '/src/Client';

/** @var array<string, mixed> $spec */
$spec = json_decode((string) file_get_contents($specPath), true, 512, JSON_THROW_ON_ERROR);
$paths = (array) ($spec['paths'] ?? []);

@mkdir($resDir, 0o755, true);
@mkdir($clientDir, 0o755, true);

/**
 * Walk all operations and bucket them by the first path segment after /v1/.
 *
 * @var array<string, list<array<string, mixed>>> $groups
 */
$groups = [];
$emptyPaths = [];

foreach ($paths as $path => $pathObj) {
    if (!is_string($path) || !is_array($pathObj)) {
        continue;
    }
    $methods = ['get', 'post', 'put', 'patch', 'delete', 'head', 'options'];
    $hasOp = false;
    foreach ($methods as $m) {
        if (!isset($pathObj[$m]) || !is_array($pathObj[$m])) {
            continue;
        }
        $hasOp = true;
        $op = $pathObj[$m];
        $group = resourceGroup($path);
        $groups[$group][] = [
            'path'        => $path,
            'method'      => strtoupper($m),
            'operationId' => (string) ($op['operationId'] ?? ''),
            'summary'     => (string) ($op['summary'] ?? ''),
            'description' => (string) ($op['description'] ?? ''),
            'parameters'  => (array)  ($op['parameters'] ?? []),
            'requestBody' => $op['requestBody'] ?? null,
            'responses'   => (array)  ($op['responses'] ?? []),
        ];
    }
    if (!$hasOp) {
        $emptyPaths[] = $path;
    }
}

ksort($groups);

// Method-name disambiguation: collect used names per class
foreach ($groups as $group => $ops) {
    $className = studly($group) . 'Resource';
    $fileBody  = renderResource($className, $group, $ops);
    file_put_contents($resDir . '/' . $className . '.php', $fileBody);
}

file_put_contents($clientDir . '/SynaxonClient.php', renderClient(array_keys($groups)));

// Emit a JSON index for the compatibility tool.
file_put_contents(
    $root . '/config/generated-endpoints.json',
    json_encode([
        'groups'      => array_map(static fn (array $g): int => count($g), $groups),
        'total'       => array_sum(array_map('count', $groups)),
        'empty_paths' => $emptyPaths,
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
);

fwrite(STDOUT, sprintf(
    "Generated %d resource classes, %d operations, %d empty/placeholder paths skipped.\n",
    count($groups),
    array_sum(array_map('count', $groups)),
    count($emptyPaths)
));

/* -------------------------------------------------------------- helpers */

function resourceGroup(string $path): string
{
    $parts = array_values(array_filter(explode('/', $path), static fn ($s) => $s !== ''));
    // Expect v1/<group>/...
    return $parts[1] ?? 'root';
}

function studly(string $name): string
{
    $clean = preg_replace('/[^A-Za-z0-9]+/', ' ', $name) ?? $name;
    return str_replace(' ', '', ucwords($clean));
}

function camel(string $name): string
{
    $s = studly($name);
    return $s === '' ? $s : lcfirst($s);
}

/**
 * @param list<array<string, mixed>> $ops
 */
function renderResource(string $className, string $group, array $ops): string
{
    $groupPretty = studly($group);
    $methods = [];
    $usedNames = [];

    foreach ($ops as $op) {
        $methodInfo = methodNameFor($op, $group);
        $base = $methodInfo['name'];
        $name = $base;
        $i = 2;
        while (isset($usedNames[$name])) {
            $name = $base . $i;
            $i++;
        }
        $usedNames[$name] = true;

        $methods[] = renderMethod($name, $op, $methodInfo['semantic']);
    }

    $header = "<?php\n\n"
        . "declare(strict_types=1);\n\n"
        . "namespace miralsoft\\synaxon\\api\\Resource;\n\n"
        . "/**\n"
        . " * {$groupPretty} resource — wraps all /v1/{$group}/* endpoints.\n"
        . " *\n"
        . " * This class is generated from the OpenAPI specification. Method names follow\n"
        . " * REST conventions where the endpoint shape permits; otherwise the suffix of\n"
        . " * the upstream operationId is used to preserve semantic meaning.\n"
        . " */\n"
        . "class {$className} extends AbstractResource\n"
        . "{\n";

    return $header . implode("\n\n", $methods) . "\n}\n";
}

/**
 * Decide the PHP method name for a given operation.
 *
 * @param array<string, mixed> $op
 * @return array{name: string, semantic: string}
 */
function methodNameFor(array $op, string $group): array
{
    $path   = (string) $op['path'];
    $method = (string) $op['method'];
    $opId   = (string) $op['operationId'];

    $after = trim(substr($path, strlen('/v1/' . $group)), '/');
    $hasIdParam = (bool) preg_match('/\{[^}]+\}/', $after);

    // Simple REST shapes
    if ($after === '' && $method === 'GET')      return ['name' => 'list',   'semantic' => 'rest'];
    if ($after === '' && $method === 'POST')     return ['name' => 'create', 'semantic' => 'rest'];
    if (preg_match('/^\{[^}]+\}$/', $after)) {
        return match ($method) {
            'GET'    => ['name' => 'find',   'semantic' => 'rest'],
            'PATCH'  => ['name' => 'update', 'semantic' => 'rest'],
            'PUT'    => ['name' => 'replace','semantic' => 'rest'],
            'DELETE' => ['name' => 'delete', 'semantic' => 'rest'],
            default  => ['name' => camel(lastSegment($opId)), 'semantic' => 'custom'],
        };
    }

    // Special-case: derive from operationId suffix (after last underscore)
    $suffix = $opId;
    if (str_contains($suffix, '_')) {
        $suffix = substr($suffix, (int) strrpos($suffix, '_') + 1);
    }
    if ($suffix === '') {
        // Fall back to method + path tail
        $suffix = strtolower($method) . ' ' . str_replace(['/', '-', '{', '}'], ' ', $after);
    }

    return ['name' => camel($suffix), 'semantic' => 'custom'];
}

function lastSegment(string $opId): string
{
    if (!str_contains($opId, '_')) {
        return $opId;
    }
    return substr($opId, (int) strrpos($opId, '_') + 1);
}

/**
 * @param array<string, mixed> $op
 */
function renderMethod(string $name, array $op, string $semantic): string
{
    $path   = (string) $op['path'];
    $method = (string) $op['method'];
    $opId   = (string) $op['operationId'];
    $summary = (string) ($op['summary'] ?? '');
    $description = (string) ($op['description'] ?? '');

    $pathParams  = [];
    $queryParams = [];
    foreach ((array) $op['parameters'] as $p) {
        if (!is_array($p)) continue;
        if (($p['in'] ?? '') === 'path')  $pathParams[]  = $p;
        if (($p['in'] ?? '') === 'query') $queryParams[] = $p;
    }

    $args = [];
    $phpdocParams = [];

    foreach ($pathParams as $p) {
        $pname = (string) ($p['name'] ?? 'id');
        $args[] = ['type' => 'string', 'name' => $pname, 'default' => null, 'source' => 'path'];
        $phpdocParams[] = "@param string \${$pname} Path parameter from the upstream spec.";
    }

    $hasBody = isset($op['requestBody']) && is_array($op['requestBody']);
    if ($hasBody) {
        $args[] = ['type' => '?array', 'name' => 'body', 'default' => 'null', 'source' => 'body'];
        $phpdocParams[] = "@param array<string, mixed>|null \$body Request body.";
    }

    if ($queryParams !== []) {
        $args[] = ['type' => 'array', 'name' => 'query', 'default' => '[]', 'source' => 'query'];
        $phpdocParams[] = "@param array<string, scalar|array<int, scalar>> \$query Query parameters.";
    }

    $argStrings = [];
    foreach ($args as $a) {
        $s = $a['type'] . ' $' . $a['name'];
        if ($a['default'] !== null) {
            $s .= ' = ' . $a['default'];
        }
        $argStrings[] = $s;
    }

    $pathParamCall = [];
    foreach ($pathParams as $p) {
        $pname = (string) $p['name'];
        $pathParamCall[] = "'{$pname}' => \${$pname}";
    }

    $callPath = '$this->expand('
        . var_export($path, true)
        . ($pathParamCall !== [] ? (', [' . implode(', ', $pathParamCall) . ']') : '')
        . ')';

    $httpMethod = strtolower($method);

    $callArgs = [$callPath];
    if ($hasBody) {
        $callArgs[] = '$body';
    } else {
        if (in_array($httpMethod, ['post', 'put', 'patch'], true)) {
            $callArgs[] = 'null';
        }
    }
    if ($queryParams !== []) {
        $callArgs[] = '$query';
    } elseif ($hasBody || in_array($httpMethod, ['get', 'delete'], true)) {
        // no query
    }

    $invocation = '$this->http' . ucfirst($httpMethod) . '(' . implode(', ', $callArgs) . ')';

    $doc = "    /**\n";
    $titleParts = [];
    if ($summary !== '')     $titleParts[] = $summary;
    if ($description !== '' && $description !== $summary) $titleParts[] = $description;
    $title = trim(implode(' — ', $titleParts));
    if ($title === '') $title = $opId;
    $title = wordwrap($title, 100, "\n     * ");
    $doc .= "     * " . $title . "\n";
    $doc .= "     *\n";
    $doc .= "     * @synaxon-endpoint {$method} {$path}\n";
    $doc .= "     * @synaxon-operation-id {$opId}\n";
    foreach ($phpdocParams as $pd) {
        $doc .= "     * {$pd}\n";
    }
    $doc .= "     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.\n";
    $doc .= "     */\n";

    return $doc
        . "    public function {$name}(" . implode(', ', $argStrings) . "): array|null\n"
        . "    {\n"
        . "        return {$invocation};\n"
        . "    }";
}

/**
 * @param list<string> $groupKeys
 */
function renderClient(array $groupKeys): string
{
    sort($groupKeys);

    $factories = [];
    $properties = [];
    $imports = ["use miralsoft\\synaxon\\api\\Http\\GuzzleHttpClient;",
                "use miralsoft\\synaxon\\api\\Http\\HttpClientInterface;",
                "use miralsoft\\synaxon\\api\\Config\\SynaxonConfig;",
                "use Psr\\Log\\LoggerInterface;"];
    foreach ($groupKeys as $g) {
        $imports[] = 'use miralsoft\\synaxon\\api\\Resource\\' . studly($g) . 'Resource;';
    }
    sort($imports);

    foreach ($groupKeys as $g) {
        $class  = studly($g) . 'Resource';
        $method = camel($g);
        $prop   = $method;
        $properties[] = "    private ?{$class} \${$prop} = null;";
        $factories[] = <<<PHP
    public function {$method}(): {$class}
    {
        return \$this->{$prop} ??= new {$class}(\$this->http);
    }
PHP;
    }

    $header = "<?php\n\n"
        . "declare(strict_types=1);\n\n"
        . "namespace miralsoft\\synaxon\\api\\Client;\n\n"
        . implode("\n", $imports) . "\n\n"
        . "/**\n"
        . " * SYNAXON Marketplace API client facade.\n"
        . " *\n"
        . " * Provides fluent factory methods for every top-level resource group.\n"
        . " * Authentication, retry and logging behaviour are controlled by the\n"
        . " * SynaxonConfig passed to the constructor.\n"
        . " */\n"
        . "final class SynaxonClient\n"
        . "{\n"
        . "    private readonly HttpClientInterface \$http;\n\n"
        . implode("\n", $properties) . "\n\n"
        . "    public function __construct(\n"
        . "        SynaxonConfig \$config,\n"
        . "        ?HttpClientInterface \$http = null,\n"
        . "        ?LoggerInterface \$logger = null,\n"
        . "    ) {\n"
        . "        \$this->http = \$http ?? new GuzzleHttpClient(\$config, null, \$logger);\n"
        . "    }\n\n"
        . implode("\n\n", $factories) . "\n"
        . "}\n";

    return $header;
}
