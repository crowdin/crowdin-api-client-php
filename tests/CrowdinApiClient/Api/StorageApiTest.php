<?php

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\Storage;
use CrowdinApiClient\ModelCollection;
use SplFileInfo;

class StorageApiTest extends AbstractTestApi
{
    public function testList()
    {
        $this->mockRequest([
            'method' => 'get',
            'uri' => 'https://api.crowdin.com/api/v2/storages',
            'response' => '{
                  "data": [
                    {
                      "data": {
                        "id": 1
                      }
                    }
                  ],
                  "pagination": [
                    {
                      "offset": 0,
                      "limit": 0
                    }
                  ]
                }'
        ]);

        $storages = $this->crowdin->storage->list();

        $this->assertInstanceOf(ModelCollection::class, $storages);
        $this->assertCount(1, $storages);

        /**
         * @var Storage $storage
         */
        $storage = $storages[0];
        $this->assertInstanceOf(Storage::class, $storage);
    }

    public function testGet()
    {
        $this->mockRequestGet('/storages/1', '{
              "data": {
                "id": 1
              }
        }');

        $storage = $this->crowdin->storage->get(1);

        $this->assertInstanceOf(Storage::class, $storage);

        $this->assertEquals(1, $storage->getId());
    }

    public function testDelete()
    {
        $this->mockRequest([
            'method' => 'delete',
            'uri' => 'https://api.crowdin.com/api/v2/storages/1',
            'response' => null
        ]);

        $this->crowdin->storage->delete(1);
    }

    public function testCreate(): void
    {
        $fileObject = new SplFileInfo(__FILE__);

        $this->mockRequest([
            'method' => 'post',
            'uri' => 'https://api.crowdin.com/api/v2/storages',
            'response' => json_encode([
                'data' => [
                    'id' => 1
                ]
            ]),
            'headers' => [
                'Content-Type' => 'application/octet-stream',
                'Crowdin-API-FileName' => 'StorageApiTest.php',
                'Authorization' => 'Bearer access_token',
            ],
        ]);

        $storage = $this->crowdin->storage->create($fileObject);

        $this->assertInstanceOf(Storage::class, $storage);
    }
}
