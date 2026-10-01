<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Api\Enterprise;

use CrowdinApiClient\Model\Enterprise\Client;
use CrowdinApiClient\ModelCollection;

class ClientApiTest extends AbstractTestApi
{
    public function testList(): void
    {
        $this->mockRequestGet(
            '/clients?limit=10',
            json_encode([
                'data' => [
                    [
                        'data' => [
                            'id' => 1,
                            'name' => 'Umbrella',
                            'description' => 'Client organization',
                            'status' => 'confirmed',
                            'webUrl' => 'https://umbrella.crowdin.com',
                        ],
                    ],
                ],
                'pagination' => ['offset' => 0, 'limit' => 10],
            ])
        );

        $clients = $this->crowdin->client->list(['limit' => 10]);

        $this->assertInstanceOf(ModelCollection::class, $clients);
        $this->assertCount(1, $clients);
        $this->assertInstanceOf(Client::class, $clients[0]);
        $this->assertEquals('confirmed', $clients[0]->getStatus());
    }
}
