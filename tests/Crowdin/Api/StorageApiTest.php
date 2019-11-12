<?php

namespace Crowdin\Tests\Api;

use Crowdin\Model\Storage;

class StorageApiTest extends AbstractTestApi
{
    public function testList()
    {
        $this->mockRequestTest([
            'method' => 'get',
            'uri' => 'https://organization_domain.crowdin.com/api/v2/storages',
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

        $this->assertIsArray($storages);
        $this->assertCount(1, $storages);

        /**
         * @var Storage $storage
         */
        $storage = $storages[0];
        $this->assertInstanceOf(Storage::class, $storage);
    }

    public function testGet()
    {
        $this->mockRequestTest([
            'method' => 'get',
            'uri' => 'https://organization_domain.crowdin.com/api/v2/storages/1',
            'response' => '{
              "data": {
                "id": 1
              }
            }'
        ]);

        $storage = $this->crowdin->storage->get(1);

        $this->assertInstanceOf(Storage::class, $storage);

        $this->assertEquals(1, $storage->getId());
    }

    public function testDelete()
    {
        $this->mockRequestTest([
            'method' => 'delete',
            'uri' => 'https://organization_domain.crowdin.com/api/v2/storages/1',
            'response' => null
        ]);

        $this->crowdin->storage->delete(1);
    }

    public function testCreate()
    {
        $this->mockRequestTest([
            'method' => 'post',
            'uri' => 'https://organization_domain.crowdin.com/api/v2/storages',
            'response' => '{
              "data": {
                "id": 1
              }
            }'
        ]);

        $storage = $this->crowdin->storage->create(new \SplFileObject(__FILE__));

        $this->assertInstanceOf(Storage::class, $storage);
    }
}
