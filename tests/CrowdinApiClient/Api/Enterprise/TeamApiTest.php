<?php

namespace CrowdinApiClient\Tests\Api\Enterprise;

use CrowdinApiClient\Model\Enterprise\AddedProjectTeamInfo;
use CrowdinApiClient\Model\Enterprise\ProjectPermission;
use CrowdinApiClient\Model\Enterprise\Team;
use CrowdinApiClient\ModelCollection;

class TeamApiTest extends AbstractTestApi
{
    public function testList()
    {
        $this->mockRequest([
            'path' => '/teams',
            'method' => 'get',
            'response' => json_encode([
                'data' => [
                    [
                        'data' => [
                            'id' => 2,
                            'name' => 'Team 1',
                            'totalMembers' => 8,
                            'createdAt' => '2019-09-23T09:04:29+00:00',
                            'updatedAt' => '2019-09-23T09:04:29+00:00',
                        ],
                    ],
                ],
                'pagination' => [
                    [
                        'offset' => 0,
                        'limit' => 0,
                    ],
                ],
            ]),
        ]);

        $teams = $this->crowdin->team->list();

        $this->assertInstanceOf(ModelCollection::class, $teams);
        $this->assertCount(1, $teams);
        $this->assertInstanceOf(Team::class, $teams[0]);
        $this->assertEquals(2, $teams[0]->getId());
    }

    public function testCreate()
    {
        $params = [
            'name' => 'Team 1',
        ];

        $this->mockRequest([
            'path' => '/teams',
            'method' => 'post',
            'body' => json_encode($params),
            'response' => json_encode([
                'data' => [
                    'id' => 2,
                    'name' => 'Team 1',
                    'totalMembers' => 8,
                    'createdAt' => '2019-09-23T09:04:29+00:00',
                    'updatedAt' => '2019-09-23T09:04:29+00:00',
                ],
            ]),
        ]);

        $team = $this->crowdin->team->create($params);

        $this->assertInstanceOf(Team::class, $team);
        $this->assertEquals(2, $team->getId());
    }

    public function testGetAndUpdate()
    {
        $this->mockRequestGet(
            '/teams/2',
            json_encode([
                'data' => [
                    'id' => 2,
                    'name' => 'Team 1',
                    'totalMembers' => 8,
                    'createdAt' => '2019-09-23T09:04:29+00:00',
                    'updatedAt' => '2019-09-23T09:04:29+00:00',
                ],
            ])
        );

        $team = $this->crowdin->team->get(2);

        $this->assertInstanceOf(Team::class, $team);
        $this->assertEquals(2, $team->getId());

        $this->mockRequestPatch(
            '/teams/2',
            json_encode([
                'data' => [
                    'id' => 2,
                    'name' => 'test edit',
                    'totalMembers' => 8,
                    'createdAt' => '2019-09-23T09:04:29+00:00',
                    'updatedAt' => '2019-09-23T09:04:29+00:00',
                ],
            ])
        );

        $team->setName('test edit');
        $team = $this->crowdin->team->update($team);

        $this->assertInstanceOf(Team::class, $team);
        $this->assertEquals(2, $team->getId());
        $this->assertEquals('test edit', $team->getName());
    }

    public function testDelete()
    {
        $this->mockRequestDelete('/teams/2');
        $this->crowdin->team->delete(2);
    }

    public function testAddTeamToProject()
    {
        $params = [
            'teamId' => 3,
            'permissions' => [
                'it' => ['workflowStepIds' => [313, 315]],
            ],
        ];

        $this->mockRequest([
            'path' => '/projects/2/teams',
            'method' => 'post',
            'body' => json_encode($params),
            'response' => json_encode([
                'data' => [
                    'skipped' => [],
                    'added' => [
                        'id' => 3,
                        'hasManagerAccess' => false,
                        'hasAccessToAllWorkflowSteps' => true,
                        'permissions' => [
                            'it' => [
                                'workflowStepIds' => [
                                    313,
                                ],
                            ],
                        ],
                    ],
                ],
            ]),
        ]);

        $addedProjectTeamInfo = $this->crowdin->team->addTeamToProject(2, $params);

        $this->assertInstanceOf(AddedProjectTeamInfo::class, $addedProjectTeamInfo);
        $this->assertEquals(3, $addedProjectTeamInfo->getAdded()->getId());
    }

    public function testListProjectPermissions(): void
    {
        $this->mockRequestGet(
            '/teams/7/projects/permissions',
            json_encode([
                'data' => [
                    [
                        'data' => [
                            'id' => 2,
                            'roles' => [['name' => 'translator', 'permissions' => ['allLanguages' => true]]],
                            'project' => ['id' => 2, 'name' => 'Knowledge Base', 'identifier' => 'knowledge-base'],
                        ],
                    ],
                ],
                'pagination' => ['offset' => 0, 'limit' => 25],
            ])
        );

        $permissions = $this->crowdin->team->listProjectPermissions(7);

        $this->assertInstanceOf(ModelCollection::class, $permissions);
        $this->assertCount(1, $permissions);
        $this->assertInstanceOf(ProjectPermission::class, $permissions[0]);
        $this->assertEquals('Knowledge Base', $permissions[0]->getProject()->getName());
        $this->assertEquals('translator', $permissions[0]->getRoles()[0]['name']);
    }

    public function testUpdateProjectPermissions(): void
    {
        $data = [['op' => 'add', 'path' => '/2/roles', 'value' => [['name' => 'translator']]]];

        $this->mockRequest([
            'path' => '/teams/7/projects/permissions',
            'method' => 'patch',
            'body' => json_encode($data),
            'response' => json_encode([
                'data' => [
                    [
                        'data' => [
                            'id' => 2,
                            'roles' => [['name' => 'translator', 'permissions' => ['allLanguages' => true]]],
                            'project' => ['id' => 2, 'name' => 'Knowledge Base', 'identifier' => 'knowledge-base'],
                        ],
                    ],
                ],
            ]),
        ]);

        $permissions = $this->crowdin->team->updateProjectPermissions(7, $data);

        $this->assertInstanceOf(ModelCollection::class, $permissions);
        $this->assertInstanceOf(ProjectPermission::class, $permissions[0]);
    }
}
