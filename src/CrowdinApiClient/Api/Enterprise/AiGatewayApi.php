<?php

declare(strict_types=1);

namespace CrowdinApiClient\Api\Enterprise;

use CrowdinApiClient\Api\AbstractApi;
use CrowdinApiClient\Http\ResponseDecorator\ResponseModelDecorator;
use CrowdinApiClient\Model\AiGatewayResponse;

/**
 * AI Gateway allows you to proxy requests to your AI provider through Crowdin,
 * giving you a single place to manage keys, monitor usage, and control access.
 *
 * @package Crowdin\Api
 */
class AiGatewayApi extends AbstractApi
{
    /**
     * AI Gateway GET
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.providers.gateway.enterprise.get API Documentation
     *
     * @param int $aiProviderId
     * @param string $path Raw provider API path after `/gateway/` (e.g. `chat/completions`)
     * @return AiGatewayResponse|null
     */
    public function gatewayGet(int $aiProviderId, string $path): ?AiGatewayResponse
    {
        $url = sprintf('ai/providers/%d/gateway/%s', $aiProviderId, $path);
        return $this->_get($url, AiGatewayResponse::class);
    }

    /**
     * AI Gateway POST
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.providers.gateway.enterprise.post API Documentation
     *
     * @param int $aiProviderId
     * @param string $path Raw provider API path after `/gateway/` (e.g. `chat/completions`)
     * @param array $data Request body forwarded to the AI provider
     * @return AiGatewayResponse|null
     */
    public function gatewayPost(int $aiProviderId, string $path, array $data): ?AiGatewayResponse
    {
        $url = sprintf('ai/providers/%d/gateway/%s', $aiProviderId, $path);
        return $this->_post($url, AiGatewayResponse::class, $data);
    }

    /**
     * AI Gateway PUT
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.providers.gateway.enterprise.put API Documentation
     *
     * @param int $aiProviderId
     * @param string $path Raw provider API path after `/gateway/` (e.g. `chat/completions`)
     * @param array $data Request body forwarded to the AI provider
     * @return AiGatewayResponse|null
     */
    public function gatewayPut(int $aiProviderId, string $path, array $data): ?AiGatewayResponse
    {
        $url = sprintf('ai/providers/%d/gateway/%s', $aiProviderId, $path);
        return $this->_put($url, AiGatewayResponse::class, $data);
    }

    /**
     * AI Gateway PATCH
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.providers.gateway.enterprise.patch API Documentation
     *
     * @param int $aiProviderId
     * @param string $path Raw provider API path after `/gateway/` (e.g. `chat/completions`)
     * @param array $data Request body forwarded to the AI provider
     * @return AiGatewayResponse|null
     */
    public function gatewayPatch(int $aiProviderId, string $path, array $data): ?AiGatewayResponse
    {
        $url = sprintf('ai/providers/%d/gateway/%s', $aiProviderId, $path);
        return $this->_patch($url, AiGatewayResponse::class, $data);
    }

    /**
     * AI Gateway DELETE
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.ai.providers.gateway.enterprise.delete API Documentation
     *
     * @param int $aiProviderId
     * @param string $path Raw provider API path after `/gateway/` (e.g. `chat/completions`)
     * @return AiGatewayResponse|null
     */
    public function gatewayDelete(int $aiProviderId, string $path): ?AiGatewayResponse
    {
        $url = sprintf('ai/providers/%d/gateway/%s', $aiProviderId, $path);
        return $this->client->apiRequest(
            'delete',
            $url,
            new ResponseModelDecorator(AiGatewayResponse::class)
        );
    }
}
