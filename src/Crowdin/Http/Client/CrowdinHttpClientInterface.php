<?php

namespace Crowdin\Http\Client;

/**
 * CrowdinHttpClientInterface
 */
interface CrowdinHttpClientInterface
{
    public function request(string $method, string $uri, array $options);
}
