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
} catch (NotFoundException) {
    // ...
} catch (RateLimitException $e) {
    sleep($e->getRetryAfter() ?? 1);
}
```

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
* Typed getters per declared field

DTOs are tolerant of unknown fields — extra keys passed in `$data` are
preserved. Missing optional fields return `null` from their getter.

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

---

## Testing

```bash
composer install
composer test                  # unit tests only — never touches the network
composer analyse               # PHPStan level 8
composer test:integration      # live read-only smoke tests (opt-in)
composer test:all              # unit + integration
```

### Integration tests

Integration tests are **disabled by default** and only run when both
conditions are true:

1. The environment variable `SYNAXON_INTEGRATION` is set to `1`.
2. `tests/.env.test` exists and contains valid credentials.

To enable them locally:

```bash
cp tests/.env.test.example tests/.env.test
# then edit tests/.env.test, set SYNAXON_INTEGRATION=1 plus credentials
composer test:integration
```

Integration tests are **strictly read-only**: the base
`IntegrationTestCase::assertReadOnly()` guard fails any test that attempts a
non-GET HTTP verb. There is no path through the suite that mutates live data.

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
│   └── ReadOnly/                    # read-only smoke tests per resource
├── Support/MockHttpClient.php       # in-memory HTTP stub
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
└── generate-resources.php           # one-shot resource generator (reproducibility)

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
* Sensitive headers are masked in logs and in `SynaxonConfig::__debugInfo()`.
* Path parameters are URL-encoded by `PathBuilder` — no string concatenation.
* Retries use exponential backoff with jitter and only fire on `429` / `5xx`.
* Network errors are wrapped in `TransportException`; Guzzle internals never
  leak out of the public API.

---

## License

[MIT](LICENSE) © MIRAL Soft
