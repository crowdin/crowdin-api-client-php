<?php

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Crowdin;
use CrowdinApiClient\Http\Client\CurlHttpClient;
use PHPUnit\Framework\TestCase;

abstract class AbstractTestApi extends TestCase
{
    /**
     * @var Crowdin
     */
    protected $crowdin;

    protected $mockClient;

    protected function setUp(): void
    {
        $this->mockClient = $this->getMockBuilder(CurlHttpClient::class)->enableArgumentCloning()->getMock();

        $this->crowdin = new Crowdin([
            'http_client_handler' => $this->mockClient,
            'access_token' => 'access_token',
        ]);

        $this->mockClient = $this->mockClient->expects($this->any())
            ->method('request');
    }

    public function mockRequest(array $params)
    {
        return $this->mockClient->will(
            $this->returnCallback(
                function (string $method, string $uri, array $options) use ($params): string {
                    $this->assertEquals($params['method'], $method);

                    if (isset($params['path'])) {
                        $this->assertEquals('https://api.crowdin.com/api/v2' . $params['path'], $uri);
                    } else {
                        $this->assertEquals($params['uri'], $uri);
                    }

                    if (isset($params['body'])) {
                        $this->assertEquals($params['body'], $options['body']);
                    }

                    if (isset($params['headers'])) {
                        $this->assertEquals($params['headers'], $options['headers']);
                    }

                    return $params['response'] ?? '';
                }
            )
        );
    }

    public function mockRequestPatch(string $path, string $response, array $options = [])
    {
        return $this->mockRequest([
            'uri' => 'https://api.crowdin.com/api/v2' . $path,
            'method' => 'patch',
            'response' => $response,
            'options' => $options,
        ]);
    }

    public function mockRequestPut(string $path, string $response, array $options = [])
    {
        return $this->mockRequest([
            'uri' => 'https://api.crowdin.com/api/v2' . $path,
            'method' => 'put',
            'response' => $response,
            'options' => $options,
        ]);
    }

    public function mockRequestGet(string $path, string $response, array $options = [])
    {
        return $this->mockRequest([
            'uri' => 'https://api.crowdin.com/api/v2' . $path,
            'method' => 'get',
            'response' => $response,
            'options' => $options,
        ]);
    }

    public function mockRequestDelete(string $path)
    {
        return $this->mockRequest([
            'uri' => 'https://api.crowdin.com/api/v2' . $path,
            'method' => 'delete',
        ]);
    }
}
