<?php

namespace Crowdin\Http\Client;

use GuzzleHttp\Client;

/**
 * Class GuzzleHttpClient
 * @package Crowdin\Http\Client
 */
class GuzzleHttpClient implements CrowdinHttpClientInterface
{
    /**
     * GuzzleHttp client.
     *
     * @var Client
     */
    protected $client;

    protected $timeout = 30;

    protected $connectTimeout = 30;
    /**
     * Create a new GuzzleHttpClient instance.
     *
     * @param Client $client GuzzleHttp Client
     */
    public function __construct(Client $client = null)
    {
        $this->client = $client ?: new Client();
    }

    public function request(string $method, string $uri, array $options)
    {
        $options = array_merge([
            'headers' => null,
            'body' => null,
            'timeout' => $this->timeout,
            'connect_timeout' => $this->connectTimeout
        ], $options);

        $request = $this->client->createRequest($method, $uri, $options);

        $rawResponse = $this->client->send($request);
    }
}
