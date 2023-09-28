<?php

namespace CrowdinApiClient\Tests\Api\Enterprise;

use CrowdinApiClient\Crowdin;
use CrowdinApiClient\Http\Client\CurlHttpClient;
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

    protected function setUp(): void
    {
        $this->mockClient = $this->getMockBuilder(CurlHttpClient::class)->enableArgumentCloning()->getMock();

        $this->crowdin = new Crowdin([
            'http_client_handler' => $this->mockClient,
            'access_token' => 'access_token',
            'organization' => 'organization_domain',
        ]);

        $this->mockClient = $this->mockClient->expects($this->any())
            ->method('request');
    }

    public function mockRequest(array $params)
    {
        return $this->mockClient->will($this->returnCallback(function ($method, $uri, $options) use ($params) {
            $this->assertEquals($params['method'], $method);

            if (isset($params['path'])) {
                $this->assertEquals('https://organization_domain.crowdin.com/api/v2' . $params['path'], $uri);
            } else {
                $this->assertEquals($params['uri'], $uri);
            }

            if (isset($params['body'])) {
                $this->assertEquals($params['body'], $options['body']);
            }
            if (isset($params['header'])) {
                $this->assertEquals($params['header'], $options['header']);
            }
            return $params['response'] ?? null;
        }));
    }

    public function mockRequestPath(string $path, string $response, array $options = [])
    {
        return $this->mockRequest([
            'uri' => 'https://organization_domain.crowdin.com/api/v2' . $path,
            'method' => 'patch',
            'response' => $response,
            'options' => $options
        ]);
    }

    public function mockRequestGet(string $path, string $response, array $options = [])
    {
        return $this->mockRequest([
            'uri' => 'https://organization_domain.crowdin.com/api/v2' . $path,
            'method' => 'get',
            'response' => $response,
            'options' => $options
        ]);
    }

    public function mockRequestDelete(string $path)
    {
        return $this->mockRequest([
            'uri' => 'https://organization_domain.crowdin.com/api/v2' . $path,
            'method' => 'delete',
        ]);
    }
}
