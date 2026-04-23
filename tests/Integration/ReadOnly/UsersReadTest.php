<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Integration\ReadOnly;

use miralsoft\synaxon\api\Tests\Integration\IntegrationTestCase;

/**
 * Read-only smoke tests for all GET /v1/users/* endpoints.
 *
 * Generated from the OpenAPI spec. Every test invokes the upstream
 * endpoint and asserts that the response is not an error. Endpoints
 * that require a sample ID draw it from the list endpoint for the
 * same resource.
 */
final class UsersReadTest extends IntegrationTestCase
{
    /**
     * Get pending terms
     *
     * @synaxon-endpoint GET /v1/users/terms/pending
     */
    public function testFindPendingTermsHttpControllerListPendingTerms(): void
    {
        $this->assertReadOnly('GET');
        try {
            $response = $this->client->users()->listPendingTerms();
            self::assertNotNull($response, 'Expected a non-null response from GET /v1/users/terms/pending');
        } catch (\miralsoft\synaxon\api\Exception\ServerException $e) {
            self::markTestIncomplete('Upstream returns HTTP 500 as of SYNAXON Marketplace API v1.9.2.' . ' Last error: ' . $e->getMessage());
        }
    }
}
