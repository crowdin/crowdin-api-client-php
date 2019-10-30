<?php

namespace Crowdin\Http\Client;

use InvalidArgumentException;

/**
 * CrowdinHttpClientFactory
 */
class CrowdinHttpClientFactory
{
    /**
     * @param $handler
     * @return CrowdinHttpClientInterface
     */
    public static function make($handler): CrowdinHttpClientInterface
    {
        //No handler specified
        if (!$handler) {
            return new CurlHttpClient();
        }

        if ($handler instanceof CrowdinHttpClientInterface) {
            return  $handler;
        }

        //Invalid handler
        throw new InvalidArgumentException('Http handler error');
    }
}
