# SYNAXON Marketplace PHP API Client

[![CI](https://github.com/MIRAL-Soft/Synaxon-Dashboard-PHP-API/actions/workflows/ci.yml/badge.svg)](https://github.com/MIRAL-Soft/Synaxon-Dashboard-PHP-API/actions/workflows/ci.yml)
[![Packagist](https://img.shields.io/packagist/v/miralsoft/synaxon-api.svg)](https://packagist.org/packages/miralsoft/synaxon-api)
[![PHP](https://img.shields.io/packagist/php-v/miralsoft/synaxon-api.svg)](https://packagist.org/packages/miralsoft/synaxon-api)
[![License: MIT](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)

A PHP client for the **SYNAXON Marketplace REST API**: customers, managed services
(Acronis, ESET, N-sight, Lywand, MailStore, SEC AUDITOR, Cloudally, Cove,
CyanSecurity, Guardian360, Rollouter, SMAO), patches, reports, notifications,
tenants and more, from one typed client.

The library is generated from the API's published OpenAPI document and covers
**all 186 operations and 341 schemas** (state of 2026-11-24). It is meant to be
embedded in your own application.

> SYNAXON is a trademark of its owner. This is an independent library by
> MIRAL Soft. It is not affiliated with, endorsed by, or supported by SYNAXON.

## Features

- **Complete coverage**: one method per API operation, 28 resource classes.
- **Typed DTOs** for every schema, with immutable builders for request bodies.
- **Typed exceptions** with the API's error code, sub-errors and correlation ID.
- **Safe retries**: exponential backoff for `429` and transient failures, but
  never a repeated `POST` or `PATCH` after the server may have acted.
- **File uploads and downloads** (multipart uploads; CSV, PDF and image
  downloads).
- **Pagination helper**, query builder, PSR-3 logging with credential masking.
- **API compatibility check** your application can call to find out whether
  SYNAXON changed its API.
- Guzzle 7 and 8, PHP 8.4 and 8.5, PHPStan level 8 clean.

## Contents

1. [Requirements](#requirements)
2. [Installation](#installation)
3. [Authentication](#authentication)
4. [Quick start](#quick-start)
5. [Configuration](#configuration)
6. [What you can do](#what-you-can-do)
7. [Calling the API](#calling-the-api)
8. [Error handling and retries](#error-handling-and-retries)
9. [Logging (PSR-3)](#logging-psr-3)
10. [DTOs](#dtos)
11. [API compatibility check](#api-compatibility-check)
12. [What this library does not do](#what-this-library-does-not-do)
13. [Examples](#examples)
14. [Versioning and upgrading](#versioning-and-upgrading)
15. [Security](#security)
16. [Development](#development)
17. [License](#license)

---

## Requirements

| Component | Version |
| --------- | ------- |
| PHP       | `>= 8.4` |
| Guzzle    | `^7.16.5 \|\| ^8.5.5` (PSR-7 `^2.13.4 \|\| ^3.6`) |
| PSR-3 Log | `^2.0 \|\| ^3.0` |

The API lives at `https://api.synaxon.com/marketplace`. You need **API client
credentials** for it (a client ID and a client secret, created in the SYNAXON
developer settings). Your dashboard login does not work here.

## Installation

```bash
composer require miralsoft/synaxon-api
```

Still on PHP 8.3? Use `composer require miralsoft/synaxon-api:^1.1`; see
[Versioning and upgrading](#versioning-and-upgrading).

---

## Authentication

The API accepts a **bearer token** on every call. You get one by exchanging
your client credentials at the token endpoint; the client ID and secret
themselves are accepted only there.

```php
use miralsoft\synaxon\api\Client\SynaxonClient;
use miralsoft\synaxon\api\Config\SynaxonConfig;

// 1. Exchange the client credentials for a token.
$tokenClient = new SynaxonClient(new SynaxonConfig(
    basicUser: $secrets->get('synaxon.client_id'),
    basicPass: $secrets->get('synaxon.client_secret'),
));
$token = $tokenClient->auth()->createApiSession([
    'grant_type' => 'client_credentials',
    'scope'      => 'sys-app',        // or 'sys-app-beta'
]);
// ['access_token' => '...', 'expires_in' => 3600, 'token_type' => ..., 'scope' => ...]

// 2. Use the token for everything else.
$client = new SynaxonClient(new SynaxonConfig(bearerToken: $token['access_token']));
```

The token expires after `expires_in` seconds. Caching it and requesting a new
one in time is your application's job: the library deliberately stores no
credentials and runs no login flow (see
[What this library does not do](#what-this-library-does-not-do)).

## Quick start

```php
use miralsoft\synaxon\api\Client\SynaxonClient;
use miralsoft\synaxon\api\Config\SynaxonConfig;

// Reads SYNAXON_BEARER_TOKEN and the optional settings from the environment.
$client = new SynaxonClient(SynaxonConfig::fromEnv());

$me        = $client->auth()->whoAmI();                      // the current user
$customers = $client->customers()->list(['limit' => 50]);    // ['data' => [...], 'totalItems' => ..., 'page' => ..., 'limit' => 50]
$customer  = $client->customers()->find('42');
$client->notifications()->setRead('message-id');
```

---

## Configuration

`SynaxonConfig` is immutable and validated when it is built. Three ways to
create one:

```php
// 1. Constructor
$config = new SynaxonConfig(
    bearerToken:    $token,
    baseUri:        'https://api.synaxon.com/marketplace',   // default
    timeout:        30,             // seconds, 1..600
    connectTimeout: 10,             // seconds, 1..600
    maxRetries:     3,              // 0..10
    userAgent:      'my-app/1.2',   // default: miralsoft-synaxon-api/<version>
    acceptLanguage: 'de',           // sent as Accept-Language; null = API default
);

// 2. Environment variables
$config = SynaxonConfig::fromEnv();

// 3. Array, for example from your framework's configuration
$config = SynaxonConfig::fromArray(['bearerToken' => $token, 'timeout' => 60]);
```

| Environment variable / array key | Meaning |
| -------------------------------- | ------- |
| `SYNAXON_BEARER_TOKEN` / `bearerToken` | Bearer token for all regular calls |
| `SYNAXON_BASIC_USER` / `basicUser`, `SYNAXON_BASIC_PASS` / `basicPass` | Client ID and secret, only for the token endpoint |
| `SYNAXON_BASE_URI` / `baseUri` | API base URI |
| `SYNAXON_TIMEOUT` / `timeout`, `SYNAXON_CONNECT_TIMEOUT` / `connectTimeout` | Timeouts in seconds |
| `SYNAXON_MAX_RETRIES` / `maxRetries` | Retries for transient failures |
| `SYNAXON_USER_AGENT` / `userAgent` | User-Agent header |
| `SYNAXON_ACCEPT_LANGUAGE` / `acceptLanguage` | Accept-Language header, e.g. `de` or `de-DE, en;q=0.8` |

The constructor rejects invalid settings with an `InvalidArgumentException`:

- a base URI that is not `https` (plain `http` only for `localhost`,
  `127.0.0.1` and `[::1]`), or one with user info, a query string or a fragment;
- credentials that are empty strings or contain control characters;
- a bearer token together with a basic pair (set one, not both);
- out-of-range timeouts or retries.

`fromEnv()` uses the bearer token when it is set and ignores the basic
variables then. A call without any credentials throws `InvalidArgumentException`.

---

## What you can do

Each area of the API is a resource on the client. Every method maps to one API
operation; its docblock names the HTTP method and path.

| Resource (`$client->...`) | What it covers | Operations |
| ------------------------- | -------------- | ---------: |
| `acronis()`            | Acronis customers, devices and policies; customer and partner metrics | 11 |
| `audit()`              | Audit log and its filter options | 2 |
| `auth()`               | Token and session handling, API tokens, current user, EGIS sign-in | 12 |
| `billing()`            | Partner API keys | 3 |
| `cloudally()`          | Cloudally customers, partner, tasks, backup statuses, report data and metrics | 11 |
| `cove()`               | Cove customers | 4 |
| `customers()`          | Customers (incl. import and suggestions), service references, customer report settings and PDF reports | 13 |
| `cyansecurity()`       | CyanSecurity customers | 3 |
| `downloads()`          | Download files and their download links | 3 |
| `eset()`               | ESET products, partners, customers, licenses, devices and device problems, metrics | 16 |
| `guardian360()`        | Guardian360 customers | 4 |
| `layout()`             | Dashboard layouts | 5 |
| `lywand()`             | Lywand partners, customers, targets, vulnerabilities, installation tokens and metrics | 16 |
| `mailstore()`          | MailStore instances, journaling mailboxes, archives, profiles, metrics and raw API pass-through | 18 |
| `nSight()`             | N-sight sites, devices, checks, take-control URLs, metrics and raw data extraction API | 12 |
| `notifications()`      | Messages, read status, bulk updates | 8 |
| `patches()`            | Patches, deployment targets and (bulk) deployment | 4 |
| `products()`           | Available managed services | 1 |
| `pusher()`             | Pusher user and channel authentication | 2 |
| `reports()`            | Partner report settings and PDF reports | 5 |
| `rollouter()`          | Rollouter customers and rollouts | 4 |
| `salesOpportunities()` | Sales opportunities and their CSV / PDF export | 3 |
| `secAuditor()`         | SEC AUDITOR customers and installers | 5 |
| `smao()`               | SMAO customers | 4 |
| `support()`            | Support chatbot queries and chat threads | 5 |
| `systemTasks()`        | Status of asynchronous system tasks | 1 |
| `tenants()`            | Tenant data, logo, SMTP configuration and test mail | 10 |
| `users()`              | User updates | 1 |

**Method names** follow REST conventions where the path allows it: `list()`,
`find($id)`, `create($body)`, `update($id, $body)`, `replace($id, $body)`,
`delete($id)`. Everything else is named after the upstream operation, for
example `audit()->listAuditLogs()`, `customers()->listReferences($id)` or
`mailstore()->checkAliasAvailability(['alias' => 'acme'])`. Your IDE lists
them all; each method's docblock shows its HTTP method and path.

---

## Calling the API

### Arguments

Methods take path parameters as strings, then the request body (an array),
then query parameters (an array), in that order, only where the operation has
them:

```php
$client->customers()->find('42');                                  // path parameter
$client->customers()->create(['name' => 'Acme GmbH']);             // body
$client->customers()->update('42', ['name' => 'Acme AG']);         // path + body
$client->eset()->listEsetCustomers(['limit' => 20, 'page' => 0]);  // query
```

A body can also be built with a request DTO and passed as `->toArray()` (see
[DTOs](#dtos)).

### Return values

Every method returns the decoded response as an array, so it can never break
on a field the API adds later:

| The API answers with | You get |
| -------------------- | ------- |
| a JSON object or array | the decoded array |
| no content (`204`)     | `null` |
| a file (PDF, CSV, installer, ...) | `['_raw' => string, '_contentType' => string]` |
| a bare JSON value (`true`, `42`)  | `['value' => mixed]` |

Turn an array into a typed object when you want one:

```php
use miralsoft\synaxon\api\DTO\CustomerPaginatedResponseDto;
use miralsoft\synaxon\api\DTO\CustomerResponseDto;

$page = CustomerPaginatedResponseDto::fromArray($client->customers()->list(['limit' => 50]));
foreach ($page->getData() as $customer) {    // list<CustomerResponseDto>
    echo $customer->getName(), "\n";
}

$one = CustomerResponseDto::fromArray($client->customers()->find('42'));
```

### Filtering and sorting

Every list endpoint accepts `page`, `limit`, `orderBy`, `orderDirection` and
`search`; many accept more (for example `status`, `customerId`,
`managementType`), as listed in the method's docblock. Pass them as an array
or build them:

```php
use miralsoft\synaxon\api\Query\QueryBuilder;

$query = (new QueryBuilder())
    ->page(0)                              // pages are counted from 0
    ->limit(50)                            // at most 100
    ->orderBy('name', 'desc')
    ->search('acme')
    ->with('status', ['active', 'trial']); // endpoint-specific parameter

$response = $client->customers()->list($query->toArray());
```

Lists are sent as repeated keys (`status=active&status=trial`), booleans as
`true` / `false`. `QueryBuilder::offset()` and `where()` are deprecated: the
API has no `offset` or `filter` parameter.

### Pagination

```php
use miralsoft\synaxon\api\Util\PaginationIterator;

$customers = new PaginationIterator(
    fetch: fn (int $page, int $limit): array =>
        $client->customers()->list(['page' => $page, 'limit' => $limit])['data'] ?? [],
    limit: 100,
);

foreach ($customers as $customer) {
    // every customer, page after page
}
```

The API counts pages from `0` (where the iterator starts) and accepts at most
`100` items per page; a larger `limit` is rejected with `400`.

### Downloads

File responses (the sales-opportunity CSV and PDF exports, the tenant logo)
arrive as raw bytes with their content type, even when the file is empty:

```php
$pdf = $client->salesOpportunities()->exportNSightSalesOpportunitiesPDF();
file_put_contents('opportunities.pdf', $pdf['_raw']);   // $pdf['_contentType'] === 'application/pdf'

$logo = $client->tenants()->getLogo($tenantId);           // ['_raw' => ..., '_contentType' => 'application/octet-stream']
```

### Asynchronous operations

Some operations start work on the server and answer with a task ID instead of
the result: `customers()->generateCustomerReport($id)`,
`reports()->generatePartnerReport()` and `mailstore()->createMailstoreInstance()`.
Follow the task with `systemTasks()`:

```php
$task   = $client->reports()->generatePartnerReport();   // ['taskId' => '...']
$status = $client->systemTasks()->find($task['taskId']); // id, label, status, result, ...
```

Each call to such an operation starts a new task, even though the report
operations are `GET` requests.

### Uploads

Operations that take a file are sent as `multipart/form-data` automatically.
Pass a stream or resource as the field's `contents`:

```php
$client->tenants()->updateLogo($tenantId, [
    'logo' => ['contents' => fopen('logo.png', 'r'), 'filename' => 'logo.png'],
]);
```

If such a request has to be retried, the file is rewound and sent again; a
stream that cannot be rewound is sent once only.

---

## Error handling and retries

```
SynaxonApiException (base, a RuntimeException)
├── AuthenticationException      401, 403
├── NotFoundException            404
├── RateLimitException           429         getRetryAfter(): ?int (seconds)
├── ValidationException          400, 422    getErrors(): list<string>
├── ServerException              5xx
├── TransportException           network, TLS, timeout
└── UnexpectedResponseException  a response is not what the API declares (e.g. a required field is missing)
```

Every exception also offers:

- `getErrorCode(): ?string`: the API's machine-readable code, such as
  `GENERIC.VALIDATION_ERROR`. Branch on this rather than on the message.
- `getCorrelationId(): ?string`: forward it to SYNAXON support with a bug report.
- `getContext(): array`: method, path, status and the (truncated) error body.

```php
use miralsoft\synaxon\api\Exception\NotFoundException;
use miralsoft\synaxon\api\Exception\RateLimitException;
use miralsoft\synaxon\api\Exception\ValidationException;

try {
    $client->customers()->list(['limit' => 1000]);
} catch (ValidationException $e) {
    // $e->getErrorCode() === 'GENERIC.VALIDATION_ERROR'
    // $e->getErrors()    === ['limit must not be greater than 100']
} catch (NotFoundException $e) {
    error_log('Not found, correlationId=' . $e->getCorrelationId());
} catch (RateLimitException $e) {
    sleep($e->getRetryAfter() ?? 5);
}
```

Programming errors (invalid configuration, a missing path parameter, a query
value that is not a scalar or a list of scalars) throw
`InvalidArgumentException`.

**Retries.** Transient failures are retried with exponential backoff and
jitter, up to `maxRetries` times (default 3):

| Failure | `GET`, `HEAD`, `OPTIONS`, `PUT`, `DELETE` | `POST`, `PATCH` |
| ------- | ------------------------------------------ | --------------- |
| `429` | retried | retried (the server refused the request, nothing was processed) |
| `5xx` | retried | **not retried** |
| connection error, timeout | retried | **not retried** |
| other `4xx` | not retried | not retried |

A `POST` or `PATCH` that failed upstream or timed out may already have taken
effect, and repeating it could create a second record; the exception is
raised instead, so your code decides. A `429` is retried after the server's
`Retry-After`; if that asks for more than 30 seconds, the
`RateLimitException` is raised at once rather than blocking your request.

---

## Logging (PSR-3)

Pass any PSR-3 logger as the third argument:

```php
$client = new SynaxonClient($config, null, $logger);
```

Every request attempt is logged at `debug` level with method, path, attempt,
status and error message; `401` / `403` responses are logged at `warning`
level as security events. Headers and credentials are never part of a log
entry. If you log headers yourself, `GuzzleHttpClient::redactHeaders()` masks
every credential header (`Authorization`, `Proxy-Authorization`, cookies,
tokens, keys, secrets). `var_dump($config)` shows credentials masked.

---

## DTOs

Every schema has a DTO class in `miralsoft\synaxon\api\DTO`. A DTO wraps the
raw payload and offers:

- `fromArray(array $data)`, `toArray()`, `toJson()`, `jsonSerialize()`
- a typed getter per field, for example `getName(): string`
- `getRaw(string $field)` for any field, including ones the API added later
- `with(string $field, mixed $value)` and `withAll(array $patch)`, returning
  new instances

Getters follow the spec: an optional field returns `null` when it is absent;
a required field that is missing throws `UnexpectedResponseException` instead
of inventing an empty value; a field the spec declares as required but
nullable returns `null` for a `null` value.

Request DTOs (`*RequestDto`) have typed, immutable `with*()` setters:

```php
use miralsoft\synaxon\api\DTO\CreateCustomerRequestDto;

$payload = (new CreateCustomerRequestDto())
    ->withName('Acme GmbH')
    ->withCustomerNumber('12345')
    ->withEmail('info@acme.test');

$client->customers()->create($payload->toArray());
```

`miralsoft\synaxon\api\Util\DtoHydrator::hydrateMany(Dto::class, $items)`
turns a list of arrays into a list of DTOs.

---

## API compatibility check

SYNAXON extends its API from time to time. Your application can ask whether
the installed library still covers it:

```php
use miralsoft\synaxon\api\Compat\ApiCompatibility;

$report = ApiCompatibility::fromConfig($config)->compare();

if ($report->hasBreakingDrift()) {
    // operations or schemas this library uses were removed upstream:
    // $report->removedOperations, $report->removedSchemas
} elseif (!$report->isCompatible()) {
    // the API offers more than this version supports; nothing breaks:
    // $report->missingOperations, $report->missingSchemas
}
```

The library never runs this on its own. It fetches the spec, which is public
and needs no credentials, only when you call `compare()` or `fetchSpecJson()`.
When to check and whom to tell is up to your application, for example a
weekly job in your monitoring. `ApiCompatibility::compareSpec($spec)` compares
a spec you already have without network access, and `$report->toArray()`
gives the full result for logs or alerts. A response that is not a JSON
OpenAPI document raises `UnexpectedResponseException`, a network failure a
`TransportException`.

---

## What this library does not do

- **No telemetry, no background activity.** It contacts only the configured
  `baseUri`, and only when you call it. Nothing is sent to MIRAL Soft or
  anyone else.
- **No login, token refresh or credential storage.** It sends the credential
  you give it as the `Authorization` header. It never writes credentials to
  disk, caches tokens or runs an OAuth flow.
- **No caching of API data.** Every call goes to the API.
- **No automatic repeat of creating or changing calls after an upstream
  failure** (see [retries](#error-handling-and-retries)).
- **No relaxed TLS.** Certificate verification cannot be switched off.

---

## Examples

[`examples/`](examples/) holds five runnable scripts: quick start, listing
customers with DTOs, pagination, error handling, and request builders. See
[examples/README.md](examples/README.md) for how to run them.

## Versioning and upgrading

The library follows [Semantic Versioning](https://semver.org); every release
is described in the [CHANGELOG](CHANGELOG.md). Its public API (all public
classes and method signatures) is guarded by a test, so a breaking change can
only ship in a major version.

**From 1.x to 2.0** (details under "Breaking" and "Changed (behaviour)" in the
CHANGELOG):

- PHP 8.4 is required.
- Methods and DTOs follow the current API: seven new resources; operations and
  schemas that SYNAXON removed are gone; `auth()->getApiToken()` is now
  `auth()->createApiSession()`.
- `PaginationIterator` starts at page `0`; with 1.x the first page was skipped.
- Missing required fields throw `UnexpectedResponseException`; lists in query
  parameters are sent as repeated keys and booleans as `true` / `false`.

---

## Security

Please report vulnerabilities privately as described in
[SECURITY.md](SECURITY.md), not in a public issue.

- TLS verification is always on; the base URI must be `https` (except for
  loopback hosts used by local mocks).
- Credentials are hidden from `var_dump()`, logs and stack traces
  (`#[\SensitiveParameter]`) and never quoted in exception messages.
- Callers cannot override the `Authorization` or `Host` header.
- Path parameters are URL-encoded; `.` and `..` are rejected, so an ID can
  never redirect a request to another endpoint.
- Error bodies kept in exceptions are truncated to 4 KiB.
- Timeouts (max 600 s), retries (max 10) and every backoff (max 30 s) are bounded.
- Dependencies start at the first versions without published advisories, and
  CI runs `composer audit` on every change.

---

## Development

```bash
composer install
composer test                  # unit tests, never touch the network
composer test:integration      # live, read-only tests (needs tests/.env.test)
composer ci                    # every gate CI runs
```

`composer ci` runs the content check (house style and secrets), PHP-CS-Fixer,
PHPStan level 8, the unit tests, the reproducibility check for generated code
and `composer audit`. CI runs the same on PHP 8.4 and 8.5 with Guzzle 8 and on
PHP 8.4 with Guzzle 7, and checks that the package contains no development
files.

**Generated code.** `src/DTO/`, `src/Resource/*Resource.php`,
`src/Client/SynaxonClient.php`, `src/Compat/ApiSurface.php` and the tests in
`tests/Unit/Resource/` and `tests/Integration/ReadOnly/` are generated from
`docs/openapi.json` and never edited by hand. When SYNAXON changes its API:

```bash
composer update-spec      # fetch the live spec into docs/openapi.json
composer generate         # regenerate everything that derives from it
composer ci               # check:generated also lists stale files to delete
composer public-api       # only after recording an intended API change in the CHANGELOG
```

`tests/Unit/PublicApiTest.php` compares every public method signature with
`tests/Fixtures/public-api.txt`, so a rename never slips through unnoticed.

**Integration tests** run only when `tests/.env.test` holds credentials
(`cp tests/.env.test.example tests/.env.test`). With client credentials they
fetch a token and cache it in `tests/.bearer-token.cache` (gitignored, owner
only). They are strictly read-only: every request passes through a transport
that refuses anything but `GET` and `HEAD` before it is sent. Endpoints whose
answer depends on data or settings in your tenant are skipped with a reason.

**Layout**

```
src/
├── Client/      SynaxonClient (generated)
├── Compat/      ApiCompatibility, CompatibilityReport, ApiSurface (generated)
├── Config/      SynaxonConfig
├── DTO/         341 DTOs (generated) + AbstractDto
├── Exception/   typed exceptions
├── Http/        GuzzleHttpClient + HttpClientInterface
├── Query/       QueryBuilder
├── Resource/    28 resources (generated) + AbstractResource
├── Util/        PathBuilder, DtoHydrator, PaginationIterator
└── Version.php  the library version
bin/             generators, checks and maintenance scripts (not shipped)
docs/            openapi.json, the SYNAXON spec (not shipped)
tests/           unit, integration and support code (not shipped)
```

---

## License

[MIT](LICENSE) © MIRAL Soft. SYNAXON and the names of the managed services are
trademarks of their respective owners.
