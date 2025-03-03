<?php

namespace CrowdinApiClient\Http\Client;

/**
 * @internal
 */
interface CrowdinHttpClientInterface
{
    public function getTimeout(): int;
    public function setTimeout(int $timeout): void;

    /**
     * @param string $method
     * @param string $uri
     * @param array $options
     * @return mixed
     */
    public function request(string $method, string $uri, array $options);
}
