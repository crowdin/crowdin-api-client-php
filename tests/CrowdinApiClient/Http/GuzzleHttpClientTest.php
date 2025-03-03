<?php

namespace CrowdinApiClient\Tests\Http;

use CrowdinApiClient\Http\Client\CrowdinHttpClientInterface;
use CrowdinApiClient\Http\Client\GuzzleHttpClient;
use PHPUnit\Framework\TestCase;

class GuzzleHttpClientTest extends TestCase
{
    public $client;

    public function setUp(): void
    {
        parent::setUp();
        $this->client = new GuzzleHttpClient();
    }

    public function testInit(): void
    {
        $this->assertInstanceOf(GuzzleHttpClient::class, $this->client);
        $this->assertInstanceOf(CrowdinHttpClientInterface::class, $this->client);
    }

    public function testSetTimeout(): void
    {
        $this->client->setTimeout(120);
        $this->assertEquals(120, $this->client->getTimeout());
    }

    public function testGetTimeout(): void
    {
        $this->assertEquals(30, $this->client->getTimeout());
    }
}
