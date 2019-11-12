<?php

namespace Crowdin\Tests\Api;

use Crowdin\Model\Branch;

class BranchApiTest extends AbstractTestApi
{
    public function testList()
    {
        $data = $this->mockClient->expects($this->once())
            ->method('request')
            ->will($this->returnCallback(function ($method, $uri, $options) {
                $this->assertEquals('get', $method);
                $this->assertEquals('https://organization_domain.crowdin.com/api/v2/projects/2/branches', $uri);
                return '{
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
            }';
            }));

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
        $this->mockClient->expects($this->once())
            ->method('request')
            ->will($this->returnCallback(function ($method, $uri, $options) {
                $this->assertEquals('get', $method);
                $this->assertEquals('https://organization_domain.crowdin.com/api/v2/projects/2/branches/34', $uri);
                return '{
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
                    }';
            }));

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

    public function testDelete()
    {
        $this->mockClient->expects($this->once())
            ->method('request')->will($this->returnCallback(function ($method, $uri, $options) {
                $this->assertEquals('delete', $method);
                $this->assertEquals('https://organization_domain.crowdin.com/api/v2/projects/2/branches/34', $uri);
            }));

        $this->crowdin->branch->delete(2, 34);
    }

    public function testUpdate()
    {
        $mock = $this->mockClient->expects($this->exactly(2))
            ->method('request')
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
