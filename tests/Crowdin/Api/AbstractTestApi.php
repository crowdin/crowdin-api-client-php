<?php

namespace Crowdin\Tests\Api;

use Crowdin\Crowdin;
use Crowdin\Http\Client\CurlHttpClient;
use PHPUnit\Framework\TestCase;

/**
 * Class AbstractApiTest
 * @package Crowdin\Tests\Api
 */
abstract class AbstractTestApi extends TestCase
{
    /**
     * @var Crowdin
     */
    protected $crowdin;

    protected $mockClient;

    protected function setUp()
    {
        $this->mockClient = $this->getMockBuilder(CurlHttpClient::class)->enableArgumentCloning()->getMock();

        $this->crowdin = new Crowdin([
            'http_client_handler' => $this->mockClient,
            'access_token' => 'access_token',
            'base_uri' => 'https://organization_domain.crowdin.com/api/v2',
        ]);
    }

    public function mockRequest(array $params)
    {
        $mock = $this->mockClient->expects($this->any())
            ->method('request')
            ->will($this->returnCallback(function ($method, $uri, $options) use ($params) {
                $this->assertEquals($params['method'], $method);

                if(isset($params['path']))
                {
                    $this->assertEquals('https://organization_domain.crowdin.com/api/v2'.$params['path'], $uri);
                }else
                {
                    $this->assertEquals($params['uri'], $uri);
                }

                if (isset($params['body'])) {
                    $this->assertEquals($params['body'], $params['body']);
                }
                if (isset($params['header'])) {
                    $this->assertEquals($params['header'], $params['header']);
                }
                return $params['response'] ?? null;
            }));

        return $mock;
    }

    public function mockRequestGet(string $path, string $response, array $options = [])
    {
        return $this->mockRequest([
            'uri' => 'https://organization_domain.crowdin.com/api/v2'. $path,
            'method' => 'get',
            'response' => $response,
            'options' => $options
        ]);
    }

    public function mockRequestDelete(string $path)
    {
        return $this->mockRequest([
            'uri' => 'https://organization_domain.crowdin.com/api/v2'. $path,
            'method' => 'delete',
        ]);
    }

}
