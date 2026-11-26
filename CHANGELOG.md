# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [2.0.0] - 2026-11-25

### Breaking
- **PHP 8.4 is the minimum** (was 8.3). CI runs on PHP 8.4 and 8.5.
- **Generated from the current SYNAXON spec** (186 operations, 341 schemas;
  previously 140 and 257 from spec 1.9.2). Removed upstream, and therefore
  removed here:
  - `UsersResource::listPendingTerms()`, `UsersResource::acceptTerms()`
  - `CustomersResource::createCustomerReference()`,
    `CustomersResource::removeCustomerReference()`
  - DTOs `AcceptTermRequestDto`, `CreateCustomerReferenceRequestDto`,
    `LayoutItemResponseDto`, `MetricsGroupedResponseDto`,
    `MetricsLatestResponseDto`, `NSightClientsResponseDto`,
    `NSightClientsPaginatedResponseDto`, `PendingTermResponseDto`,
    `PusherChannelAuthDto`, `PusherUserAuthDto`, `RefreshTokenRequestDto`,
    `SalesOpportunityResponseDto`, `SalesOpportunityPaginatedResponseDto`,
    `SalesOpportunityRecommendationStatsDto`. Most have a successor under a
    new upstream name, for example `SalesOpportunitiesResponseDto`,
    `NSightClientResponseDto`, `LayoutItemDto`, `GroupedMetricsResponseDto`.
- `AuthResource::getApiToken()` is now `createApiSession()`, following the
  renamed upstream operation.
- `GET /v1/notifications/unread` no longer takes `providerId` upstream.

### Added
- **`Compat\ApiCompatibility`**: applications can check whether the installed
  library still covers the SYNAXON API. `compare()` fetches the public spec
  (only when called; no credentials, no background activity) and returns a
  `CompatibilityReport` with missing and removed operations and schemas,
  `isCompatible()` and `hasBreakingDrift()`. `compareSpec()` works offline on
  a spec you already have. The implemented surface comes from the generated
  `Compat\ApiSurface` constants, not from docblocks, so it also works with
  `opcache.save_comments=0`. `bin/check-api-compat.php`, `composer
  update-spec` and the live test use the same class.
- `SynaxonApiException::getErrorCode()`: the API's machine-readable error
  code, for example `GENERIC.VALIDATION_ERROR`.
- Seven new resources: `billing()`, `cloudally()`, `cove()`,
  `cyansecurity()`, `guardian360()`, `rollouter()`, `smao()`.
- New operations on existing resources: API tokens and the GB sign-in flow
  (`auth()`), customer import (`customers()->importCustomers()`), ESET
  products, raw Mailstore and N-sight pass-through (`invokeRawApi()`), patch
  targets and bulk deployment (`patches()`), tenant SMTP configuration
  (`tenants()`), and the `managementType` filter on Acronis, ESET and Lywand
  customer lists.
- **Guzzle 8 support** next to Guzzle 7 (`^7.16.5 || ^8.5.5`); CI tests both.
- `SynaxonConfig` option `acceptLanguage` (env `SYNAXON_ACCEPT_LANGUAGE`),
  sent as `Accept-Language` with every request. The spec declares the header
  on 140 operations.
- `composer update-spec` (`bin/update-spec.php`) fetches the live OpenAPI
  document into `docs/openapi.json`.

### Tooling (development only)
- PHPUnit 12 (tests use attributes instead of doc annotations), PHPStan 2,
  which now also analyses the generated DTOs at level 8; the DTO generator
  emits precise list types and no dead `instanceof` checks.
- Dependency floors raised again to the first releases without published
  advisories: Guzzle 7.16.5 / 8.5.5, PSR-7 2.13.4 / 3.6.
- Generated read tests pass the spec's example values for required query
  parameters; tenant-dependent endpoints (no SMTP configuration, missing
  permission for raw pass-through) are skipped with a reason instead of
  failing.
- `docs/swagger-ui-init.js` removed: SYNAXON no longer publishes the spec
  that way.
