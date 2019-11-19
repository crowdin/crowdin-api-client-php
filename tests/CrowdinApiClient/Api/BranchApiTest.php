<?php

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\Branch;

class BranchApiTest extends AbstractTestApi
{
    public function testList()
    {
        $this->mockRequest([
            'uri' => 'https://organization_domain.crowdin.com/api/v2/projects/2/branches',
            'method' => 'get',
            'response' => '{
                  "data": [
                    {
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

        $data = $this->crowdin->branch->list(2);

        $this->assertIsArray($data);
        $this->assertCount(1, $data);
        /**
         * @var Branch $branchModel
         */
        $branchModel = $data[0];
        $this->assertInstanceOf(Branch::class, $branchModel);

        $this->assertEquals(34, $branchModel->getId());
        $this->assertEquals(2, $branchModel->getProjectId());
        $this->assertEquals('develop-master', $branchModel->getName());
        $this->assertEquals('Master branch', $branchModel->getTitle());
        $this->assertEquals('%three_letters_code%', $branchModel->getExportPattern());
        $this->assertEquals('normal', $branchModel->getPriority());
        $this->assertEquals('2019-09-16T13:48:04+00:00', $branchModel->getCreatedAt());
        $this->assertEquals('2019-09-19T13:25:27+00:00', $branchModel->getUpdatedAt());
    }

    public function testGet()
    {
        $this->mockRequestGet('/projects/2/branches/34',
            '{
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

        $branch = $this->crowdin->branch->get(2, 34);

        $this->assertInstanceOf(Branch::class, $branch);

        $this->assertEquals(34, $branch->getId());
        $this->assertEquals(2, $branch->getProjectId());
        $this->assertEquals('develop-master', $branch->getName());
        $this->assertEquals('Master branch', $branch->getTitle());
        $this->assertEquals('%three_letters_code%', $branch->getExportPattern());
        $this->assertEquals('normal', $branch->getPriority());
        $this->assertEquals('2019-09-16T13:48:04+00:00', $branch->getCreatedAt());
        $this->assertEquals('2019-09-19T13:25:27+00:00', $branch->getUpdatedAt());
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
            'path' => '/projects/2/branches',
            'method' => 'post',
            'body' => $params,
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

        $branch = $this->crowdin->branch->create(2, $params);

        $this->assertInstanceOf(Branch::class, $branch);
        $this->assertEquals(34, $branch->getId());
        $this->assertEquals(2, $branch->getProjectId());
    }

    public function testDelete()
    {
        $this->mockRequest([
            'path' => '/projects/2/branches/34',
            'method' => 'delete',
        ]);

        $this->crowdin->branch->delete(2, 34);
    }

    public function testUpdate()
    {
        $mock = $this->mockClient
            ->willReturn('{
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

        $branch = $this->crowdin->branch->get(2, 34);

        $branch->setName('develop-master-edit');

        $mock->will($this->returnCallback(function ($method, $uri, $options) {
            $this->assertEquals('patch', $method);
            $this->assertEquals('https://organization_domain.crowdin.com/api/v2/projects/2/branches/34', $uri);
            return '{
                  "data": {
                    "id": 34,
                    "projectId": 2,
                    "name": "develop-master-edit",
                    "title": "Master branch",
                    "exportPattern": "%three_letters_code%",
                    "priority": "normal",
                    "createdAt": "2019-09-16T13:48:04+00:00",
                    "updatedAt": "2019-09-19T13:25:27+00:00"
                  }
            }';
        }));

        $branchNew = $this->crowdin->branch->update($branch);

        $this->assertInstanceOf(Branch::class, $branchNew);
        $this->assertEquals('develop-master-edit', $branchNew->getName());
    }
}
