<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Resource;

/**
 * Products resource — wraps all /v1/products/* endpoints.
 *
 * This class is generated from the OpenAPI specification. Method names follow
 * REST conventions where the endpoint shape permits; otherwise the suffix of
 * the upstream operationId is used to preserve semantic meaning.
 */
class ProductsResource extends AbstractResource
{
    /**
     * Get available managed services
     *
     * @synaxon-endpoint GET /v1/products/available
     * @synaxon-operation-id GenerateProductOverviewHttpController_getAvailable
     * @return array<string, mixed>|list<mixed>|null Decoded JSON response body.
     */
    public function getAvailable(): array|null
    {
        return $this->httpGet($this->expand('/v1/products/available'));
    }
}
