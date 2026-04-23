<?php

declare(strict_types=1);

/**
 * One-shot code generator: emits read-only integration tests for every
 * GET endpoint in the spec, one test class per resource.
 *
 * Strategy:
 *  - Each GET without path parameters becomes a direct test that asserts
 *    a non-error response.
 *  - Each GET with path parameters obtains its ID from the matching list
 *    endpoint via sampleId() (from EndpointSamplingTrait).
 *  - Endpoints that are known not to work as simple API calls are
 *    skipped with an explanatory message (see $knownSkips).
 *
 * Output: tests/Integration/ReadOnly/{Resource}ReadTest.php (overwritten).
 *
 * Usage:
 *   php bin/generate-integration-read-tests.php
 */

require_once __DIR__ . '/../vendor/autoload.php';

$root    = dirname(__DIR__);
$specPath = $root . '/docs/openapi.json';
$outDir   = $root . '/tests/Integration/ReadOnly';
$resDir   = $root . '/src/Resource';

if (!is_file($specPath)) {
    fwrite(STDERR, "Spec not found: {$specPath}\n");
    exit(1);
}

@mkdir($outDir, 0o755, true);

/**
 * Endpoints that require special handling or are known-broken.
 * Key: "METHOD /path", value: human-readable skip reason.
 */
$knownSkips = [
    'GET /v1/auth/egis'          => 'OAuth authorization flow — browser redirect, not an API call.',
    'GET /v1/auth/egis/callback' => 'OAuth authorization callback — browser redirect, not an API call.',
];

/**
 * Endpoints that legitimately return 404 when the tenant has not configured
 * the underlying feature. These are treated as "skipped when not available"
 * rather than test failures — the assertion wraps the call in a 404-aware
 * try/catch.
 */
$optionalEndpoints = [
    'GET /v1/customers/{id}/report'         => 'Requires a customer-report setting; skipped when none exists.',
    'GET /v1/customers/{id}/report/pdf'     => 'Requires a customer-report setting; skipped when none exists.',
    'GET /v1/customers/{customerId}/report' => 'Requires a customer-report setting; skipped when none exists.',
];

/**
 * Endpoints known to be broken upstream (HTTP 500 etc.). We still call
 * them so we notice the day they are fixed, but the test is marked
 * incomplete rather than failed.
 */
$knownBrokenUpstream = [
    'GET /v1/users/terms/pending'        => 'Upstream returns HTTP 500 as of SYNAXON Marketplace API v1.9.2.',
    'GET /v1/customers/suggestion'       => 'Upstream returns HTTP 500 as of SYNAXON Marketplace API v1.9.2.',
    'GET /v1/lywand/targets/{id}'        => 'Upstream returns HTTP 500 as of SYNAXON Marketplace API v1.9.2.',
];

/**
 * Endpoints whose response is not JSON (CSV, PDF …). They require query
 * parameters and target-specific IDs that are not represented in the spec,
 * so we skip them from the automated smoke suite with a clear note.
 */
$nonJsonEndpoints = [
    'GET /v1/sales-opportunities/csv'    => 'Returns CSV; requires targeted test fixture rather than a smoke call.',
    'GET /v1/sales-opportunities/pdf'    => 'Returns PDF; requires targeted test fixture rather than a smoke call.',
    'GET /v1/reports/pdf'                => 'Returns PDF; requires targeted test fixture rather than a smoke call.',
    'GET /v1/customers/{id}/report/pdf'  => 'Returns PDF; requires targeted test fixture rather than a smoke call.',
    'GET /v1/n-sight/sites/{id}/installer'   => 'Returns installer binary + requires OS query parameter.',
    'GET /v1/sec-auditor/customers/{id}/installer' => 'Returns installer binary + requires OS query parameter.',
];

/** @var array<string, mixed> $spec */
$spec = json_decode((string) file_get_contents($specPath), true, 512, JSON_THROW_ON_ERROR);

