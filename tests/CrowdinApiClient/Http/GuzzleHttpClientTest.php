<?php

namespace CrowdinApiClient\Tests\Http;

use CrowdinApiClient\Http\Client\CrowdinHttpClientInterface;
use CrowdinApiClient\Http\Client\GuzzleHttpClient;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
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

    public function testRequestSendsUppercaseMethod(): void
    {
        $requestBody = json_encode([['op' => 'replace', 'path' => '/name', 'value' => 'test']]);
        $responseBody = json_encode(['data' => ['id' => 1, 'name' => 'test']]);

        $history = [];
        $stack = HandlerStack::create(new MockHandler([new Response(200, [], $responseBody)]));
        $stack->push(Middleware::history($history));
        $client = new GuzzleHttpClient(new Client(['handler' => $stack]));

        $body = $client->request('patch', 'https://api.crowdin.com/api/v2/projects/1', [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => $requestBody,
        ]);

        $this->assertSame($responseBody, (string)$body);
        $this->assertCount(1, $history);
        $this->assertSame('PATCH', $history[0]['request']->getMethod());
        $this->assertSame($requestBody, (string)$history[0]['request']->getBody());
    }
}
