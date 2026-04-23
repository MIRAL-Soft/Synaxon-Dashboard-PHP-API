# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

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
- `tests/Support/TokenCache` — test-only helper that exchanges
  `SYNAXON_BASIC_USER` / `SYNAXON_BASIC_PASS` for a bearer token via
  `POST /v1/auth/token` and caches the result to
  `tests/.bearer-token.cache` (gitignored) until it expires. This mirrors
  how Synaxon's own dashboard authenticates. The library itself stays
  auth-agnostic — the helper is part of the test harness only.
- `testConfig::resolveBearerConfig()` — single entry point that returns
  a ready-to-use bearer-authenticated `SynaxonConfig`, transparently
  using a supplied bearer token or the Basic → Bearer exchange as
  appropriate.
- `bin/generate-integration-read-tests.php` — one-shot generator that
  emits a read-only smoke test for every GET endpoint in the spec, one
  PHPUnit test class per resource. Endpoints with `{id}` path
  parameters obtain a sample ID from the matching list endpoint via
  the new `EndpointSamplingTrait`.
- `tests/Integration/ReadOnly/EndpointSamplingTrait.php` — caches the
  first sample ID per (test class, list endpoint) so the list call is
  issued at most once per suite run.
- `tests/Integration/ReadOnly/{Resource}ReadTest.php` — 84 generated
  tests across 20 resource classes, providing live regression coverage
  for every readable endpoint the spec exposes.
- `bin/live-data-dump.php` — developer diagnostic script that issues
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

[Unreleased]: https://github.com/MIRAL-Soft/Synaxon-Dashboard-PHP-API/compare/v1.0.0...HEAD
[1.0.0]: https://github.com/MIRAL-Soft/Synaxon-Dashboard-PHP-API/releases/tag/v1.0.0
