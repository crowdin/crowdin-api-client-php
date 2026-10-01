<?php

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Http\Client\GuzzleHttpClient;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

class GraphqlApiTest extends AbstractTestApi
{
    public function testQueryWithGuzzleClient(): void
    {
        $responseBody = json_encode(['data' => ['viewer' => ['id' => 1]]]);
        $handler = new MockHandler([new Response(200, [], $responseBody)]);
        $this->crowdin->setClient(new GuzzleHttpClient(new Client(['handler' => $handler])));

        $response = $this->crowdin->graphql->query('query { viewer { id } }');

        $this->assertSame(['viewer' => ['id' => 1]], $response);
    }

    public function testQuery(): void
    {
        $query = 'query Test($limit: Int) {
          viewer {
            projects(first: $limit) {
              edges {
                node {
                  name
                  files(first: 50) {
                    totalCount
                    edges {
                      node {
                        name
                        type
                      }
                    }
                  }
                }
              }
            }
          }
        }';

        $operationName = 'Test';
        $variables = ['limit' => 10];

        $this->mockRequest([
            'uri' => 'https://api.crowdin.com/api/graphql',
            'method' => 'post',
            'body' => json_encode([
                'query' => $query,
                'operationName' => $operationName,
                'variables' => $variables,
            ]),
            'headers' => [
                'Authorization' => 'Bearer access_token',
                'content-type' => 'application/json',
            ],
            'response' => json_encode([
                'data' => [
                    'viewer' => [
                        'projects' => [
                            'edges' => [
                                [
                                    'node' => [
                                        'name' => 'Test Project',
                                        'files' => [
                                            'totalCount' => 1,
                                            'edges' => [
                                                [
                                                    'node' => [
                                                        'name' => 'localization.csv',
                                                        'type' => 'csv',
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ]),
        ]);

        $response = $this->crowdin->graphql->query($query, $operationName, $variables);

        $this->assertIsArray($response);
        $this->assertIsArray($response['viewer']);
    }
}
