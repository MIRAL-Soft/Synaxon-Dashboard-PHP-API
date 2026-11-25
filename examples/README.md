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

The scripts read a bearer token from the environment:

```bash
export SYNAXON_BEARER_TOKEN=...
php examples/01-quickstart.php
```

The API accepts your client ID and secret only at the token endpoint; how to
exchange them for a bearer token is shown in the main README under
"Authentication". All scripts only read data.

The `05-builder-pattern.php` script does no network call, so it can be
run without any credentials.
