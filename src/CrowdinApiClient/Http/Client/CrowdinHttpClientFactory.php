<?php

namespace CrowdinApiClient\Http\Client;

use InvalidArgumentException;

/**
 * CrowdinHttpClientFactory
 * @internal
 */
class CrowdinHttpClientFactory
{
    /**
     * @param $handler
     * @return CrowdinHttpClientInterface
     */
    public static function make($handler = null): CrowdinHttpClientInterface
    {
        if ($handler === null) {
            return new CurlHttpClient();
        }

        if ($handler instanceof CrowdinHttpClientInterface) {
            return  $handler;
        }
        if ($handler == 'guzzle') {
            return  new GuzzleHttpClient();
        }
        if ($handler == 'curl') {
            return  new CurlHttpClient();
        }

        throw new InvalidArgumentException('Http handler error');
    }
}
