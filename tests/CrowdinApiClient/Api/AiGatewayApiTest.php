<?php

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\AiGatewayResponse;

class AiGatewayApiTest extends AbstractTestApi
{
    public function testGatewayGet(): void
    {
        $this->mockRequest([
            'path' => '/users/1/ai/providers/2/gateway/chat/completions',
            'method' => 'get',
            'response' => '{
              "data": {
                "id": "chatcmpl-abc123",
                "object": "chat.completion",
                "choices": [{"message": {"role": "assistant", "content": "Hello!"}}]
              }
            }',
        ]);

        $response = $this->crowdin->aiGateway->gatewayGet(1, 2, 'chat/completions');
        $this->assertInstanceOf(AiGatewayResponse::class, $response);
        $this->assertEquals('chatcmpl-abc123', $response->getData()['id']);
        $this->assertEquals('chat.completion', $response->getData()['object']);
    }

    public function testGatewayPost(): void
    {
        $data = [
            'model' => 'gpt-4o',
            'messages' => [
                [
                    'role' => 'user',
                    'content' => 'Hi',
                ],
            ],
        ];

        $this->mockRequest([
            'path' => '/users/1/ai/providers/2/gateway/chat/completions',
            'method' => 'post',
            'body' => json_encode($data),
            'response' => '{
              "data": {
                "id": "chatcmpl-abc123",
                "object": "chat.completion",
                "choices": [{"message": {"role": "assistant", "content": "Hello!"}}]
              }
            }',
        ]);

        $response = $this->crowdin->aiGateway->gatewayPost(1, 2, 'chat/completions', $data);
        $this->assertInstanceOf(AiGatewayResponse::class, $response);
        $this->assertEquals('chatcmpl-abc123', $response->getData()['id']);
    }

    public function testGatewayPut(): void
    {
        $data = [
            'model' => 'gpt-4o',
            'messages' => [
                [
                    'role' => 'user',
                    'content' => 'Hi',
                ],
            ],
        ];

        $this->mockRequest([
            'path' => '/users/1/ai/providers/2/gateway/chat/completions',
            'method' => 'put',
            'body' => json_encode($data),
            'response' => '{
              "data": {
                "id": "chatcmpl-abc123",
                "object": "chat.completion",
                "choices": [{"message": {"role": "assistant", "content": "Hello!"}}]
              }
            }',
        ]);

        $response = $this->crowdin->aiGateway->gatewayPut(1, 2, 'chat/completions', $data);
        $this->assertInstanceOf(AiGatewayResponse::class, $response);
        $this->assertEquals('chatcmpl-abc123', $response->getData()['id']);
    }

    public function testGatewayPatch(): void
    {
        $data = [
            'model' => 'gpt-4o',
            'messages' => [
                [
                    'role' => 'user',
                    'content' => 'Hi',
                ],
            ],
        ];

        $this->mockRequest([
            'path' => '/users/1/ai/providers/2/gateway/chat/completions',
            'method' => 'patch',
            'body' => json_encode($data),
            'response' => '{
              "data": {
                "id": "chatcmpl-abc123",
                "object": "chat.completion",
                "choices": [{"message": {"role": "assistant", "content": "Hello!"}}]
              }
            }',
        ]);

        $response = $this->crowdin->aiGateway->gatewayPatch(1, 2, 'chat/completions', $data);
        $this->assertInstanceOf(AiGatewayResponse::class, $response);
        $this->assertEquals('chatcmpl-abc123', $response->getData()['id']);
    }

    public function testGatewayDelete(): void
    {
        $this->mockRequest([
            'path' => '/users/1/ai/providers/2/gateway/chat/completions',
            'method' => 'delete',
            'response' => '{
              "data": {
                "id": "chatcmpl-abc123",
                "object": "chat.completion",
                "choices": [{"message": {"role": "assistant", "content": "Hello!"}}]
              }
            }',
        ]);

        $response = $this->crowdin->aiGateway->gatewayDelete(1, 2, 'chat/completions');
        $this->assertInstanceOf(AiGatewayResponse::class, $response);
        $this->assertEquals('chatcmpl-abc123', $response->getData()['id']);
    }
}
