# SYNAXON Dashboard PHP API Client

A professional PHP client library for the **SYNAXON Marketplace REST API** (v1.9.2).

This library is meant to be embedded in other PHP projects. It does not perform
authentication itself — it expects the consuming application to supply
credentials (bearer token or HTTP basic) via `SynaxonConfig`.

---

## Table of contents

1. [Requirements](#requirements)
2. [Installation](#installation)
3. [Quick start](#quick-start)
4. [Configuration](#configuration)
5. [Available resources](#available-resources)
6. [Querying & filtering](#querying--filtering)
7. [Pagination](#pagination)
8. [Error handling](#error-handling)
9. [Logging (PSR-3)](#logging-psr-3)
10. [DTOs](#dtos)
11. [API compatibility checking](#api-compatibility-checking)
12. [Testing](#testing)
13. [Project layout](#project-layout)
14. [License](#license)

---

## Requirements

| Component | Version |
| --------- | ------- |
| PHP       | `>= 8.3` |
| Guzzle    | `^7.0` |
| PSR-3 Log | `^2.0 \|\| ^3.0` |

The library targets the SYNAXON Marketplace API at
`https://api.synaxon.com/marketplace`.

---

## Installation

```bash
composer require miralsoft/synaxon-api
```

If you use a private VCS repository, add the following to your application's
`composer.json` first:

```json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/MIRAL-Soft/Synaxon-Dashboard-PHP-API"
        }
    ]
}
```

---

## Quick start

```php
use miralsoft\synaxon\api\Client\SynaxonClient;
use miralsoft\synaxon\api\Config\SynaxonConfig;

$client = new SynaxonClient(new SynaxonConfig(
    bearerToken: 'your-bearer-token',
));

// List audit logs
$response = $client->audit()->listAuditLogs(['limit' => 50]);

// Find a customer
$customer = $client->customers()->find('customer-id-123');

// Create a notification
$client->notifications()->create(null, ['title' => 'Hello']);
```

Basic-auth example:

```php
$client = new SynaxonClient(new SynaxonConfig(
    basicUser: 'api-user',
    basicPass: 'api-secret',
));
```

---

## Configuration

`SynaxonConfig` can be built three ways.

### 1. Direct constructor

```php
$config = new SynaxonConfig(
    bearerToken:    'tok',
    baseUri:        'https://api.synaxon.com/marketplace',
    timeout:        30,
    connectTimeout: 10,
    maxRetries:     3,
    userAgent:      'my-app/1.2',
);
```

### 2. Environment variables

```bash
export SYNAXON_BEARER_TOKEN=...
# or
export SYNAXON_BASIC_USER=...
export SYNAXON_BASIC_PASS=...

# optional
export SYNAXON_BASE_URI=https://api.synaxon.com/marketplace
export SYNAXON_TIMEOUT=30
export SYNAXON_CONNECT_TIMEOUT=10
export SYNAXON_MAX_RETRIES=3
export SYNAXON_USER_AGENT=my-app/1.2
```

```php
$config = SynaxonConfig::fromEnv();
```

### 3. Array

```php
$config = SynaxonConfig::fromArray([
    'bearerToken' => 'tok',
    'timeout'     => 60,
]);
```

Bearer token and basic credentials are mutually exclusive — set one or the
other. A request issued without any credentials throws
`InvalidArgumentException`.

---

## Available resources

The client exposes 21 resource classes covering the 140 active endpoints in
the Marketplace API. Empty/placeholder paths in the spec (such as
`/v1/health`) are intentionally not implemented.

| Resource (`$client->...`) | Methods | Path prefix |
| ------------------------- | ------- | ----------- |
| `acronis()`               | All `/v1/acronis/*` operations          | `/v1/acronis/*` |
| `audit()`                 | All `/v1/audit/*` operations            | `/v1/audit/*` |
| `auth()`                  | All `/v1/auth/*` operations             | `/v1/auth/*` |
| `customers()`             | All `/v1/customers/*` operations        | `/v1/customers/*` |
| `downloads()`             | All `/v1/downloads/*` operations        | `/v1/downloads/*` |
| `eset()`                  | All `/v1/eset/*` operations             | `/v1/eset/*` |
| `layout()`                | All `/v1/layout/*` operations           | `/v1/layout/*` |
| `lywand()`                | All `/v1/lywand/*` operations           | `/v1/lywand/*` |
| `mailstore()`             | All `/v1/mailstore/*` operations        | `/v1/mailstore/*` |
| `nSight()`                | All `/v1/n-sight/*` operations          | `/v1/n-sight/*` |
| `notifications()`         | All `/v1/notifications/*` operations    | `/v1/notifications/*` |
| `patches()`               | All `/v1/patches/*` operations          | `/v1/patches/*` |
| `products()`              | All `/v1/products/*` operations         | `/v1/products/*` |
| `pusher()`                | All `/v1/pusher/*` operations           | `/v1/pusher/*` |
| `reports()`               | All `/v1/reports/*` operations          | `/v1/reports/*` |
| `salesOpportunities()`    | All `/v1/sales-opportunities/*` operations | `/v1/sales-opportunities/*` |
| `secAuditor()`            | All `/v1/sec-auditor/*` operations      | `/v1/sec-auditor/*` |
| `support()`               | All `/v1/support/*` operations          | `/v1/support/*` |
| `systemTasks()`           | All `/v1/system-tasks/*` operations     | `/v1/system-tasks/*` |
| `tenants()`               | All `/v1/tenants/*` operations          | `/v1/tenants/*` |
| `users()`                 | All `/v1/users/*` operations            | `/v1/users/*` |

### Method naming

* For collection roots and `/{id}` shapes the methods follow REST conventions:
  `list()`, `find($id)`, `create($body)`, `update($id, $body)`,
  `replace($id, $body)`, `delete($id)`.
* For everything else (special actions, sub-collections), the method name is
  derived from the camelCased suffix of the upstream `operationId` so the
  semantic intent is preserved, e.g.
  `audit()->listAuditLogs(...)`,
  `customers()->references($id)`,
  `mailstore()->refreshJournalingMailbox(...)`.

Every method carries:

* `@synaxon-endpoint METHOD /full/path` PHPDoc tag (used by the compatibility
  checker)
* `@synaxon-operation-id` PHPDoc tag mirroring the upstream operationId

---

## Querying & filtering

```php
use miralsoft\synaxon\api\Query\QueryBuilder;
use miralsoft\synaxon\api\Query\FilterOperator;

$query = (new QueryBuilder())
    ->limit(50)
    ->offset(100)
    ->orderBy('createdAt', 'desc')
    ->where('status', FilterOperator::EQ, 'open')
    ->where('id', FilterOperator::IN, [1, 2, 3]);

$response = $client->audit()->listAuditLogs($query->toArray());
```

Supported operators: `EQ`, `NEQ`, `GT`, `GTE`, `LT`, `LTE`, `ILIKE`, `IN`.

---

## Pagination

```php
use miralsoft\synaxon\api\Util\PaginationIterator;

$iter = new PaginationIterator(
    fetch: fn (int $page, int $limit) =>
        (array) ($client->audit()->listAuditLogs(['page' => $page, 'limit' => $limit])['data'] ?? []),
    limit: 100,
);

foreach ($iter as $log) {
    // ...
}
```

---

## Error handling

```
SynaxonApiException (base)
├── AuthenticationException (401, 403)
├── NotFoundException        (404)
├── RateLimitException       (429)
├── ValidationException      (400, 422)
├── ServerException          (5xx)
└── TransportException       (network / TLS)
```

```php
use miralsoft\synaxon\api\Exception\NotFoundException;
use miralsoft\synaxon\api\Exception\RateLimitException;

try {
    $customer = $client->customers()->find('xyz');
} catch (NotFoundException $e) {
    // Forward the correlation ID to support to make a bug report actionable:
    error_log('Customer not found, correlationId=' . $e->getCorrelationId());
} catch (RateLimitException $e) {
    sleep($e->getRetryAfter() ?? 1);
}
```

Every `SynaxonApiException` exposes `getCorrelationId(): ?string`. The
library extracts it from the `correlationId` field in the API's error
JSON body and (as a fallback) from the `X-Correlation-Id` /
`X-Request-Id` response headers.

The client retries `429` and `5xx` responses with exponential backoff plus
jitter (`maxRetries` controls the upper bound, default 3). 4xx errors other
than `429` are not retried, to avoid retry storms on permanent failures.

---

## Logging (PSR-3)

Pass any PSR-3 compatible logger to the client:

```php
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$logger = new Logger('synaxon');
$logger->pushHandler(new StreamHandler('php://stderr'));

$client = new SynaxonClient($config, null, $logger);
```

The library logs every request attempt at `debug` level. Sensitive headers
(`Authorization`, `Cookie`, `X-API-*`) are masked before any payload reaches
the logger. Tokens are also masked in `SynaxonConfig::__debugInfo()`.

---

## DTOs

Every schema in the OpenAPI document has a corresponding DTO class under
`src/DTO/`. They are minimal value-object wrappers around the raw associative
payload and provide:

* `static fromArray(array $data): static`
* `toArray(): array`
* `toJson(): string` (throws `JsonException` on failure)
* `jsonSerialize(): array` (`JsonSerializable`)
* `getRaw(string $field): mixed`
* `with(string $field, mixed $value): static` (immutable update)
* `withAll(array $patch): static` (immutable batch update)
* Typed getters per declared field

DTOs are tolerant of unknown fields — extra keys passed in `$data` are
preserved. Missing optional fields return `null` from their getter.

### Builder pattern for request DTOs

Every `*RequestDto` class additionally exposes typed `with*()` setters
that return a **new instance** on each call (immutability):

```php
use miralsoft\synaxon\api\DTO\CreateCustomerRequestDto;

$payload = (new CreateCustomerRequestDto())
    ->withName('Acme GmbH')
    ->withCustomerNumber('12345')
    ->withEmail('info@acme.test');

$client->customers()->create($payload->toArray());
```

---

## API compatibility checking

`bin/check-api-compat.php` diffs the implemented surface against either the
local spec or the live spec.

```bash
# Offline check (uses docs/openapi.json)
composer check-compat

# Live check against api.synaxon.com
php bin/check-api-compat.php --live

# Write JSON report to build/api-compat-report.json
php bin/check-api-compat.php --live --snapshot
```

Exit codes: `0` compatible, `1` drift, `2` spec unreachable.

The same logic is mirrored in two PHPUnit tests:

* `tests/Unit/ApiCompatibilityTest.php` — runs offline by default
* `tests/Integration/LiveCompatibilityTest.php` — runs only when integration
  tests are enabled (see below)

## Examples

The [`examples/`](examples/) folder contains five self-contained scripts
covering the most common usage patterns:

| Script | What it does |
| ------ | ------------ |
| `01-quickstart.php`     | Bearer-token client + `whoAmI()` |
| `02-list-customers.php` | List customers + DTO hydration |
| `03-pagination.php`     | Walk all pages with `PaginationIterator` |
| `04-error-handling.php` | Typed exception hierarchy + `getCorrelationId()` |
| `05-builder-pattern.php` | Immutable fluent `with*()` setters on request DTOs |

## Developer diagnostic: live data dump

For a quick human-readable sample of what each resource returns live,
run `bin/live-data-dump.php`. It issues one representative read call per
resource (whoAmI, list customers, list products, list devices, …) and
prints the response in a compact tree so you can verify the library
returns sensible data. Uses the credentials from `tests/.env.test`.

```bash
php bin/live-data-dump.php
```

The script is strictly a developer tool — it is not part of the test
suite, it is not autoloaded, and it is excluded from static analysis.

---

## Testing

```bash
composer install
composer test                  # unit tests only — never touches the network
composer analyse               # PHPStan level 8
composer test:integration      # live read-only smoke tests (opt-in)
composer test:all              # unit + integration
composer fmt                   # apply PHP-CS-Fixer to source + tests + examples
composer fmt:check             # report style violations without changing files
composer ci                    # one-shot: fmt:check + analyse + test
```

GitHub Actions runs the same `composer ci` chain on every push and pull
request against PHP 8.3 and 8.4 — see `.github/workflows/ci.yml`.

### Integration tests

Integration tests are **skipped automatically** unless `tests/.env.test`
contains valid credentials. There is no master switch — if you have no
credentials configured, nothing ever touches the live API.

Credentials accepted by the test suite:

- `SYNAXON_BEARER_TOKEN` — used directly if present.
- `SYNAXON_BASIC_USER` + `SYNAXON_BASIC_PASS` — exchanged for a bearer
  token via `POST /v1/auth/token`. The token is cached to
  `tests/.bearer-token.cache` (gitignored) and reused on subsequent test
  runs until it expires. This mirrors how Synaxon's own dashboard
  authenticates — the library itself remains auth-agnostic.

To enable integration tests locally:

```bash
cp tests/.env.test.example tests/.env.test
# edit tests/.env.test and fill in either the bearer token or basic user + password
composer test:integration
```

Integration tests are **strictly read-only**: the base
`IntegrationTestCase::assertReadOnly()` guard fails any test that attempts a
non-GET HTTP verb. There is no path through the suite that mutates live data.

The read-only suite under `tests/Integration/ReadOnly/` is **generated** from
the OpenAPI spec — one test file per resource, one test method per GET
endpoint (currently 84 methods across 20 resources). Regenerate them with:

```bash
php bin/generate-integration-read-tests.php
```

Endpoints with `{id}` path parameters automatically pull a sample ID from
the matching list endpoint via `EndpointSamplingTrait`. When no data is
provisioned in the tenant, those tests self-skip rather than fail. Endpoints
that the upstream API currently returns 5xx for are marked
`markTestIncomplete` so they stay visible without breaking the build.

### Test layout

```
tests/
├── Unit/
│   ├── ApiCompatibilityTest.php     # spec ↔ implementation diff (offline)
│   ├── Client/                      # client facade tests
│   ├── Config/                      # config validation
│   ├── DTO/HydrationTest.php        # round-trips every generated DTO
│   ├── Query/                       # query builder
│   ├── Resource/                    # per-resource tests with mock HTTP client
│   └── Util/                        # path builder etc.
├── Integration/
│   ├── IntegrationTestCase.php      # base class with read-only guard
│   ├── LiveCompatibilityTest.php    # spec ↔ implementation against live spec
│   └── ReadOnly/                    # generated read-only smoke tests per resource
│       ├── EndpointSamplingTrait.php  # fetches sample IDs from list endpoints
│       └── {Resource}ReadTest.php     # one test per GET endpoint (84 total)
├── Support/
│   ├── MockHttpClient.php           # in-memory HTTP stub
│   └── TokenCache.php               # Basic → Bearer exchange with on-disk cache
├── bootstrap.php                    # loads vendor + tests/.env.test
├── testConfig.php                   # central config helper
└── .env.test.example                # template for tests/.env.test
```

---

## Project layout

```
src/
├── Client/SynaxonClient.php
├── Config/SynaxonConfig.php
├── DTO/                             # 257 generated DTOs + AbstractDto
├── Exception/                       # typed exception hierarchy
├── Http/                            # GuzzleHttpClient + interface
├── Query/                           # QueryBuilder + FilterOperator
├── Resource/                        # 21 resource classes + AbstractResource
└── Util/                            # PathBuilder, DtoHydrator, PaginationIterator

bin/
├── check-api-compat.php             # standalone compatibility checker
├── generate-dtos.php                # one-shot DTO generator (reproducibility)
├── generate-resources.php           # one-shot resource generator (reproducibility)
├── generate-integration-read-tests.php  # one-shot read-test generator
└── live-data-dump.php               # developer diagnostic: pretty-prints one
                                     # read response per resource (uses credentials
                                     # from tests/.env.test)

config/
├── api-compat.php                   # compatibility checker configuration
└── generated-endpoints.json         # generator metadata (commit metadata)

docs/
├── openapi.json                     # extracted/canonical SYNAXON spec
└── swagger-ui-init.js               # raw upstream Swagger bundle

tests/                               # see "Testing" above
```

---

## Security

* `declare(strict_types=1);` in every source file.
* DTOs and config objects are immutable (`readonly` properties).
* TLS verification is always on (cannot be disabled by public API).
* Only `http` and `https` schemes are accepted for the base URI; other
  schemes are rejected at `SynaxonConfig` construction.
* Sensitive headers (`Authorization`, `Cookie`, `X-API-*`) are masked in
  logs via `GuzzleHttpClient::redactHeaders()`.
* Both the bearer token and the basic-auth pair (user + password) are
  completely masked in `SynaxonConfig::__debugInfo()` — the basic user
  half of an OAuth2 client-credentials pair is a secret in its own right.
* Callers cannot override reserved headers (`Authorization`, `Host`) via
  request options — the library owns authentication end-to-end.
* Error response bodies embedded in exception context are truncated to
  4 KiB to keep an oversize 5xx HTML page from ballooning memory.
* Path parameters are URL-encoded by `PathBuilder` — no string
  concatenation. Path expansion surfaces PCRE failures as
  `InvalidArgumentException` rather than silent empty strings.
* Retries use exponential backoff with jitter, capped at 30 seconds per
  sleep and `SynaxonConfig::MAX_RETRIES` (10) total attempts — only fires
  on `429` / `5xx`.
* `Retry-After` values from the server are clamped to the same cap.
* Timeouts are bounded to `SynaxonConfig::MAX_TIMEOUT_SECONDS` (600 s).
* Network errors are wrapped in `TransportException`; Guzzle internals
  never leak out of the public API.
* `tests/.bearer-token.cache` is written with an exclusive lock and
  `chmod 0600` so the cached bearer token stays readable only by the
  owner (best-effort on filesystems that honour Unix permissions).

---

## License

[MIT](LICENSE) © MIRAL Soft