// Build an index: "METHOD /path" => [className, methodName, phpSignature]
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
                'name'        => $p->getName(),
                'hasDefault'  => $p->isDefaultValueAvailable(),
                'type'        => $p->getType() instanceof ReflectionNamedType ? $p->getType()->getName() : 'mixed',
            ],
            $m->getParameters()
        );
        $endpointToMethod[strtoupper($match[1]) . ' ' . $match[2]] = [
            'class'   => $base,
            'method'  => $m->getName(),
            'params'  => $params,
        ];
    }
}

// Group GET endpoints by resource group (first segment after /v1/).
/** @var array<string, list<array{path:string,opId:string,summary:string}>> $groups */
$groups = [];
foreach ((array) ($spec['paths'] ?? []) as $path => $obj) {
    if (!is_string($path) || !is_array($obj) || !isset($obj['get']) || !is_array($obj['get'])) {
        continue;
    }
    $parts = array_values(array_filter(explode('/', $path), static fn (string $s): bool => $s !== ''));
    if (count($parts) < 2 || $parts[0] !== 'v1') {
        continue;
    }
    $groups[$parts[1]][] = [
        'path'    => $path,
        'opId'    => (string) ($obj['get']['operationId'] ?? ''),
        'summary' => (string) ($obj['get']['summary'] ?? ''),
    ];
}

ksort($groups);

$totalTests = 0;
$totalResources = 0;

foreach ($groups as $group => $ops) {
    $className = studly($group) . 'ReadTest';
    $resourceMethod = camel($group);
    $resourceClass  = studly($group) . 'Resource';

    // Build a map of parameterless GET endpoints in this group by their
    // path, so path-parameter endpoints can pull a sample ID from the
    // matching sibling list endpoint (parent path + no {id}).
    /** @var array<string, array{path:string,method:string}> $listByParent */
    $listByParent = [];
    foreach ($ops as $op) {
        if (str_contains($op['path'], '{')) {
            continue;
        }
        $key = 'GET ' . $op['path'];
        if (isset($endpointToMethod[$key])) {
            $listByParent[$op['path']] = $op + ['method' => $endpointToMethod[$key]['method']];
        }
    }

    $testMethods = [];
    foreach ($ops as $op) {
        $endpointKey = 'GET ' . $op['path'];
        $methodInfo  = $endpointToMethod[$endpointKey] ?? null;
        $listEndpoint = resolveListEndpointFor($op['path'], $listByParent);
        $testMethods[] = renderTest(
            $group,
            $op,
            $methodInfo,
            $resourceMethod,
            $listEndpoint,
            $knownSkips,
            $optionalEndpoints,
            $knownBrokenUpstream,
            $nonJsonEndpoints,
        );
        $totalTests++;
    }

    $imports = [
        "use miralsoft\\synaxon\\api\\Tests\\Integration\\IntegrationTestCase;",
    ];

    $hasPathParam = false;
    foreach ($ops as $op) {
        if (str_contains($op['path'], '{')) {
            $hasPathParam = true;
            break;
        }
    }
    $traitLine = '';
    if ($hasPathParam) {
        $traitLine = "    use EndpointSamplingTrait;\n\n";
    }

    $file = "<?php\n\n"
        . "declare(strict_types=1);\n\n"
        . "namespace miralsoft\\synaxon\\api\\Tests\\Integration\\ReadOnly;\n\n"
        . implode("\n", $imports) . "\n\n"
        . "/**\n"
        . " * Read-only smoke tests for all GET /v1/{$group}/* endpoints.\n"
        . " *\n"
        . " * Generated from the OpenAPI spec. Every test invokes the upstream\n"
        . " * endpoint and asserts that the response is not an error. Endpoints\n"
        . " * that require a sample ID draw it from the list endpoint for the\n"
        . " * same resource.\n"
        . " */\n"
        . "final class {$className} extends IntegrationTestCase\n"
        . "{\n"
        . $traitLine
        . implode("\n\n", $testMethods) . "\n"
        . "}\n";

    file_put_contents($outDir . '/' . $className . '.php', $file);
    $totalResources++;
}

