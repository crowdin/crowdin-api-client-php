<?php

namespace CrowdinApiClient\Tests\Http;

use CrowdinApiClient\Http\Client\CrowdinHttpClientInterface;
use CrowdinApiClient\Http\Client\CurlHttpClient;
use PHPUnit\Framework\TestCase;

class CurlHttpClientTest extends TestCase
{
    protected $client;

    protected $mockClient;

    protected function setUp()
    {
        if (!extension_loaded('curl')) {
            $this->markTestSkipped('cURL must be installed to test cURL client handler.');
        }

        $this->client = new CurlHttpClient();
        $this->mockClient = $this->getMockBuilder(CurlHttpClient::class)->enableArgumentCloning()->getMock();
    }

    public function testFunctionsCurl()
    {
        $this->mockClient->expects($this->once())->method('curlSetUrl')->willReturnCallback(function ($ch, $url) {
            $this->assertEquals('https://foo.com', $url);
            return true;
        });
        $this->mockClient->curlSetUrl('', 'https://foo.com');

        $this->mockClient->expects($this->once())->method('curlSetOption')->willReturnCallback(function ($ch, $option, $value) {
            $this->assertEquals('', $ch);
            $this->assertEquals(CURLOPT_TIMEOUT, $option);
            $this->assertEquals(60, $value);
            return true;
        });
        $this->mockClient->curlSetOption('', CURLOPT_TIMEOUT, 60);

        $this->mockClient->expects($this->once())->method('curlClose')->will($this->returnValue(true));

        $this->assertTrue($this->mockClient->curlClose(''));

        $this->mockClient->expects($this->once())->method('curlInit')->will($this->returnValue(true));
        $this->assertTrue($this->mockClient->curlInit(''));
    }

    public function testTimeout()
    {
        $this->client->setTimeout(30);
        $this->assertEquals(30, $this->client->getTimeout());
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
