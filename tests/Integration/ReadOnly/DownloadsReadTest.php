<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Integration\ReadOnly;

use miralsoft\synaxon\api\Tests\Integration\IntegrationTestCase;

/**
 * Read-only smoke tests for all GET /v1/downloads/* endpoints.
 *
 * Generated from the OpenAPI spec. Every test invokes the upstream
 * endpoint and asserts that the response is not an error. Endpoints
 * that require a sample ID draw it from the list endpoint for the
 * same resource.
 */
final class DownloadsReadTest extends IntegrationTestCase
{
    use EndpointSamplingTrait;

    /**
     * Find download files by tenant
     *
     * @synaxon-endpoint GET /v1/downloads
     */
    public function testFindDownloadFilesHttpControllerListDownloads(): void
    {
        $this->assertReadOnly('GET');
        $response = $this->client->downloads()->list([]);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/downloads');
    }

    /**
     * Get file by ID
     *
     * @synaxon-endpoint GET /v1/downloads/{id}
     */
    public function testFindDownloadFileByIdHttpControllerGetDownload(): void
    {
        $this->assertReadOnly('GET');
        $id = $this->sampleId(
            'downloads:/v1/downloads',
            fn () => $this->client->downloads()->list(['limit' => 1]),
        );
        $response = $this->client->downloads()->find($id);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/downloads/{id}');
    }

    /**
     * Get presigned URL or direct link for a download file
     *
     * @synaxon-endpoint GET /v1/downloads/{id}/url
     */
    public function testGetDownloadFileUrlHttpControllerGetDownloadUrl(): void
    {
        $this->assertReadOnly('GET');
        $id = $this->sampleId(
            'downloads:/v1/downloads',
            fn () => $this->client->downloads()->list(['limit' => 1]),
        );
        $response = $this->client->downloads()->getDownloadUrl($id);
        self::assertNotNull($response, 'Expected a non-null response from GET /v1/downloads/{id}/url');
    }
}