- README rewritten for people who find the package: what the API covers per
  resource, how to obtain a bearer token (client credentials work only at
  the token endpoint, verified on the live API), return values, file
  downloads and uploads, asynchronous operations (report generation answers
  with a task ID), the full exception set, and upgrading from 1.x. Every
  read-only example was run against the live API.
- The live suite checks file endpoints (CSV, PDF, tenant logo) for a file
  response, and no longer calls the report-generation GETs, which start a
  task upstream on every call.
- The generators load the spec through one guard: descriptions cannot end a
  docblock (`*/`), and schema names, operationIds, paths and path parameters
  must be valid before any code is written.
- `composer update-spec` keeps empty JSON objects as `{}`; it wrote `[]`,
  which is not valid OpenAPI.
- The live integration suite sends every request through a read-only
  transport that refuses anything but GET and HEAD before it is sent.
- `tests/Unit/PublicApiTest` compares the public API with the approved list
  in `tests/Fixtures/public-api.txt` (`composer public-api` to approve). A
  `self` type is written as the class name, so PHP 8.4 and 8.5 (which
  resolves `self` in reflection) produce the same list.
- No use of `DATE_RFC7231`, which PHP 8.5 deprecates; PHPUnit shows the
  source of any deprecation in its output.
- PHP-CS-Fixer also checks `AbstractDto` and the DTO tests.
- The release workflow extracts the release notes with a plain prefix match;
  the previous awk regex matched no section, so a release would have been
  published with the fallback text (and, with the new empty-section check,
  refused).
- Integration tests sample ids from `.../fromContext` where no list endpoint
  exists, so partner metrics, the CloudAlly partner and the tenant logo are
  read live instead of skipped.
- The release workflow refuses a tag whose commit is not on `main`, so only
  reviewed code can be released. Release tags are protected against moving
  and deletion, and releases are immutable once published.
- `SECURITY.md` and private vulnerability reporting; Dependabot keeps the
  pinned Actions and the lock file current (`.github/dependabot.yml`).
- `bin/check-content.php` applies the same secret patterns as the local
  pre-commit hook, including the password pattern. `docs/openapi.json`, the
  upstream spec whose schema fields are called `password`, is left out of the
  key and password patterns (never out of the private-key check) and named on
  every run.
- CI job names no longer contain an em-dash; the "Protect main" ruleset
  has to list the new names.

### Security
- **Minimum dependency versions raised** to `guzzlehttp/guzzle ^7.15.2` and
  `guzzlehttp/psr7 ^2.12.3`. The previous `^7.0` constraint still allowed
  releases with published advisories (host confusion, cookie scope, CRLF
  injection, proxy-credential leaks).
- **`POST` and `PATCH` are no longer repeated after a `5xx` or a connection
  error / timeout.** Such a request may already have taken effect upstream,
  so repeating it could create a duplicate record. `429` is still retried
  for every method, because the server refused the request before
  processing it. `GET`, `HEAD`, `OPTIONS`, `PUT` and `DELETE` keep the
  previous retry behaviour.
- `401` and `403` responses are logged at `warning` level
  (`synaxon.request.unauthorized`) instead of `debug`. The log context still
  carries no headers or credentials.

- **Path parameters `.` and `..` are rejected.** URI resolution removes dot
  segments, so an id of `..` turned
  `DELETE /v1/customers/{id}/references/{refId}` into
  `DELETE /v1/customers/{id}/`, a different endpoint.
- **`baseUri` must use https**; plain http is accepted only for `localhost`,
  `127.0.0.1` and `[::1]`, since every request carries the credential. User
  info, a query string or a fragment in `baseUri` are rejected.
- **Credentials and the User-Agent may not contain control characters or be
  empty strings.** A token with a trailing newline used to make PSR-7 throw
  an exception whose message quoted the whole `Authorization` header. Such
  PSR-7 errors are now wrapped in a `TransportException` that quotes nothing.
- Credential parameters of `SynaxonConfig` carry `#[\SensitiveParameter]`, so
  they no longer appear in stack traces.
