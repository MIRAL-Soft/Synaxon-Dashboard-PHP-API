<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Integration\ReadOnly;

use miralsoft\synaxon\api\Tests\Integration\IntegrationTestCase;

/**
 * Read-only smoke tests for all GET /v1/billing/* endpoints.
 *
 * Generated from the OpenAPI spec. Every test invokes the upstream
 * endpoint and asserts that the response is not an error. Endpoints
 * that require a sample ID draw it from the list endpoint for the
 * same resource.
 */
final class BillingReadTest extends IntegrationTestCase
{
    /**
     * Retrieve all API keys of the partner No.
     *
     * @synaxon-endpoint GET /v1/billing/neumeier
     */
    public function testFindNeumeierApiKeysByPartnerNoHttpControllerListNeumeierApiKeys(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->billing()->listNeumeierApiKeys();
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/billing/neumeier');
    }
}
