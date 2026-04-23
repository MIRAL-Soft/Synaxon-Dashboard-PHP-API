<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Integration\ReadOnly;

use miralsoft\synaxon\api\Tests\Integration\IntegrationTestCase;

/**
 * Read-only smoke test for /v1/audit/* endpoints against the live API.
 */
final class AuditReadTest extends IntegrationTestCase
{
    public function testListAuditLogs(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->audit()->listAuditLogs(['limit' => 1]);
        self::assertNotNull($response);
    }

    public function testFindAuditLogOptions(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->audit()->findAuditLogOptions();
        self::assertNotNull($response);
    }
}