- Setting a bearer token and basic credentials together is rejected instead
  of silently preferring the token; `fromEnv()` ignores the basic variables
  when `SYNAXON_BEARER_TOKEN` is set.

### Changed (behaviour; review before upgrading)
- **`PaginationIterator` starts at page `0`.** The API counts pages from 0
  (measured on the live API); starting at 1, as before, silently skipped the
  first page. Callers who pass `startPage` explicitly are unaffected.
- **Getters of required scalar fields throw `UnexpectedResponseException`**
  when the field is missing or null, instead of raising an "Undefined array
  key" warning and returning `''`, `0` or `false`.
- Query parameters follow the spec's encoding: lists as repeated keys
  (`status=a&status=b` instead of `status[0]=a&status[1]=b`), booleans as
  `true` / `false` instead of `1` / `0`.
- Request bodies use the content type the operation declares:
  `AuthResource::getApiToken()` sends `x-www-form-urlencoded` (verified on the
  live API), `TenantsResource::updateLogo()` sends `multipart/form-data`, so a
  logo upload is possible at all. An empty JSON body is sent as `{}`, not `[]`.
- `AuthResource::callback()` sends `scope` as a query parameter; it was
  accepted and silently dropped.
- Fields the spec declares as required **and** nullable (for example
  `MetricValueDto::getPrev()`, "null if no previous data", and the
  `customerId` of the stats items) return `null` instead of throwing; only a
  missing key raises `UnexpectedResponseException`.
- A retried multipart upload sends the file again; it failed on the second
  attempt because the stream was already consumed. Uploads from streams that
  cannot be rewound are not retried.
- An injected Guzzle client no longer bypasses error mapping and retries;
  `http_errors` is disabled per request.
- A `429` whose `Retry-After` exceeds the 30-second backoff cap is reported
  at once instead of blocking for minutes and failing anyway. `Retry-After`
  also accepts the RFC 850 and asctime date forms.
- Query floats keep full precision without E-notation; keyed arrays as query
  values are rejected instead of losing their keys.
- `redactHeaders()` also masks `Proxy-Authorization`, `Set-Cookie`,
  `X-Auth-Token` and any header named like a token, key or secret.
- An empty file (for example a CSV export without rows, which the API sends
  as `200 text/csv` with no bytes) is returned as
  `['_raw' => '', '_contentType' => 'text/csv']` instead of `null`; `null`
  stays for responses without content.
- `ValidationException::getErrors()` returns the API's `subErrors` (one line
  per rejected field). It read keys the API does not send and was always
  empty.
- `RateLimitException::getRetryAfter()` returns `null` when the server sent
  no usable `Retry-After`, instead of `0` (which read as "retry now"), and
  understands the HTTP-date form.
- `QueryBuilder`: new `search()`; `with()` accepts lists. `offset()` and
  `where()` are deprecated because no endpoint declares `offset` or `filter`.

### Changed
- The default `User-Agent` is now derived from the new `Version::VERSION`
  constant (`miralsoft-synaxon-api/1.1.0`). It previously said `/1.0`
  regardless of the installed version.
- The installable package no longer contains `tests/`, `docs/`, `bin/`,
  `config/`, `examples/` or build tooling (`.gitattributes` export-ignore).
  The upstream spec bundle alone was about 950 KB.
- Generated resource docblocks join summary and description as two
  sentences.

### Fixed
- `bin/check-api-compat.php --live` and the live compatibility test failed
  with "swaggerDoc not found": SYNAXON now serves the OpenAPI document as
  `swagger/marketplace-openapi.json`. Both read it through the shared
  `tests/Support/LiveSpec`, which accepts the response only when it is JSON
  and contains an OpenAPI `paths` object.

### Added
- `composer generate` runs all four generators in dependency order;
  `composer check:generated` reruns them and fails when the committed output
  differs, when a generated file is missing, or when a stale one is left over.
- `composer check:content` scans tracked files for em-dashes in prose and for
  secret-like strings. Both checks prove on every run that their detectors
  can fire.
- `composer ci` now also runs `check:content`, `check:generated` and
  `composer audit`.
