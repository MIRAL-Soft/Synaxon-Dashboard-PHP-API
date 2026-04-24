<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Integration\ReadOnly;

use miralsoft\synaxon\api\Tests\Integration\IntegrationTestCase;

/**
 * Read-only smoke tests for all GET /v1/reports/* endpoints.
 *
 * Generated from the OpenAPI spec. Every test invokes the upstream
 * endpoint and asserts that the response is not an error. Endpoints
 * that require a sample ID draw it from the list endpoint for the
 * same resource.
 */
final class ReportsReadTest extends IntegrationTestCase
{
    /**
     * Get partner report setting
     *
     * @synaxon-endpoint GET /v1/reports/setting
     */
    public function testFindPartnerReportSettingHttpControllerGetPartnerReportSetting(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->reports()->getPartnerReportSetting();
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/reports/setting');
    }

    /**
     * Generate partner report PDF
     *
     * @synaxon-endpoint GET /v1/reports/pdf
     */
    public function testGenerateReportHttpControllerGeneratePartnerReport(): void
    {
        $this->assertReadOnly('GET');
        self::markTestSkipped('Returns PDF; requires targeted test fixture rather than a smoke call.');
    }
}
