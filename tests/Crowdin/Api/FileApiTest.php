<?php

namespace Crowdin\Tests\Api;

use Crowdin\Model\File;

/**
 * Class FileApiTest
 * @package Crowdin\Tests\Api
 */
class FileApiTest extends AbstractTestApi
{
    /**
     * @test
     */
    public function testList()
    {
        $this->mockRequest([
            'path' => '/projects/2/files',
            'method' => 'get',
            'response' => '{
                  "data": [
                    {
                      "data": {
                        "id": 44,
                        "projectId": 2,
                        "branchId": 34,
                        "directoryId": 4,
                        "languageId": "en",
                        "name": "umbrella_app.xliff",
                        "title": "source_app_info",
                        "type": "xliff",
                        "revision": 1,
                        "status": "active",
                        "priority": "normal",
                        "attributes": {
                          "mimeType": "application/xml",
                          "fileSize": 261433
                        },
                        "exportPattern": "string",
                        "createdAt": "2019-09-19T15:10:43+00:00",
                        "updatedAt": "2019-09-19T15:10:46+00:00"
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

        $files = $files = $this->crowdin->file->list(2);

        $this->assertIsArray($files);
        $this->assertCount(1, $files);
        $this->assertInstanceOf(File::class, $files[0]);
        $this->assertEquals(44, $files[0]->getId());
    }

    public function testGet()
    {
        $this->mockRequestGet('/projects/2/files/44', '{
              "data": {
                "id": 44,
                "projectId": 2,
                "branchId": 34,
                "directoryId": 4,
                "languageId": "en",
                "name": "umbrella_app.xliff",
                "title": "source_app_info",
                "type": "xliff",
                "revision": 1,
                "status": "active",
                "priority": "normal",
                "attributes": {
                  "mimeType": "application/xml",
                  "fileSize": 261433
                },
                "exportPattern": "string",
                "createdAt": "2019-09-19T15:10:43+00:00",
                "updatedAt": "2019-09-19T15:10:46+00:00"
              }
        }');

        $file = $this->crowdin->file->get(2, 44);

        $this->assertInstanceOf(File::class, $file);
        $this->assertEquals(44, $file->getId());
    }
}