- `tests/Unit/DTO/SpecExampleHydrationTest` hydrates every DTO with the
  example values published in the OpenAPI document and checks each getter's
  value and type.
- `tests/Unit/VersionTest` keeps `Version::VERSION`, the newest released
  CHANGELOG section and the default User-Agent in step.
- README sections on what the library does not do, the retry matrix per
  HTTP method, and a trademark and non-affiliation notice.

### Tooling
- GitHub Actions are pinned to commit digests (checkout v7.0.1,
  setup-php 2.40.0, cache v6.1.0, action-gh-release v3.0.4) and run on
  `ubuntu-24.04`. CI installs from the now committed `composer.lock`,
  caches on its hash, and checks the package archive for development files.
- The release workflow refuses a tag that does not match `Version::VERSION`
  or has no non-empty CHANGELOG section, and only its job may write.
- `.gitattributes` enforces LF line endings so generator output compares
  byte for byte on every platform.
- PHP-CS-Fixer no longer reformats the generated tests (its exclusions did
  not match); the generators emit formatter-clean code themselves.
- Em-dashes removed from documentation, comments, generator templates and
  generated output.
- The release workflow runs `composer ci` on the tagged commit before it
  publishes anything.
- `bin/check-generated.php` plants its self-test change on disk, so the test
  proves that the generators rewrite the file and the comparison sees it.
- Generated write tests use path ids that need percent-encoding, assert the
  body format, and cannot produce duplicate test names.
- `bin/check-content.php` also flags password assignments.
- `tests/Support/TokenCache` keys the cached token by client and scope and
  creates the cache file with owner-only permissions from the first byte.
- `bin/live-data-dump.php` exits with a message instead of a `TypeError`
  when no credentials are configured.
- README: the quick start called a method that does not exist
  (`notifications()->create()`); it now uses `fromEnv()` and a real method.

## [1.1.0] - 2026-04-23

### Added
- **Correlation-ID surfacing.** Every `SynaxonApiException` now exposes
  `getCorrelationId(): ?string`. `GuzzleHttpClient` extracts the
  identifier from the API's error JSON body (`correlationId`) and, as a
  fallback, from `X-Correlation-Id` / `X-Request-Id` response headers.
  Catch blocks can forward the ID to support to make bug reports
  immediately actionable upstream.
- **Immutable fluent builders for every request DTO.** `*RequestDto`
  classes now expose typed `with*()` setters that return a new
  instance per call, plus `withAll(array $patch): static` for batch
  updates on the new `AbstractDto` base.
- **`@phpstan-type` aliases** for the four recurring response shapes
  (paginated, single object, raw binary, JSON scalar) and the API
  error body (see `src/PHPStanTypes.php`).
- **Offline write-test suite** generated by
  `bin/generate-write-tests.php`: 56 unit tests across 16 resource
  classes assert that every POST / PUT / PATCH / DELETE method emits
  the correct HTTP verb, path, body and query against `MockHttpClient`.
- **`examples/` directory** with five self-contained scripts:
  quickstart, list customers, pagination, error handling, builder
  pattern.
- **GitHub Actions CI workflow** (`.github/workflows/ci.yml`) running
  `composer ci` on PHP 8.3 and 8.4 for every push / pull request to
  `main` and `API-v1`.
- **`composer ci` aggregator script** plus `fmt` / `fmt:check` for
  PHP-CS-Fixer integration.
- **PHP-CS-Fixer** as a dev dependency with a project-level
  `.php-cs-fixer.dist.php` config (PSR-12 + PHP 8.3 migration ruleset,
  generated DTO/Resource files excluded so the formatter does not
  fight the code generator).

### Security
- `SynaxonConfig::__debugInfo()` now masks the basic-auth **user** as
  well as the password (reported as `basic:***`). In the OAuth2
  client-credentials flow the user half is a client identifier and
  leaking it makes a brute-force of the paired secret easier.
- `GuzzleHttpClient` now strips caller-supplied `Authorization` and
  `Host` headers from request options before merging them with the
  library-managed defaults. A resource method can no longer smuggle
  an alternate credential through the public HTTP contract.
