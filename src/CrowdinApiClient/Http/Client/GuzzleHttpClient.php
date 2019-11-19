<?php

namespace CrowdinApiClient\Http\Client;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

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

    /**
     * @var int
     */
    protected $timeout = 30;

    /**
     * @var int
     */
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

    /**
     * @param string $method
     * @param string $uri
     * @param array $options
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @return \Psr\Http\Message\StreamInterface
     */
    public function request(string $method, string $uri, array $options)
    {
        $options = array_merge([
            'headers' => null,
            'body' => null,
            'timeout' => $this->timeout,
            'connect_timeout' => $this->connectTimeout
        ], $options);

        $request = new Request($method, $uri, $options['headers'], $options['body'], $options);

        $rawResponse = $this->client->send($request);

        return $rawResponse->getBody();
    }
}
