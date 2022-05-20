<?php

namespace CrowdinApiClient\Tests\Http;

use CrowdinApiClient\Http\Client\CrowdinHttpClientFactory;
use CrowdinApiClient\Http\Client\CurlHttpClient;
use CrowdinApiClient\Http\Client\GuzzleHttpClient;
use PHPUnit\Framework\TestCase;

class CrowdinHttpClientFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function testFactory()
    {
        $this->assertInstanceOf(CurlHttpClient::class, CrowdinHttpClientFactory::make());
        $this->assertInstanceOf(CurlHttpClient::class, CrowdinHttpClientFactory::make('curl'));
        $this->assertInstanceOf(CurlHttpClient::class, CrowdinHttpClientFactory::make(new CurlHttpClient()));
        $this->assertInstanceOf(CurlHttpClient::class, CrowdinHttpClientFactory::make(new CurlHttpClient()));
        $this->assertInstanceOf(GuzzleHttpClient::class, CrowdinHttpClientFactory::make('guzzle'));
        $this->assertInstanceOf(GuzzleHttpClient::class, CrowdinHttpClientFactory::make(new GuzzleHttpClient()));
    }

    public function testException()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->assertInstanceOf(CurlHttpClient::class, CrowdinHttpClientFactory::make('none'));
    }
}
