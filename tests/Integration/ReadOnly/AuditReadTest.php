<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Integration\ReadOnly;

use miralsoft\synaxon\api\Tests\Integration\IntegrationTestCase;

/**
 * Read-only smoke tests for all GET /v1/audit/* endpoints.
 *
 * Generated from the OpenAPI spec. Every test invokes the upstream
 * endpoint and asserts that the response is not an error. Endpoints
 * that require a sample ID draw it from the list endpoint for the
 * same resource.
 */
final class AuditReadTest extends IntegrationTestCase
{
    /**
     * List audit logs
     *
     * @synaxon-endpoint GET /v1/audit/logs
     */
    public function testFindAuditLogsHttpControllerListAuditLogs(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->audit()->listAuditLogs([]);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/audit/logs');
    }

    /**
     * Get audit log options
     *
     * @synaxon-endpoint GET /v1/audit/logs/options
     */
    public function testFindAuditLogOptionsHttpControllerFindAuditLogOptions(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->audit()->findAuditLogOptions();
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/audit/logs/options');
    }
}
