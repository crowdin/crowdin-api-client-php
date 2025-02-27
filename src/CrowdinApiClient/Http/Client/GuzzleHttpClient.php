<?php

namespace CrowdinApiClient\Http\Client;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * @package Crowdin\Http\Client
 * @internal
 */
class GuzzleHttpClient implements CrowdinHttpClientInterface
{
    /**
     * GuzzleHttp client
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
     * @param Client|null $client GuzzleHttp Client
     */
    public function __construct(?Client $client = null)
    {
        $this->client = $client ?: new Client();
    }

    public function getTimeout(): int
    {
        return $this->timeout;
    }

    public function setTimeout(int $timeout): void
    {
        $this->timeout = $timeout;
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
        $request = new Request($method, $uri, $options['headers'] ?? [], $options['body'] ?? null);

        $this->response = $this->client->send(
            $request,
            [
                'timeout' => $this->timeout,
                'connect_timeout' => $this->connectTimeout,
            ]
        );

        return $this->response->getBody();
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
