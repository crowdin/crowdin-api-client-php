<?php

namespace CrowdinApiClient\Http\Client;

/**
 * @ignore No documentation will be generated for this class
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
