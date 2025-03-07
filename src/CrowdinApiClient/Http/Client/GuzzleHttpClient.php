<?php

namespace CrowdinApiClient\Http\Client;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * @package Crowdin\Http\Client
 * @ignore No documentation will be generated for this class
 */
class GuzzleHttpClient implements CrowdinHttpClientInterface
{
    /**
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
     * @throws GuzzleException
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
