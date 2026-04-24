<?php

declare(strict_types=1);

/**
 * One-shot generator that emits an offline unit test for every mutating
 * endpoint (POST / PUT / PATCH / DELETE) in the spec. Each test asserts
 * that the resource method:
 *   - issues the correct HTTP verb
 *   - hits the correct path (with path parameters URL-encoded)
 *   - forwards the body and query exactly as supplied
 *
 * Tests run against MockHttpClient so they never touch the network.
 *
 * Output: tests/Unit/Resource/{Resource}WriteTest.php (overwritten).
 *
 * Usage:
 *   php bin/generate-write-tests.php
 */

require_once __DIR__ . '/../vendor/autoload.php';

$root = dirname(__DIR__);
$specPath = $root . '/docs/openapi.json';
$resDir = $root . '/src/Resource';
$outDir = $root . '/tests/Unit/Resource';

@mkdir($outDir, 0o755, true);

/** @var array<string, mixed> $spec */
$spec = json_decode((string) file_get_contents($specPath), true, 512, JSON_THROW_ON_ERROR);

// Build endpoint -> PHP method map by reflecting Resource classes.
$endpointToMethod = [];
foreach (glob($resDir . '/*.php') ?: [] as $file) {
    $base = basename($file, '.php');
    if ($base === 'AbstractResource') {
        continue;
    }
    $class = 'miralsoft\\synaxon\\api\\Resource\\' . $base;
    if (!class_exists($class)) {
        continue;
    }
    $ref = new ReflectionClass($class);
    foreach ($ref->getMethods(ReflectionMethod::IS_PUBLIC) as $m) {
        if ($m->class !== $class) {
            continue;
        }
        $doc = $m->getDocComment();
        if ($doc === false) {
            continue;
        }
        if (preg_match('/@synaxon-endpoint\s+(\S+)\s+(\S+)/', $doc, $match) !== 1) {
            continue;
        }
        $params = array_map(
            static fn (ReflectionParameter $p): array => [
                'name' => $p->getName(),
                'hasDefault' => $p->isDefaultValueAvailable(),
            ],
            $m->getParameters()
        );
        $endpointToMethod[strtoupper($match[1]) . ' ' . $match[2]] = [
            'class' => $base,
            'method' => $m->getName(),
            'params' => $params,
        ];
    }
}

// Group mutating operations by resource (path-prefix after /v1/).
/** @var array<string, list<array{path:string,method:string,opId:string,summary:string}>> $groups */
$groups = [];
foreach ((array) ($spec['paths'] ?? []) as $path => $obj) {
    if (!is_string($path) || !is_array($obj)) {
        continue;
    }
    foreach (['post', 'put', 'patch', 'delete'] as $verb) {
        if (!isset($obj[$verb]) || !is_array($obj[$verb])) {
            continue;
        }
        $parts = array_values(array_filter(explode('/', $path), static fn ($s) => $s !== ''));
        if (count($parts) < 2 || $parts[0] !== 'v1') {
            continue;
        }
        $groups[$parts[1]][] = [
            'path' => $path,
            'method' => strtoupper($verb),
            'opId' => (string) ($obj[$verb]['operationId'] ?? ''),
            'summary' => (string) ($obj[$verb]['summary'] ?? ''),
        ];
    }
}

ksort($groups);

$totalTests = 0;
$totalResources = 0;

foreach ($groups as $group => $ops) {
    $className = studly($group) . 'WriteTest';
    $resourceMethod = camel($group);
    $resourceClass = studly($group) . 'Resource';

    $testMethods = [];
    foreach ($ops as $op) {
        $endpointKey = $op['method'] . ' ' . $op['path'];
        $methodInfo = $endpointToMethod[$endpointKey] ?? null;
        if ($methodInfo === null) {
            continue;
        }
        $testMethods[] = renderTest($op, $methodInfo, $resourceMethod);
        $totalTests++;
    }

    if ($testMethods === []) {
        continue;
    }

    $imports = [
        "use miralsoft\\synaxon\\api\\Resource\\{$resourceClass};",
        'use miralsoft\\synaxon\\api\\Tests\\Support\\MockHttpClient;',
        'use PHPUnit\\Framework\\TestCase;',
    ];
    sort($imports);

    $file = "<?php\n\n"
          . "declare(strict_types=1);\n\n"
          . "namespace miralsoft\\synaxon\\api\\Tests\\Unit\\Resource;\n\n"
          . implode("\n", $imports) . "\n\n"
          . "/**\n"
          . " * Offline unit tests for every mutating /v1/{$group}/* endpoint.\n"
          . " *\n"
          . " * Each test issues the call against a MockHttpClient and asserts\n"
          . " * that the verb, path, body and query match the spec verbatim.\n"
          . " * Generated from the OpenAPI specification.\n"
          . " */\n"
          . "final class {$className} extends TestCase\n"
          . "{\n"
          . implode("\n\n", $testMethods) . "\n"
          . "}\n";

    file_put_contents($outDir . '/' . $className . '.php', $file);
    $totalResources++;
}

