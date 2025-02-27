<?php

namespace CrowdinApiClient\Tests\Http;

use CrowdinApiClient\Exceptions\HttpException;
use CrowdinApiClient\Http\Client\CrowdinHttpClientInterface;
use CrowdinApiClient\Http\Client\CurlHttpClient;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class CurlHttpClientTest extends TestCase
{
    protected $client;

    protected $mockClient;

    protected function setUp(): void
    {
        if (!extension_loaded('curl')) {
            $this->markTestSkipped('cURL must be installed to test cURL client handler.');
        }

        $this->client = new CurlHttpClient();
        $this->mockClient = $this->getMockBuilder(CurlHttpClient::class)->enableArgumentCloning()->getMock();
    }

    public function testFunctionsCurl(): void
    {
        $this->mockClient->expects($this->once())->method('curlSetUrl')->willReturnCallback(function ($ch, $url) {
            $this->assertEquals('https://foo.com', $url);
            return true;
        });

        $this->mockClient->curlSetUrl('', 'https://foo.com');

        $this->mockClient->expects($this->once())->method('curlSetOption')->willReturnCallback(
            function ($ch, $option, $value) {
                $this->assertEquals('', $ch);
                $this->assertEquals(CURLOPT_TIMEOUT, $option);
                $this->assertEquals(60, $value);
                return true;
            }
        );

        $this->mockClient->curlSetOption('', CURLOPT_TIMEOUT, 60);

        $this->mockClient->expects($this->once())->method('curlInit')->will($this->returnValue(true));
        $this->assertTrue($this->mockClient->curlInit(''));
    }

    public function testGetTimeout(): void
    {
        $this->assertEquals(60, $this->client->getTimeout());
    }

    public function testSetTimeout(): void
    {
        $this->client->setTimeout(30);
        $this->assertEquals(30, $this->client->getTimeout());
    }

    public function testInit(): void
    {
        $this->assertInstanceOf(CrowdinHttpClientInterface::class, $this->client);
    }

    public function exceptionDataProvider(): array
    {
        return [
            'emptyMethod' => [
                'method' => '',
                'uri' => 'https://crowdin.com',
            ],
            'emptyUri' => [
                'method' => 'POST',
                'uri' => '',
            ],
        ];
    }

    /**
     * @dataProvider exceptionDataProvider
     * @throws HttpException
     */
    public function testRequestException(string $method, string $uri): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->client->request($method, $uri, []);
    }
}