fwrite(STDOUT, sprintf(
    "Generated %d read tests across %d resource classes in tests/Integration/ReadOnly/\n",
    $totalTests,
    $totalResources
));

/* -------------------------------------------------------------- helpers */

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
 * For a path with parameters (e.g. "/v1/eset/customers/{id}/metrics"),
 * find the closest parameterless list endpoint that would yield a usable
 * sample ID. We strip the path from the first "{...}" onwards and look
 * for an exact match among the known parameterless endpoints.
 *
 * @param array<string, array{path:string,method:string}> $listByParent
 * @return array{path:string,method:string}|null
 */
function resolveListEndpointFor(string $path, array $listByParent): ?array
{
    if (!str_contains($path, '{')) {
        return null;
    }
    // Strip from the first "{" back to the previous "/" — that yields the
    // parent collection path. E.g. /v1/eset/customers/{id}/metrics → /v1/eset/customers
    $firstBrace = strpos($path, '{');
    if ($firstBrace === false) {
        return null;
    }
    $parent = rtrim(substr($path, 0, $firstBrace), '/');

    if (isset($listByParent[$parent])) {
        return $listByParent[$parent];
    }

    // Fall back to any ancestor (e.g. if the direct parent isn't listable,
    // try /v1/eset/customers/{id}/foo → /v1/eset/customers → /v1/eset).
    $segments = explode('/', $parent);
    while (count($segments) > 2) {
        array_pop($segments);
        $candidate = implode('/', $segments);
        if ($candidate !== '' && isset($listByParent[$candidate])) {
            return $listByParent[$candidate];
        }
    }
    return null;
}

/**
 * @param array{path:string,opId:string,summary:string}         $op
 * @param array{class:string,method:string,params:list<array{name:string,hasDefault:bool,type:string}>}|null $methodInfo
 * @param array{path:string,method:string}|null                 $listEndpoint
 * @param array<string, string>                                 $knownSkips
 * @param array<string, string>                                 $optionalEndpoints
 * @param array<string, string>                                 $knownBrokenUpstream
 * @param array<string, string>                                 $nonJsonEndpoints
 */