- `SynaxonConfig` now rejects base URIs that are not valid http(s)
  URLs (`ftp://`, `file://`, malformed strings).
- Retry behaviour is hardened against pathological server responses:
  both exponential backoff and `Retry-After` values are capped at
  30 seconds per sleep, and total retries are bounded by a new
  `SynaxonConfig::MAX_RETRIES` constant (10). This prevents a
  malicious or broken server from pinning a process indefinitely.
- Timeouts are bounded by `SynaxonConfig::MAX_TIMEOUT_SECONDS` (600 s).
- Error response bodies attached to exception context are truncated to
  4 KiB, preventing an oversize 5xx HTML payload from ballooning
  the in-memory exception (and any logger that serialises it).
- `tests/.bearer-token.cache` is now written with `LOCK_EX` and
  `chmod 0600` so the cached bearer token is readable only by the
  owner on filesystems that honour Unix permissions.
- `PathBuilder::expand()` now surfaces PCRE engine failures as
  `InvalidArgumentException` rather than silently returning an
  empty string.

### Fixed
- `PaginationIterator` now terminates cleanly on non-array returns
  from the fetch closure (rather than producing a cryptic TypeError),
  validates its constructor arguments, and aborts with a clear
  exception if a pathological server never returns a short page
  (`MAX_PAGES = 100_000`).

### Added
- `tests/Unit/Http/GuzzleHttpClientTest` covers bearer-header
  injection, auth-header override protection, retry-on-429,
  no-retry on 4xx, oversize-body truncation, header redaction, and
  the non-JSON / JSON-scalar response wrappers.
- `tests/Unit/Util/PaginationIteratorTest` covers happy-path
  walking, short-page termination, non-array fetch return, invalid
  constructor arguments, and the MAX_PAGES circuit breaker.
- Additional `SynaxonConfig` tests for URL validation, scheme
  enforcement, timeout/retry caps, and non-scalar coercion in
  `fromArray()`.

### Changed
- Removed the `SYNAXON_INTEGRATION` master switch from the integration
  test suite. Integration tests now skip automatically when
  `tests/.env.test` contains no credentials. Having PHPUnit's separate
  `Integration` test suite, the `assertReadOnly()` guard, and the
  auto-skip on missing credentials already provides sufficient defence
  in depth; the extra flag was redundant and added friction.
- `GuzzleHttpClient::decodeBody()` now tolerates two response shapes
  the original implementation rejected:
  - **Non-JSON payloads** (CSV exports, PDF documents, installer
    binaries) are wrapped as `['_raw' => string, '_contentType' => string]`
    so the resource methods keep their `array|null` return contract.
  - **JSON scalar payloads** (e.g. boolean `true` / `false` from the
    alias-availability endpoint) are wrapped as `['value' => mixed]`.

### Added
- `tests/Support/TokenCache`: test-only helper that exchanges
  `SYNAXON_BASIC_USER` / `SYNAXON_BASIC_PASS` for a bearer token via
  `POST /v1/auth/token` and caches the result to
  `tests/.bearer-token.cache` (gitignored) until it expires. This mirrors
  how Synaxon's own dashboard authenticates. The library itself stays
  auth-agnostic; the helper is part of the test harness only.
- `testConfig::resolveBearerConfig()`: single entry point that returns
  a ready-to-use bearer-authenticated `SynaxonConfig`, transparently
  using a supplied bearer token or the Basic → Bearer exchange as
  appropriate.
- `bin/generate-integration-read-tests.php`: one-shot generator that
  emits a read-only smoke test for every GET endpoint in the spec, one
  PHPUnit test class per resource. Endpoints with `{id}` path
  parameters obtain a sample ID from the matching list endpoint via
  the new `EndpointSamplingTrait`.
- `tests/Integration/ReadOnly/EndpointSamplingTrait.php` caches the
  first sample ID per (test class, list endpoint) so the list call is
  issued at most once per suite run.
