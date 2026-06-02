<?php

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\Branch;
use CrowdinApiClient\Model\BranchClone;
use CrowdinApiClient\Model\BranchMerge;
use CrowdinApiClient\Model\BranchMergeSummary;
use CrowdinApiClient\ModelCollection;

class BranchApiTest extends AbstractTestApi
{
    public function testList()
    {
        $this->mockRequest([
            'uri' => 'https://api.crowdin.com/api/v2/projects/2/branches',
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

        $this->assertInstanceOf(ModelCollection::class, $data);
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

    public function testCloneBranch(): void
    {
        $params = [
            'name' => 'develop-master-clone',
            'title' => 'Clone of Master branch',
        ];

        $this->mockRequest([
            'path' => '/projects/2/branches/34/clones',
            'method' => 'post',
            'body' => json_encode($params),
            'response' => json_encode([
                'data' => [
                    'identifier' => 'a3b4c5d6-e7f8-9012-3456-789abc123def',
                    'status' => 'created',
                    'progress' => 0,
                    'attributes' => [],
                    'createdAt' => '2023-09-11T11:26:54+00:00',
                    'updatedAt' => '2023-09-11T11:26:54+00:00',
                    'startedAt' => null,
                    'finishedAt' => null,
                ],
            ]),
        ]);

        $clone = $this->crowdin->branch->cloneBranch(2, 34, $params);

        $this->assertInstanceOf(BranchClone::class, $clone);
        $this->assertEquals('a3b4c5d6-e7f8-9012-3456-789abc123def', $clone->getIdentifier());
        $this->assertEquals('created', $clone->getStatus());
        $this->assertEquals(0, $clone->getProgress());
        $this->assertEquals('2023-09-11T11:26:54+00:00', $clone->getCreatedAt());
    }

    public function testCheckCloneStatus(): void
    {
        $this->mockRequestGet(
            '/projects/2/branches/34/clones/a3b4c5d6-e7f8-9012-3456-789abc123def',
            json_encode([
                'data' => [
                    'identifier' => 'a3b4c5d6-e7f8-9012-3456-789abc123def',
                    'status' => 'finished',
                    'progress' => 100,
                    'attributes' => [],
                    'createdAt' => '2023-09-11T11:26:54+00:00',
                    'updatedAt' => '2023-09-11T11:26:57+00:00',
                    'startedAt' => '2023-09-11T11:26:55+00:00',
                    'finishedAt' => '2023-09-11T11:26:57+00:00',
                ],
            ])
        );

        $clone = $this->crowdin->branch->checkCloneStatus(2, 34, 'a3b4c5d6-e7f8-9012-3456-789abc123def');

        $this->assertInstanceOf(BranchClone::class, $clone);
        $this->assertEquals('finished', $clone->getStatus());
        $this->assertEquals(100, $clone->getProgress());
        $this->assertEquals('2023-09-11T11:26:57+00:00', $clone->getFinishedAt());
    }

    public function testGetClonedBranch(): void
    {
        $this->mockRequestGet(
            '/projects/2/branches/34/clones/a3b4c5d6-e7f8-9012-3456-789abc123def/branch',
            json_encode([
                'data' => [
                    'id' => 35,
                    'projectId' => 2,
                    'name' => 'develop-master-clone',
                    'title' => 'Clone of Master branch',
                    'isProtected' => false,
                    'createdAt' => '2023-09-11T11:26:57+00:00',
                    'updatedAt' => null,
                ],
            ])
        );

        $branch = $this->crowdin->branch->getClonedBranch(2, 34, 'a3b4c5d6-e7f8-9012-3456-789abc123def');

        $this->assertInstanceOf(Branch::class, $branch);
        $this->assertEquals(35, $branch->getId());
        $this->assertEquals(2, $branch->getProjectId());
        $this->assertEquals('develop-master-clone', $branch->getName());
        $this->assertFalse($branch->isProtected());
    }

    public function testMergeBranch(): void
    {
        $params = [
            'sourceBranchId' => 33,
            'deleteAfterMerge' => false,
        ];

        $this->mockRequest([
            'path' => '/projects/2/branches/34/merges',
            'method' => 'post',
            'body' => json_encode($params),
            'response' => json_encode([
                'data' => [
                    'identifier' => 'b4c5d6e7-f8a9-0123-4567-890bcd234efa',
                    'status' => 'created',
                    'progress' => 0,
                    'attributes' => [
                        'sourceBranchId' => 33,
                        'deleteAfterMerge' => false,
                        'dryRun' => false,
                        'acceptSourceChanges' => false,
                    ],
                    'createdAt' => '2023-09-11T11:26:54+00:00',
                    'updatedAt' => '2023-09-11T11:26:54+00:00',
                    'startedAt' => null,
                    'finishedAt' => null,
                ],
            ]),
        ]);

        $merge = $this->crowdin->branch->mergeBranch(2, 34, $params);

        $this->assertInstanceOf(BranchMerge::class, $merge);
        $this->assertEquals('b4c5d6e7-f8a9-0123-4567-890bcd234efa', $merge->getIdentifier());
        $this->assertEquals('created', $merge->getStatus());
        $this->assertEquals(0, $merge->getProgress());
    }

    public function testCheckMergeStatus(): void
    {
        $this->mockRequestGet(
            '/projects/2/branches/34/merges/b4c5d6e7-f8a9-0123-4567-890bcd234efa',
            json_encode([
                'data' => [
                    'identifier' => 'b4c5d6e7-f8a9-0123-4567-890bcd234efa',
                    'status' => 'finished',
                    'progress' => 100,
                    'attributes' => [
                        'sourceBranchId' => 33,
                        'deleteAfterMerge' => false,
                        'dryRun' => false,
                        'acceptSourceChanges' => false,
                    ],
                    'createdAt' => '2023-09-11T11:26:54+00:00',
                    'updatedAt' => '2023-09-11T11:26:56+00:00',
                    'startedAt' => '2023-09-11T11:26:55+00:00',
                    'finishedAt' => '2023-09-11T11:26:56+00:00',
                ],
            ])
        );

        $merge = $this->crowdin->branch->checkMergeStatus(2, 34, 'b4c5d6e7-f8a9-0123-4567-890bcd234efa');

        $this->assertInstanceOf(BranchMerge::class, $merge);
        $this->assertEquals('finished', $merge->getStatus());
        $this->assertEquals(100, $merge->getProgress());
        $this->assertEquals('2023-09-11T11:26:56+00:00', $merge->getFinishedAt());
    }

    public function testGetMergeSummary(): void
    {
        $this->mockRequestGet(
            '/projects/2/branches/34/merges/b4c5d6e7-f8a9-0123-4567-890bcd234efa/summary',
            json_encode([
                'data' => [
                    'status' => 'merged',
                    'sourceBranchId' => 33,
                    'targetBranchId' => 34,
                    'dryRun' => false,
                    'acceptSourceChanges' => false,
                    'details' => [
                        'added' => 5,
                        'deleted' => 1,
                        'updated' => 3,
                        'conflicted' => 0,
                    ],
                ],
            ])
        );

        $summary = $this->crowdin->branch->getMergeSummary(2, 34, 'b4c5d6e7-f8a9-0123-4567-890bcd234efa');

        $this->assertInstanceOf(BranchMergeSummary::class, $summary);
        $this->assertEquals('merged', $summary->getStatus());
        $this->assertEquals(33, $summary->getSourceBranchId());
        $this->assertEquals(34, $summary->getTargetBranchId());
        $this->assertFalse($summary->isDryRun());
        $this->assertFalse($summary->isAcceptSourceChanges());
        $this->assertEquals(['added' => 5, 'deleted' => 1, 'updated' => 3, 'conflicted' => 0], $summary->getDetails());
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
            $this->assertEquals('https://api.crowdin.com/api/v2/projects/2/branches/34', $uri);
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
