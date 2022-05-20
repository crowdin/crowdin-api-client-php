<?php

namespace CrowdinApiClient\Http\Client;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * Class GuzzleHttpClient
 * @package Crowdin\Http\Client
 * @internal
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
     * @var ResponseInterface
     */
    protected $response;

    /**
     * @return ResponseInterface
     */
    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }

    /**
     * Create a new GuzzleHttpClient instance.
     *
     * @param Client|null $client GuzzleHttp Client
     */
    public function __construct(Client $client = null)
    {
        $this->client = $client ?: new Client();
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $options
     * @throws GuzzleException
     * @return StreamInterface
     */
    public function request(string $method, string $uri, array $options): StreamInterface
    {
        $options = array_merge([
            'headers' => null,
            'body' => null,
            'timeout' => $this->timeout,
            'connect_timeout' => $this->connectTimeout
        ], $options);

        $request = new Request($method, $uri, $options['headers'], $options['body'], $options);

        $this->response = $this->client->send($request);

        return $this->response->getBody();
    }
}
