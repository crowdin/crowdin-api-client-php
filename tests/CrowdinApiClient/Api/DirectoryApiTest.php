<?php

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\Directory;
use CrowdinApiClient\ModelCollection;

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
                    "directoryId": 0,
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

        $this->assertInstanceOf(ModelCollection::class, $directories);
        $this->assertCount(1, $directories);
        $this->assertInstanceOf(Directory::class, $directories[0]);
        $this->assertEquals(4, $directories[0]->getId());
    }

    public function testGetAndUpdate()
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

        $directory->setName('edit test');

        $this->mockRequestPath('/projects/2/directories/34', '{
                  "data": {
                    "id": 34,
                    "projectId": 2,
                    "name": "edit test",
                    "title": "Master branch",
                    "exportPattern": "%three_letters_code%",
                    "priority": "normal",
                    "createdAt": "2019-09-16T13:48:04+00:00",
                    "updatedAt": "2019-09-19T13:25:27+00:00"
                  }
            }');

        $this->crowdin->directory->update($directory);
        $this->assertInstanceOf(Directory::class, $directory);
        $this->assertEquals(34, $directory->getId());
        $this->assertEquals('edit test', $directory->getName());
    }

    public function testCreate()
    {
        $params = [
            'name' => 'develop-master',
            'title' => 'Master branch',
            'exportPattern' => '%three_letters_code%',
            'priority' => 'normal',
        ];

        $this->mockRequest([
            'path' => '/projects/2/directories',
            'method' => 'post',
            'body' => json_encode($params),
            'response' => '{
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
                }'
        ]);

        $directory = $this->crowdin->directory->create(2, $params);
        $this->assertInstanceOf(Directory::class, $directory);
        $this->assertEquals(34, $directory->getId());
    }

    public function testDelete()
    {
        $this->mockRequestDelete('/projects/2/directories/34');
        $this->crowdin->directory->delete(2, 34);
    }
}
