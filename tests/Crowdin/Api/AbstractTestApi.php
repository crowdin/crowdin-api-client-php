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

    public function mockRequestTest(array $params)
    {
        $mock = $this->mockClient->expects($this->any())
            ->method('request')
            ->will($this->returnCallback(function ($method, $uri, $options) use ($params) {
                $this->assertEquals($params['method'], $method);
                $this->assertEquals($params['uri'], $uri);
                if (isset($params['options']['body'])) {
                    $this->assertEquals($params['options']['body'], $options['options']['body']);
                }
                if (isset($params['options']['header'])) {
                    $this->assertEquals($params['options']['header'], $options['options']['header']);
                }
                return $params['response'] ?? null;
            }));

        return $mock;
    }
}