fwrite(STDOUT, sprintf(
    "Generated %d write tests across %d resource classes in tests/Unit/Resource/\n",
    $totalTests,
    $totalResources
));

/* ----------------------------------------------------------- helpers */

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
 * @param array{path:string,method:string,opId:string,summary:string} $op
 * @param array{class:string,method:string,params:list<array{name:string,hasDefault:bool}>} $methodInfo
 */
function renderTest(array $op, array $methodInfo, string $resourceMethod): string
{
    $verb = $op['method'];
    $path = $op['path'];
    $opId = $op['opId'];

    // Sample values for path parameters.
    preg_match_all('/\{([A-Za-z_][A-Za-z0-9_]*)\}/', $path, $matches);
    $pathParams = $matches[1] ?? [];

    $sampleIds = [];
    $expandedPath = $path;
    foreach ($pathParams as $i => $name) {
        $value = 'sample-' . $name . '-' . ($i + 1);
        $sampleIds[$name] = $value;
        $expandedPath = str_replace('{' . $name . '}', rawurlencode($value), $expandedPath);
    }

    // Build call arguments for the resource method.
    $args = [];
    $hasBody = false;
    $hasQuery = false;
    foreach ($methodInfo['params'] as $p) {
        $name = $p['name'];
        if (in_array($name, $pathParams, true)) {
            $args[] = var_export($sampleIds[$name], true);
        } elseif ($name === 'body') {
            $hasBody = true;
            $args[] = "['field' => 'value']";
        } elseif ($name === 'query') {
            $hasQuery = true;
            $args[] = "['filter' => 'a']";
        } elseif ($p['hasDefault']) {
            // skip — default applies
            continue;
        } else {
            $args[] = 'null';
        }
    }
    $callArgs = implode(', ', $args);

    $testName = 'test' . studly($opId !== '' ? $opId : ($verb . $path));
    $testName = preg_replace('/[^A-Za-z0-9]+/', '', $testName) ?? $testName;
    if (strlen($testName) > 80) {
        $testName = substr($testName, 0, 80);
    }

    $assertions = [];
    $assertions[] = "        self::assertSame('{$verb}', \$req['method']);";
    $assertions[] = '        self::assertSame(' . var_export($expandedPath, true) . ", \$req['path']);";
    if ($hasBody) {
        $assertions[] = "        self::assertSame(['field' => 'value'], \$req['options']['body'] ?? null);";
    }
    if ($hasQuery) {
        $assertions[] = "        self::assertSame(['filter' => 'a'], \$req['options']['query'] ?? null);";
    }

    $resourceClass = studly(explode('/', ltrim($path, '/'))[1] ?? '') . 'Resource';

    $summary = $op['summary'] !== '' ? $op['summary'] : $opId;

    $body = "    /**\n"
          . "     * {$summary}\n"
          . "     *\n"
          . "     * @synaxon-endpoint {$verb} {$path}\n"
          . "     */\n"
          . "    public function {$testName}(): void\n"
          . "    {\n"
          . "        \$http = (new MockHttpClient())->queue([]);\n"
          . "        \$resource = new {$resourceClass}(\$http);\n"
          . "\n"
          . "        \$resource->{$methodInfo['method']}({$callArgs});\n"
          . "\n"
          . "        \$req = \$http->lastRequest();\n"
          . "        self::assertNotNull(\$req);\n"
          . implode("\n", $assertions) . "\n"
          . '    }';

    return $body;
}
