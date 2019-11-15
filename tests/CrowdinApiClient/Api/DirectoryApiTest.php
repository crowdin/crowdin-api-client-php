<?php

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\Directory;

class DirectoryApiTest extends AbstractTestApi
{
    public function testList()
    {
        $this->mockRequest([
            'path' => '/projects/2/directories',
            'method' => 'get',
            'response' => '{
              "data": [
                {
                  "data": {
                    "id": 4,
                    "projectId": 2,
                    "branchId": 34,
                    "parentId": 0,
                    "name": "main",
                    "title": "<Description materials>",
                    "exportPattern": "/localization/%locale%/%file_name%",
                    "priority": "normal",
                    "createdAt": "2019-09-19T14:14:00+00:00",
                    "updatedAt": "2019-09-19T14:14:00+00:00"
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

        $directories = $this->crowdin->directory->list(2);

        $this->assertIsArray($directories);
        $this->assertCount(1, $directories);
        $this->assertInstanceOf(Directory::class, $directories[0]);
        $this->assertEquals(4, $directories[0]->getId());
    }

    public function testGet()
    {
        $this->mockRequestGet('/projects/2/directories/34', '{
                  "data": {
                    "id": 34,
                    "projectId": 2,
                    "name": "develop-master",
                    "title": "Master branch",
                    "exportPattern": "%three_letters_code%",
                    "priority": "normal",
                    "createdAt": "2019-09-16T13:48:04+00:00",
                    "updatedAt": "2019-09-19T13:25:27+00:00"
                  }
            }');

        $directory = $this->crowdin->directory->get(2, 34);

        $this->assertInstanceOf(Directory::class, $directory);
        $this->assertEquals(34, $directory->getId());
    }
}