- `tests/Integration/ReadOnly/{Resource}ReadTest.php`: 84 generated
  tests across 20 resource classes, providing live regression coverage
  for every readable endpoint the spec exposes.
- `bin/live-data-dump.php`: developer diagnostic script that issues
  one representative read call per resource and prints the response in
  a compact tree. Uses `tests/.env.test` credentials. Not part of the
  automated test suite; kept in `bin/` as a troubleshooting helper.


## [1.0.0] - 2026-04-23

### Added
- Initial public release of the SYNAXON Marketplace PHP API client.
- `SynaxonClient` facade with fluent factories for 21 resource groups
  (acronis, audit, auth, customers, downloads, eset, layout, lywand,
  mailstore, n-sight, notifications, patches, products, pusher, reports,
  sales-opportunities, sec-auditor, support, system-tasks, tenants, users).
- Full coverage of all 140 active operations from SYNAXON Marketplace API
  v1.9.2 (84 GET / 28 POST / 16 PATCH / 11 DELETE / 1 PUT).
- 257 typed DTO classes generated from the OpenAPI components/schemas
  block, with round-trip JSON support and tolerant unknown-field handling.
- `SynaxonConfig` with three construction paths (constructor / `fromEnv()`
  / `fromArray()`) and built-in credential masking.
- Bearer and HTTP basic authentication; mutually exclusive with validation
  at construction time.
- `GuzzleHttpClient` HTTP layer with:
  - TLS verification always on
  - Configurable timeouts
  - Exponential backoff with jitter on 429 / 5xx responses
  - Sensitive-header redaction in logs
- Typed exception hierarchy: `SynaxonApiException`,
  `AuthenticationException`, `NotFoundException`, `RateLimitException`,
  `ValidationException`, `ServerException`, `TransportException`.
- `QueryBuilder` with `FilterOperator` enum (`EQ`, `NEQ`, `GT`, `GTE`,
  `LT`, `LTE`, `ILIKE`, `IN`).
- `PaginationIterator` for cursor-style traversal of paginated endpoints.
- `PathBuilder` for safe URI templating (rejects empty/missing parameters,
  URL-encodes values).
- PSR-3 logging support via the optional `LoggerInterface` constructor
  argument.
- `bin/generate-dtos.php` and `bin/generate-resources.php` one-shot code
  generators (committed for reproducibility, never executed at runtime).
- `bin/check-api-compat.php` standalone compatibility checker with
  `--live` and `--snapshot` modes.
- `tests/Unit/ApiCompatibilityTest` ensures spec ↔ implementation parity
  on every unit-test run.
- `tests/Integration/LiveCompatibilityTest` performs the same diff against
  the upstream live spec when integration tests are enabled.
- `tests/Integration/ReadOnly/` smoke tests for live read-only endpoints.
- `IntegrationTestCase::assertReadOnly()` guard prevents any accidental
  mutating call against live data.
- PHPStan level 8 configuration (`phpstan.neon`).
- PHPUnit 10 configuration with separate `Unit` and `Integration` test
  suites; integration suite is excluded from `composer test`.
- README, CHANGELOG, MIT license, and `.gitignore`.

### Notes
- Empty/placeholder paths declared in the spec but missing HTTP operations
  (e.g. `/v1/health`, `/v1/audit/plain`) are intentionally not generated.
  They will appear automatically once the upstream spec defines them and
  the generators are re-run.
- Authentication is the responsibility of the consuming application;
  this library never acquires tokens on its own.

[Unreleased]: https://github.com/MIRAL-Soft/Synaxon-Dashboard-PHP-API/compare/v2.0.0...HEAD
[2.0.0]: https://github.com/MIRAL-Soft/Synaxon-Dashboard-PHP-API/compare/v1.1.0...v2.0.0
[1.1.0]: https://github.com/MIRAL-Soft/Synaxon-Dashboard-PHP-API/compare/v1.0.0...v1.1.0
[1.0.0]: https://github.com/MIRAL-Soft/Synaxon-Dashboard-PHP-API/releases/tag/v1.0.0
