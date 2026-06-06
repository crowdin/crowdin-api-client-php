<?php

declare(strict_types=1);

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Http\ResponseDecorator\ResponseModelDecorator;
use CrowdinApiClient\Model\AiGatewayResponse;

class AiGatewayApi extends AbstractApi
{
    /**
     * AI Gateway GET
     * @link https://developer.crowdin.com/api/v2/#operation/api.ai.providers.gateway.crowdin.get API Documentation
     *
     * @param int $userId
     * @param int $aiProviderId
     * @param string $path Raw provider API path after `/gateway/` (e.g. `chat/completions`)
     * @return AiGatewayResponse|null
     */
    public function gatewayGet(int $userId, int $aiProviderId, string $path): ?AiGatewayResponse
    {
        $url = sprintf('users/%d/ai/providers/%d/gateway/%s', $userId, $aiProviderId, $path);
        return $this->_get($url, AiGatewayResponse::class);
    }

    /**
     * AI Gateway POST
     * @link https://developer.crowdin.com/api/v2/#operation/api.ai.providers.gateway.crowdin.post API Documentation
     *
     * @param int $userId
     * @param int $aiProviderId
     * @param string $path Raw provider API path after `/gateway/` (e.g. `chat/completions`)
     * @param array $data Request body forwarded to the AI provider
     * @return AiGatewayResponse|null
     */
    public function gatewayPost(int $userId, int $aiProviderId, string $path, array $data): ?AiGatewayResponse
    {
        $url = sprintf('users/%d/ai/providers/%d/gateway/%s', $userId, $aiProviderId, $path);
        return $this->_post($url, AiGatewayResponse::class, $data);
    }

    /**
     * AI Gateway PUT
     * @link https://developer.crowdin.com/api/v2/#operation/api.ai.providers.gateway.crowdin.put API Documentation
     *
     * @param int $userId
     * @param int $aiProviderId
     * @param string $path Raw provider API path after `/gateway/` (e.g. `chat/completions`)
     * @param array $data Request body forwarded to the AI provider
     * @return AiGatewayResponse|null
     */
    public function gatewayPut(int $userId, int $aiProviderId, string $path, array $data): ?AiGatewayResponse
    {
        $url = sprintf('users/%d/ai/providers/%d/gateway/%s', $userId, $aiProviderId, $path);
        return $this->_put($url, AiGatewayResponse::class, $data);
    }

    /**
     * AI Gateway PATCH
     * @link https://developer.crowdin.com/api/v2/#operation/api.ai.providers.gateway.crowdin.patch API Documentation
     *
     * @param int $userId
     * @param int $aiProviderId
     * @param string $path Raw provider API path after `/gateway/` (e.g. `chat/completions`)
     * @param array $data Request body forwarded to the AI provider
     * @return AiGatewayResponse|null
     */
    public function gatewayPatch(int $userId, int $aiProviderId, string $path, array $data): ?AiGatewayResponse
    {
        $url = sprintf('users/%d/ai/providers/%d/gateway/%s', $userId, $aiProviderId, $path);
        return $this->_patch($url, AiGatewayResponse::class, $data);
    }

    /**
     * AI Gateway DELETE
     * @link https://developer.crowdin.com/api/v2/#operation/api.ai.providers.gateway.crowdin.delete API Documentation
     *
     * @param int $userId
     * @param int $aiProviderId
     * @param string $path Raw provider API path after `/gateway/` (e.g. `chat/completions`)
     * @return AiGatewayResponse|null
     */
    public function gatewayDelete(int $userId, int $aiProviderId, string $path): ?AiGatewayResponse
    {
        $url = sprintf('users/%d/ai/providers/%d/gateway/%s', $userId, $aiProviderId, $path);
        return $this->client->apiRequest(
            'delete',
            $url,
            new ResponseModelDecorator(AiGatewayResponse::class)
        );
    }
}
