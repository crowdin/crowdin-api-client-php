<?php

namespace CrowdinApiClient\Tests\Http;

use CrowdinApiClient\Http\Client\CrowdinHttpClientInterface;
use CrowdinApiClient\Http\Client\CurlHttpClient;
use PHPUnit\Framework\TestCase;

class CurlHttpClientTest extends TestCase
{
    protected $client;

    protected function setUp()
    {
        if (!extension_loaded('curl')) {
            $this->markTestSkipped('cURL must be installed to test cURL client handler.');
        }

        $this->client = new CurlHttpClient();
    }

    public function testInit()
    {
        $this->assertInstanceOf(CrowdinHttpClientInterface::class, $this->client);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testArgumentMethod()
    {
        $response = $this->client->request('', '', []);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testArgumentUri()
    {
        $response = $this->client->request('post', '', []);
    }
}
