# Security policy

## Supported versions

| Version | Supported |
| ------- | --------- |
| 2.x     | yes       |
| 1.x     | no        |

Security fixes are released for the latest 2.x version only.

## Reporting a vulnerability

Please report security problems privately, not in a public issue:
use **Report a vulnerability** on the repository's
[Security tab](https://github.com/MIRAL-Soft/Synaxon-Dashboard-PHP-API/security/advisories/new).

Helpful details:

- the affected version and how the library is configured (without credentials),
- the steps or a minimal script that shows the problem,
- what an attacker can achieve with it.

You will get an answer within five working days. Once a fix is released, the
advisory is published with credit to the reporter, unless you prefer otherwise.

## Scope

In scope is this library: request building, authentication headers, retries,
error handling, logging and the generated DTOs and resources. Vulnerabilities
in the SYNAXON Marketplace API itself are out of scope; please report those to
SYNAXON directly.

Never include real API credentials or customer data in a report.
