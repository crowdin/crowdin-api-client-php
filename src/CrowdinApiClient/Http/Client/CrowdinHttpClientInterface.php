<?php

namespace CrowdinApiClient\Http\Client;

/**
 * CrowdinHttpClientInterface
 */
interface CrowdinHttpClientInterface
{
    /**
     * @param string $method
     * @param string $uri
     * @param array $options
     * @return mixed
     */
    public function request(string $method, string $uri, array $options);
}
