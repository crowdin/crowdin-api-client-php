<?php

namespace CrowdinApiClient\Tests\Http;

use CrowdinApiClient\Http\Client\CrowdinHttpClientInterface;
use CrowdinApiClient\Http\Client\GuzzleHttpClient;
use PHPUnit\Framework\TestCase;

class GuzzleHttpClientTest extends TestCase
{
    public $client;

    public function setUp()
    {
        parent::setUp();
        $this->client = new GuzzleHttpClient();
    }

    public function testInit()
    {
        $this->assertInstanceOf(GuzzleHttpClient::class, $this->client);
        $this->assertInstanceOf(CrowdinHttpClientInterface::class, $this->client);
    }
}
