# SYNAXON Dashboard PHP API Client

A professional PHP client library for the **SYNAXON Marketplace REST API**, generated
from the API's published OpenAPI document (186 operations, 341 schemas as of
2026-11-24).

This library is meant to be embedded in other PHP projects. It does not perform
authentication itself; it expects the consuming application to supply
credentials (bearer token or HTTP basic) via `SynaxonConfig`.

> SYNAXON is a trademark of its owner. This is an independent, community
> library by MIRAL Soft. It is not affiliated with, endorsed by, or supported
> by SYNAXON.

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
12. [What this library does not do](#what-this-library-does-not-do)
13. [Testing](#testing)
14. [Project layout](#project-layout)
15. [Security](#security)
16. [License](#license)

---

## Requirements

| Component | Version |
| --------- | ------- |
| PHP       | `>= 8.4` |
| Guzzle    | `^7.16.5 \|\| ^8.5.5` (PSR-7 `^2.13.4 \|\| ^3.6`) |
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

// Keep credentials out of source code. fromEnv() reads SYNAXON_BEARER_TOKEN
// (or SYNAXON_BASIC_USER + SYNAXON_BASIC_PASS) and the optional settings.
$client = new SynaxonClient(SynaxonConfig::fromEnv());

// List audit logs
$response = $client->audit()->listAuditLogs(['limit' => 50]);

// Find a customer
$customer = $client->customers()->find('customer-id-123');

// Mark a notification as read
$client->notifications()->setRead('message-id-123');
```

Passing credentials explicitly, for example from your own secret store:

```php
$client = new SynaxonClient(new SynaxonConfig(
    basicUser: $secrets->get('synaxon.client_id'),
    basicPass: $secrets->get('synaxon.client_secret'),
));
```

Credentials must be non-empty strings or `null`; an empty string is rejected
at construction, so a missing environment variable fails early and clearly.

---

## Configuration

`SynaxonConfig` can be built three ways.

### 1. Direct constructor

```php
$config = new SynaxonConfig(
    bearerToken:    $secrets->get('synaxon.bearer_token'),
    baseUri:        'https://api.synaxon.com/marketplace',
    timeout:        30,
    connectTimeout: 10,
    maxRetries:     3,
    userAgent:      'my-app/1.2',
    acceptLanguage: 'de',   // sent as Accept-Language with every request
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
export SYNAXON_ACCEPT_LANGUAGE=de
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

Bearer token and basic credentials are mutually exclusive: set one or the
other. A request issued without any credentials throws
`InvalidArgumentException`.

---

## Available resources

The client exposes 28 resource classes covering all 186 operations of the
Marketplace API. Path entries without operations in the spec (such as
`/v1/health`) have nothing to implement.

| Resource (`$client->...`) | Methods | Path prefix |
| ------------------------- | ------- | ----------- |
| `acronis()`               | All `/v1/acronis/*` operations          | `/v1/acronis/*` |
| `audit()`                 | All `/v1/audit/*` operations            | `/v1/audit/*` |
| `auth()`                  | All `/v1/auth/*` operations             | `/v1/auth/*` |
| `billing()`               | All `/v1/billing/*` operations          | `/v1/billing/*` |
| `cloudally()`             | All `/v1/cloudally/*` operations        | `/v1/cloudally/*` |
| `cove()`                  | All `/v1/cove/*` operations             | `/v1/cove/*` |
| `customers()`             | All `/v1/customers/*` operations        | `/v1/customers/*` |
| `cyansecurity()`          | All `/v1/cyansecurity/*` operations     | `/v1/cyansecurity/*` |
| `downloads()`             | All `/v1/downloads/*` operations        | `/v1/downloads/*` |
| `eset()`                  | All `/v1/eset/*` operations             | `/v1/eset/*` |
| `guardian360()`           | All `/v1/guardian360/*` operations      | `/v1/guardian360/*` |
| `layout()`                | All `/v1/layout/*` operations           | `/v1/layout/*` |
| `lywand()`                | All `/v1/lywand/*` operations           | `/v1/lywand/*` |
| `mailstore()`             | All `/v1/mailstore/*` operations        | `/v1/mailstore/*` |
| `nSight()`                | All `/v1/n-sight/*` operations          | `/v1/n-sight/*` |
| `notifications()`         | All `/v1/notifications/*` operations    | `/v1/notifications/*` |
| `patches()`               | All `/v1/patches/*` operations          | `/v1/patches/*` |
| `products()`              | All `/v1/products/*` operations         | `/v1/products/*` |
| `pusher()`                | All `/v1/pusher/*` operations           | `/v1/pusher/*` |
| `reports()`               | All `/v1/reports/*` operations          | `/v1/reports/*` |
| `rollouter()`             | All `/v1/rollouter/*` operations        | `/v1/rollouter/*` |
| `salesOpportunities()`    | All `/v1/sales-opportunities/*` operations | `/v1/sales-opportunities/*` |
| `secAuditor()`            | All `/v1/sec-auditor/*` operations      | `/v1/sec-auditor/*` |
| `smao()`                  | All `/v1/smao/*` operations             | `/v1/smao/*` |
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
  `customers()->listReferences($id)`,
  `mailstore()->checkAliasAvailability(['alias' => 'acme'])`.

Every method carries:

* `@synaxon-endpoint METHOD /full/path` PHPDoc tag (used by the compatibility
  checker)
* `@synaxon-operation-id` PHPDoc tag mirroring the upstream operationId

---

## Querying & filtering

```php
use miralsoft\synaxon\api\Query\QueryBuilder;

$query = (new QueryBuilder())
    ->page(0)                          // pages are counted from 0
    ->limit(50)                        // at most 100
    ->orderBy('name', 'desc')
    ->search('acme')
    ->with('status', ['active', 'trial']);   // endpoint-specific parameter

$response = $client->customers()->list($query->toArray());
```

Every list endpoint accepts `page`, `limit`, `orderBy`, `orderDirection` and
`search`; which other parameters an endpoint takes, and which `orderBy`
values it allows, is listed in its docblock and in `docs/openapi.json`. Lists
are sent as repeated keys (`status=active&status=trial`) and booleans as
`true` / `false`.

`offset()` and `where()` are deprecated: no endpoint declares an `offset` or
`filter` parameter, so the server ignores them.

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

The API counts pages from `0`, which is where the iterator starts by default,
and accepts at most `100` items per page (a larger `limit` is rejected with
`400`).

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

Every `SynaxonApiException` also exposes `getErrorCode(): ?string`, the
API's machine-readable code such as `GENERIC.VALIDATION_ERROR`; branch on it
rather than on the message. `ValidationException::getErrors()` returns the
API's sub-errors, one readable line per rejected field (for example
`limit must not be greater than 100`).

Every `SynaxonApiException` exposes `getCorrelationId(): ?string`. The
library extracts it from the `correlationId` field in the API's error
JSON body and (as a fallback) from the `X-Correlation-Id` /
`X-Request-Id` response headers.

The client retries transient failures with exponential backoff plus jitter
(`maxRetries` controls the upper bound, default 3):

| Failure | `GET`, `HEAD`, `OPTIONS`, `PUT`, `DELETE` | `POST`, `PATCH` |
| ------- | ------------------------------------------ | --------------- |
| `429` | retried | retried (the server refused the request, nothing was processed) |
| `5xx` | retried | **not retried** |
| connection error, timeout | retried | **not retried** |
| other `4xx` | not retried | not retried |

A `POST` or `PATCH` that failed upstream or timed out may already have taken
effect, and repeating it could create a second record. The exception is
raised instead, so the caller decides whether to check and retry.

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

The library logs every request attempt at `debug` level, and `401` / `403`
responses at `warning` level as security-relevant events. Log context holds
method, path, attempt, status and error message; it never holds headers or
credentials. Sensitive headers
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

DTOs are tolerant of unknown fields: extra keys passed in `$data` are
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

# Live check against the OpenAPI document the SYNAXON Swagger UI loads
# (https://api.synaxon.com/marketplace/swagger/marketplace-openapi.json)
php bin/check-api-compat.php --live

# Write JSON report to build/api-compat-report.json
php bin/check-api-compat.php --live --snapshot
```

Exit codes: `0` compatible, `1` drift, `2` spec unreachable.

The live document is accepted only when it is served as JSON and contains an
OpenAPI `paths` object, because the Swagger UI answers `200` with HTML for
unknown paths. The same logic is mirrored in two PHPUnit tests:

* `tests/Unit/ApiCompatibilityTest.php` runs offline by default
* `tests/Integration/LiveCompatibilityTest.php` runs only when integration
  tests are enabled (see below)

## What this library does not do

* **No telemetry.** The library contacts only the configured `baseUri`. It
  sends nothing to MIRAL Soft or anyone else.
* **No login, token refresh or credential storage.** It takes a bearer token
  or a basic pair from you and sends it as the `Authorization` header. It never
  writes credentials to disk, caches tokens or runs an OAuth flow.
* **No caching of API data.** Every call goes to the API; nothing is stored
  between calls.
* **No automatic repeat of creating or changing calls after an upstream
  failure.** `POST` and `PATCH` are retried only on `429` (see
  [Error handling](#error-handling)).
* **No relaxed TLS.** Certificate verification cannot be switched off.

---

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

The script is strictly a developer tool. It is not part of the test
suite, it is not autoloaded, and it is excluded from static analysis.

---

## Testing

```bash
composer install
composer test                  # unit tests only, never touches the network
composer analyse               # PHPStan level 8
composer test:integration      # live read-only smoke tests (opt-in)
composer test:all              # unit + integration
composer fmt                   # apply PHP-CS-Fixer to source + tests + examples
composer fmt:check             # report style violations without changing files
composer generate              # regenerate DTOs, resources, client and generated tests
composer check:generated       # fail if regenerating changes any committed file
composer check:content         # fail on em-dashes in prose or secret-like strings
composer ci                    # every gate CI runs, in one command
composer update-spec           # fetch the live OpenAPI document into docs/openapi.json
composer public-api            # approve an intended change of the public API surface
```

`tests/Unit/PublicApiTest.php` compares every public method signature with
the approved list in `tests/Fixtures/public-api.txt`. When an upstream rename
or a change here alters the surface, the test lists what was removed and
added; approve it with `composer public-api` only after noting it in the
CHANGELOG (a removal is a major version).

When SYNAXON changes its API: `composer update-spec`, then `composer generate`,
then `composer ci`, and `composer check-compat -- --live` to confirm there is no
drift left.

`composer ci` runs `check:content`, `fmt:check`, `analyse`, `test`,
`check:generated` and `composer audit`. GitHub Actions runs the same gates on
every push and pull request against PHP 8.4 and 8.5 with Guzzle 8, and on
PHP 8.4 with Guzzle 7 (see `.github/workflows/ci.yml`). It additionally
checks that the package archive contains no development files.

Generated files (`src/DTO/`, `src/Resource/*Resource.php`,
`src/Client/SynaxonClient.php`, `config/generated-endpoints.json` and the
generated tests) are never edited by hand. Change the generator in `bin/`,
run `composer generate`, and commit the generator change together with the
regenerated output.

### Integration tests

Integration tests are **skipped automatically** unless `tests/.env.test`
contains valid credentials. There is no master switch: if you have no
credentials configured, nothing ever touches the live API.

Credentials accepted by the test suite:

- `SYNAXON_BEARER_TOKEN`: used directly if present.
- `SYNAXON_BASIC_USER` + `SYNAXON_BASIC_PASS`: exchanged for a bearer
  token via `POST /v1/auth/token`. The token is cached to
  `tests/.bearer-token.cache` (gitignored) and reused on subsequent test
  runs until it expires. This mirrors how Synaxon's own dashboard
  authenticates; the library itself remains auth-agnostic.

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
the OpenAPI spec: one test file per resource, one test method per GET
endpoint (currently 110 methods across 26 resources). Regenerate them with:

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
│   ├── DTO/SpecExampleHydrationTest.php # hydrates DTOs with the spec's own examples
│   ├── Query/                       # query builder
│   ├── Resource/                    # per-resource tests with mock HTTP client
│   └── Util/                        # path builder etc.
├── Integration/
│   ├── IntegrationTestCase.php      # base class with read-only guard
│   ├── LiveCompatibilityTest.php    # spec ↔ implementation against live spec
│   └── ReadOnly/                    # generated read-only smoke tests per resource
│       ├── EndpointSamplingTrait.php  # fetches sample IDs from list endpoints
│       └── {Resource}ReadTest.php     # one test per GET endpoint (110 total)
├── Support/
│   ├── LiveSpec.php                 # fetches and validates the live OpenAPI document
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
├── DTO/                             # 341 generated DTOs + AbstractDto
├── Exception/                       # typed exception hierarchy
├── Http/                            # GuzzleHttpClient + interface
├── Query/                           # QueryBuilder + FilterOperator
├── Resource/                        # 28 resource classes + AbstractResource
├── Util/                            # PathBuilder, DtoHydrator, PaginationIterator
└── Version.php                      # the one authoritative library version

bin/
├── check-api-compat.php             # standalone compatibility checker
├── check-content.php                # em-dash and secret scan with self-test
├── check-generated.php              # generated code reproducibility check
├── update-spec.php                  # fetches the live OpenAPI document
├── generate-dtos.php                # one-shot DTO generator (reproducibility)
├── generate-resources.php           # one-shot resource generator (reproducibility)
├── generate-write-tests.php         # one-shot write-test generator
├── generate-integration-read-tests.php  # one-shot read-test generator
└── live-data-dump.php               # developer diagnostic: pretty-prints one
                                     # read response per resource (uses credentials
                                     # from tests/.env.test)

config/
├── api-compat.php                   # compatibility checker configuration
└── generated-endpoints.json         # generator metadata (commit metadata)

docs/
└── openapi.json                     # SYNAXON spec, pretty-printed (composer update-spec)

tests/                               # see "Testing" above
```

---

## Security

Found a vulnerability? Please report it privately as described in
[SECURITY.md](SECURITY.md), not in a public issue.

* `declare(strict_types=1);` in every source file.
* DTOs and config objects are immutable (`readonly` properties).
* TLS verification is always on (cannot be disabled by public API).
* The base URI must use `https`. Plain `http` is accepted only for
  `localhost`, `127.0.0.1` and `[::1]` (local mocks and proxies), because the
  credential travels with every request. Other schemes are rejected at
  `SynaxonConfig` construction.
* Path parameters equal to `.` or `..` are rejected, since URI resolution
  would otherwise retarget the request to a parent path.
* Sensitive headers (`Authorization`, `Cookie`, `X-API-*`) are masked in
  logs via `GuzzleHttpClient::redactHeaders()`.
* Both the bearer token and the basic-auth pair (user + password) are
  completely masked in `SynaxonConfig::__debugInfo()`, because the basic user
  half of an OAuth2 client-credentials pair is a secret in its own right.
* Callers cannot override reserved headers (`Authorization`, `Host`) via
  request options; the library owns authentication end-to-end.
* Error response bodies embedded in exception context are truncated to
  4 KiB to keep an oversize 5xx HTML page from ballooning memory.
* Path parameters are URL-encoded by `PathBuilder`, never by string
  concatenation. Path expansion surfaces PCRE failures as
  `InvalidArgumentException` rather than silent empty strings.
* Retries use exponential backoff with jitter, capped at 30 seconds per
  sleep and `SynaxonConfig::MAX_RETRIES` (10) total attempts. They fire on
  `429` for every method, and on `5xx` and connection errors only for
  idempotent methods.
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