function renderTest(
    string $group,
    array $op,
    ?array $methodInfo,
    string $resourceMethod,
    ?array $listEndpoint,
    array $knownSkips,
    array $optionalEndpoints,
    array $knownBrokenUpstream,
    array $nonJsonEndpoints,
): string {
    $endpointKey = 'GET ' . $op['path'];
    $testName    = 'test' . studly($op['opId'] !== '' ? $op['opId'] : ($op['path'] . 'Get'));
    // Ensure unique, PSR-friendly test names — sanitize and shorten.
    $testName = preg_replace('/[^A-Za-z0-9]+/', '', $testName) ?? $testName;
    if (strlen($testName) > 80) {
        $testName = substr($testName, 0, 80);
    }

    $docSummary = $op['summary'] !== '' ? trim($op['summary']) : $op['opId'];
    $doc = "    /**\n"
         . "     * {$docSummary}\n"
         . "     *\n"
         . "     * @synaxon-endpoint {$endpointKey}\n"
         . "     */\n";

    if (isset($knownSkips[$endpointKey])) {
        return $doc
             . "    public function {$testName}(): void\n"
             . "    {\n"
             . "        \$this->assertReadOnly('GET');\n"
             . "        self::markTestSkipped(" . var_export($knownSkips[$endpointKey], true) . ");\n"
             . "    }";
    }

    if (isset($nonJsonEndpoints[$endpointKey])) {
        return $doc
             . "    public function {$testName}(): void\n"
             . "    {\n"
             . "        \$this->assertReadOnly('GET');\n"
             . "        self::markTestSkipped(" . var_export($nonJsonEndpoints[$endpointKey], true) . ");\n"
             . "    }";
    }

    if ($methodInfo === null) {
        return $doc
             . "    public function {$testName}(): void\n"
             . "    {\n"
             . "        \$this->assertReadOnly('GET');\n"
             . "        self::markTestSkipped('No PHP method is mapped to this endpoint (generator drift).');\n"
             . "    }";
    }

    $brokenReason = $knownBrokenUpstream[$endpointKey] ?? null;
    $optionalReason = $optionalEndpoints[$endpointKey] ?? null;

    $callMethod = $methodInfo['method'];

    // Detect path parameters.
    preg_match_all('/\{([A-Za-z_][A-Za-z0-9_]*)\}/', $op['path'], $matches);
    $pathParams = $matches[1] ?? [];

    $args = [];
    foreach ($methodInfo['params'] as $p) {
        if (in_array($p['name'], $pathParams, true)) {
            $args[] = "\${$p['name']}";
        } elseif ($p['name'] === 'query') {
            $args[] = "[]";
        } elseif ($p['name'] === 'body') {
            $args[] = "null";
        } elseif ($p['hasDefault']) {
            // skip — default covers it
            continue;
        } else {
            $args[] = "null";
        }
    }
    $callArgs = implode(', ', $args);

    $invocation = "\$this->client->{$resourceMethod}()->{$callMethod}({$callArgs})";

    $callBlock = renderInvocationBlock($invocation, $op['path'], $brokenReason, $optionalReason);

    if ($pathParams === []) {
        return $doc
             . "    public function {$testName}(): void\n"
             . "    {\n"
             . "        \$this->assertReadOnly('GET');\n"
             . $callBlock
             . "    }";
    }

    // Path-param endpoint — sample an ID from the matching list endpoint.
    if ($listEndpoint === null) {
        return $doc
             . "    public function {$testName}(): void\n"
             . "    {\n"
             . "        \$this->assertReadOnly('GET');\n"
             . "        self::markTestSkipped('No list endpoint available in this resource to sample an ID from.');\n"
             . "    }";
    }

    $listMethod = $listEndpoint['method'];
    $firstParam = $pathParams[0];
    $cacheKey = $group . ':' . $listEndpoint['path'];

    $body = "    public function {$testName}(): void\n"
          . "    {\n"
          . "        \$this->assertReadOnly('GET');\n"
          . "        \${$firstParam} = \$this->sampleId(\n"
          . "            " . var_export($cacheKey, true) . ",\n"
          . "            fn () => \$this->client->{$resourceMethod}()->{$listMethod}([\"limit\" => 1]),\n"
          . "        );\n"
          . $callBlock
          . "    }";

    return $doc . $body;
}

/**
 * Render the body that issues the request and asserts on the response,
 * with awareness of upstream-broken and optional endpoints.
 */
function renderInvocationBlock(
    string $invocation,
    string $path,
    ?string $brokenReason,
    ?string $optionalReason,
): string {
    if ($brokenReason !== null) {
        return "        try {\n"
             . "            \$response = {$invocation};\n"
             . "            self::assertNotNull(\$response, 'Expected a non-null response from GET {$path}');\n"
             . "        } catch (\\miralsoft\\synaxon\\api\\Exception\\ServerException \$e) {\n"
             . "            self::markTestIncomplete(" . var_export($brokenReason, true) . " . ' Last error: ' . \$e->getMessage());\n"
             . "        }\n";
    }

    if ($optionalReason !== null) {
        return "        try {\n"
             . "            \$response = {$invocation};\n"
             . "            self::assertNotNull(\$response, 'Expected a non-null response from GET {$path}');\n"
             . "        } catch (\\miralsoft\\synaxon\\api\\Exception\\NotFoundException) {\n"
             . "            self::markTestSkipped(" . var_export($optionalReason, true) . ");\n"
             . "        }\n";
    }

    return "        \$response = {$invocation};\n"
         . "        self::assertNotNull(\$response, 'Expected a non-null response from GET {$path}');\n";
}
