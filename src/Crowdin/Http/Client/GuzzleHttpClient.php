<?php

namespace Kunnu\Dropbox\Http\Clients;

use Crowdin\Http\Client\CrowdinHttpClientInterface;
use GuzzleHttp\Client;

/**
 * Class GuzzleHttpClient
 * @package Kunnu\Dropbox\Http\Clients
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
     * Create a new GuzzleHttpClient instance.
     *
     * @param Client $client GuzzleHttp Client
     */
    public function __construct(Client $client = null)
    {
        //Set the client
        $this->client = $client ?: new Client();
    }

    public function request(string $method, string $uri, array $options)
    {
        // TODO: Implement request() method.
    }
}
