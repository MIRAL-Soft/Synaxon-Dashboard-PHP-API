# Examples

Self-contained snippets that demonstrate the most common usage patterns
of the SYNAXON Marketplace PHP API client.

| Script | What it does |
| ------ | ------------ |
| [`01-quickstart.php`](01-quickstart.php)        | Build a client with a bearer token and read the current user. |
| [`02-list-customers.php`](02-list-customers.php) | List customers and hydrate the response into a typed DTO. |
| [`03-pagination.php`](03-pagination.php)        | Walk every customer using `PaginationIterator`. |
| [`04-error-handling.php`](04-error-handling.php) | Catch the typed exception hierarchy + use `getCorrelationId()`. |
| [`05-builder-pattern.php`](05-builder-pattern.php) | Build a request payload using the immutable fluent `with*()` setters. |

## How to run

All scripts read credentials from environment variables:

```bash
export SYNAXON_BEARER_TOKEN=...           # preferred
# or
export SYNAXON_BASIC_USER=...
export SYNAXON_BASIC_PASS=...

php examples/01-quickstart.php
```

The `05-builder-pattern.php` script does no network call — it can be
run without any credentials.
