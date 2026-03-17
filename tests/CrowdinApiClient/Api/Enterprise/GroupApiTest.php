<?php

namespace CrowdinApiClient\Tests\Api\Enterprise;

use CrowdinApiClient\Model\Enterprise\Group;
use CrowdinApiClient\Model\Enterprise\GroupManager;
use CrowdinApiClient\Model\Enterprise\GroupTeam;
use CrowdinApiClient\Model\Enterprise\Team;
use CrowdinApiClient\Model\Enterprise\User;
use CrowdinApiClient\Model\Report;
use CrowdinApiClient\ModelCollection;

class GroupApiTest extends AbstractTestApi
{
    public function testList()
    {
        $this->mockRequest([
            'uri' => 'https://organization_domain.crowdin.com/api/v2/groups',
            'method' => 'get',
            'response' => json_encode([
                'data' => [
                    [
                        'data' => [
                            'id' => 1,
                            'name' => 'KB materials',
                            'description' => 'KB localization materials',
                            'parentId' => 2,
                            'organizationId' => 200000299,
                            'userId' => 6,
                            'subgroupsCount' => 0,
                            'projectsCount' => 1,
                            'createdAt' => '2019-09-20T11:11:05+00:00',
                            'updatedAt' => '2019-09-20T12:22:20+00:00',
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

        $groups = $this->crowdin->group->list();

        $this->assertInstanceOf(ModelCollection::class, $groups);
        $this->assertCount(1, $groups);
        $this->assertInstanceOf(Group::class, $groups[0]);
    }

    public function testCreate()
    {
        $this->mockRequest([
            'uri' => 'https://organization_domain.crowdin.com/api/v2/groups',
            'method' => 'post',
            'response' => json_encode([
                'data' => [
                    'id' => 1,
                    'name' => 'KB materials',
                    'description' => 'KB localization materials',
                    'parentId' => 2,
                    'organizationId' => 200000299,
                    'userId' => 6,
                    'subgroupsCount' => 0,
                    'projectsCount' => 1,
                    'createdAt' => '2019-09-20T11:11:05+00:00',
                    'updatedAt' => '2019-09-20T12:22:20+00:00',
                ],
            ]),
        ]);

        $group = $this->crowdin->group->create([
            'name' => 'KB materials',
            'description' => 'KB localization materials',
        ]);

        $this->assertInstanceOf(Group::class, $group);
        $this->assertEquals(1, $group->getId());
    }

    public function testGetAndUpdate()
    {
        $this->mockRequestGet(
            '/groups/1',
            json_encode([
                'data' => [
                    'id' => 1,
                    'name' => 'KB materials',
                    'description' => 'KB localization materials',
                    'parentId' => 2,
                    'organizationId' => 200000299,
                    'userId' => 6,
                    'subgroupsCount' => 0,
                    'projectsCount' => 1,
                    'createdAt' => '2019-09-20T11:11:05+00:00',
                    'updatedAt' => '2019-09-20T12:22:20+00:00',
                ],
            ])
        );

        $group = $this->crowdin->group->get(1);

        $this->assertInstanceOf(Group::class, $group);
        $this->assertEquals(1, $group->getId());

        $group->setName('edit test');

        $this->mockRequestPatch(
            '/groups/1',
            json_encode([
                'data' => [
                    'id' => 1,
                    'name' => 'edit test',
                    'description' => 'KB localization materials',
                    'parentId' => 2,
                    'organizationId' => 200000299,
                    'userId' => 6,
                    'subgroupsCount' => 0,
                    'projectsCount' => 1,
                    'createdAt' => '2019-09-20T11:11:05+00:00',
                    'updatedAt' => '2019-09-20T12:22:20+00:00',
                ],
            ])
        );

        $this->crowdin->group->update($group);

        $this->assertInstanceOf(Group::class, $group);
        $this->assertEquals(1, $group->getId());
        $this->assertEquals('edit test', $group->getName());
    }

    public function testDelete()
    {
        $this->mockRequest([
            'uri' => 'https://organization_domain.crowdin.com/api/v2/groups/1',
            'method' => 'delete',
        ]);

        $this->crowdin->group->delete(1);
    }

    public function testReport(): void
    {
        $this->mockRequest([
            'path' => '/groups/123/reports',
            'method' => 'post',
            'response' => json_encode([
                'data' => [
                    'identifier' => '50fb3506-4127-4ba8-8296-f97dc7e3e0c3',
                    'status' => 'finished',
                    'progress' => 100,
                    'attributes' => [
                        'projectIds' => [0],
                        'format' => 'xlsx',
                        'reportName' => 'costs-estimation',
                        'schema' => [],
                    ],
                    'createdAt' => '2019-09-23T11:26:54+00:00',
                    'updatedAt' => '2019-09-23T11:26:54+00:00',
                    'startedAt' => '2019-09-23T11:26:54+00:00',
                    'finishedAt' => '2019-09-23T11:26:54+00:00',
                ],
            ]),
        ]);

        $data = [
            'name' => 'group-translation-costs-pe',
            'schema' => [
                'projectIds' => [13],
                'unit' => 'words',
                'currency' => 'USD',
                'format' => 'xlsx',
                'baseRates' => [
                    'fullTranslation' => 0.1,
                    'proofread' => 0.12,
                ],
                'individualRates' => [
                    [
                        'languageIds' => ['uk'],
                        'userIds' => [1],
                        'fullTranslation' => 0.1,
                        'proofread' => 0.12,
                    ],
                ],
                'netRateSchemes' => [
                    'tmMatch' => [
                        [
                            'matchType' => 'perfect',
                            'price' => 0.1,
                        ],
                    ],
                    'mtMatch' => [
                        [
                            'matchType' => '100',
                            'price' => 0.1,
                        ],
                    ],
                    'suggestionMatch' => [
                        [
                            'matchType' => '100',
                            'price' => 0.1,
                        ],
                    ],
                ],
                'groupBy' => 'user',
                'dateFrom' => '2019-09-23T07:00:14+00:00',
                'dateTo' => '2019-09-27T07:00:14+00:00',
                'userIds' => [13],
            ],
        ];

        $report = $this->crowdin->group->report(123, $data);

        $this->assertInstanceOf(Report::class, $report);
        $this->assertEquals('50fb3506-4127-4ba8-8296-f97dc7e3e0c3', $report->getIdentifier());
    }

    public function testListManagers(): void
    {
        $this->mockRequest([
            'uri' => 'https://organization_domain.crowdin.com/api/v2/groups/1/managers',
            'method' => 'get',
            'response' => json_encode([
                'data' => [
                    [
                        'data' => [
                            'id' => 27,
                            'user' => [
                                'id' => 12,
                                'username' => 'john_smith',
                                'firstName' => 'John',
                                'lastName' => 'Smith',
                                'avatarUrl' => '',
                                'fields' => [],
                                'isAdmin' => true,
                                'status' => 'active',
                                'createdAt' => '2019-07-11T07:40:22+00:00',
                                'lastSeen' => '2019-10-23T11:44:02+00:00',
                            ],
                            'teams' => [
                                [
                                    'id' => 2,
                                    'name' => 'Translators Team',
                                    'totalMembers' => 8,
                                    'webUrl' => 'https://example.crowdin.com/u/teams/1',
                                    'createdAt' => '2019-09-23T09:04:29+00:00',
                                    'updatedAt' => '2019-09-23T09:04:29+00:00',
                                ],
                            ],
                        ],
                    ],
                ],
                'pagination' => [
                    'offset' => 0,
                    'limit' => 25,
                ],
            ]),
        ]);

        $managers = $this->crowdin->group->listManagers(1);

        $this->assertInstanceOf(ModelCollection::class, $managers);
        $this->assertCount(1, $managers);
        $this->assertInstanceOf(GroupManager::class, $managers[0]);
        $this->assertEquals(27, $managers[0]->getId());
        $this->assertInstanceOf(User::class, $managers[0]->getUser());
        $this->assertEquals('john_smith', $managers[0]->getUser()->getUsername());
        $this->assertCount(1, $managers[0]->getTeams());
        $this->assertEquals('Translators Team', $managers[0]->getTeams()[0]->getName());
    }

    public function testUpdateManagers(): void
    {
        $this->mockRequest([
            'uri' => 'https://organization_domain.crowdin.com/api/v2/groups/1/managers',
            'method' => 'patch',
            'response' => json_encode([
                'data' => [
                    [
                        'data' => [
                            'id' => 27,
                            'user' => [
                                'id' => 18,
                                'username' => 'john_smith',
                                'firstName' => 'John',
                                'lastName' => 'Smith',
                                'avatarUrl' => '',
                                'fields' => [],
                                'isAdmin' => true,
                                'status' => 'active',
                                'createdAt' => '2019-07-11T07:40:22+00:00',
                                'lastSeen' => '2019-10-23T11:44:02+00:00',
                            ],
                            'teams' => [
                                [
                                    'id' => 2,
                                    'name' => 'Translators Team',
                                    'totalMembers' => 8,
                                    'webUrl' => 'https://example.crowdin.com/u/teams/1',
                                    'createdAt' => '2019-09-23T09:04:29+00:00',
                                    'updatedAt' => '2019-09-23T09:04:29+00:00',
                                ],
                            ],
                        ],
                    ],
                ],
            ]),
        ]);

        $data = [
            [
                'op' => 'add',
                'path' => '/-',
                'value' => [
                    'userId' => 18,
                ],
            ],
            [
                'op' => 'remove',
                'path' => '/24',
            ],
        ];

        $managers = $this->crowdin->group->updateManagers(1, $data);

        $this->assertInstanceOf(ModelCollection::class, $managers);
        $this->assertCount(1, $managers);
        $this->assertInstanceOf(GroupManager::class, $managers[0]);
        $this->assertEquals(27, $managers[0]->getId());
    }

    public function testGetManager(): void
    {
        $this->mockRequest([
            'uri' => 'https://organization_domain.crowdin.com/api/v2/groups/1/managers/12',
            'method' => 'get',
            'response' => json_encode([
                'data' => [
                    'id' => 27,
                    'user' => [
                        'id' => 12,
                        'username' => 'john_smith',
                        'firstName' => 'John',
                        'lastName' => 'Smith',
                        'avatarUrl' => '',
                        'fields' => [],
                        'isAdmin' => true,
                        'status' => 'active',
                        'createdAt' => '2019-07-11T07:40:22+00:00',
                        'lastSeen' => '2019-10-23T11:44:02+00:00',
                    ],
                    'teams' => [
                        [
                            'id' => 2,
                            'name' => 'Translators Team',
                            'totalMembers' => 8,
                            'webUrl' => 'https://example.crowdin.com/u/teams/1',
                            'createdAt' => '2019-09-23T09:04:29+00:00',
                            'updatedAt' => '2019-09-23T09:04:29+00:00',
                        ],
                    ],
                ],
            ]),
        ]);

        $manager = $this->crowdin->group->getManager(1, 12);

        $this->assertInstanceOf(GroupManager::class, $manager);
        $this->assertEquals(27, $manager->getId());
        $this->assertInstanceOf(User::class, $manager->getUser());
        $this->assertEquals('john_smith', $manager->getUser()->getUsername());
        $this->assertCount(1, $manager->getTeams());
        $this->assertEquals('Translators Team', $manager->getTeams()[0]->getName());
    }

    public function testListTeams(): void
    {
        $this->mockRequest([
            'uri' => 'https://organization_domain.crowdin.com/api/v2/groups/1/teams',
            'method' => 'get',
            'response' => json_encode([
                'data' => [
                    [
                        'data' => [
                            'id' => 27,
                            'team' => [
                                'id' => 2,
                                'name' => 'Translators Team',
                                'totalMembers' => 8,
                                'webUrl' => 'https://example.crowdin.com/u/teams/1',
                                'createdAt' => '2019-09-23T09:04:29+00:00',
                                'updatedAt' => '2019-09-23T09:04:29+00:00',
                            ],
                        ],
                    ],
                ],
                'pagination' => [
                    'offset' => 0,
                    'limit' => 25,
                ],
            ]),
        ]);

        $teams = $this->crowdin->group->listTeams(1);

        $this->assertInstanceOf(ModelCollection::class, $teams);
        $this->assertCount(1, $teams);
        $this->assertInstanceOf(GroupTeam::class, $teams[0]);
        $this->assertEquals(27, $teams[0]->getId());
        $this->assertInstanceOf(Team::class, $teams[0]->getTeam());
        $this->assertEquals('Translators Team', $teams[0]->getTeam()->getName());
    }

    public function testUpdateTeams(): void
    {
        $this->mockRequest([
            'uri' => 'https://organization_domain.crowdin.com/api/v2/groups/1/teams',
            'method' => 'patch',
            'response' => json_encode([
                'data' => [
                    [
                        'data' => [
                            'id' => 27,
                            'team' => [
                                'id' => 2,
                                'name' => 'Translators Team',
                                'totalMembers' => 8,
                                'webUrl' => 'https://example.crowdin.com/u/teams/1',
                                'createdAt' => '2019-09-23T09:04:29+00:00',
                                'updatedAt' => '2019-09-23T09:04:29+00:00',
                            ],
                        ],
                    ],
                ],
            ]),
        ]);

        $data = [
            [
                'op' => 'add',
                'path' => '/-',
                'value' => [
                    'teamId' => 18,
                ],
            ],
            [
                'op' => 'remove',
                'path' => '/24',
            ],
        ];

        $teams = $this->crowdin->group->updateTeams(1, $data);

        $this->assertInstanceOf(ModelCollection::class, $teams);
        $this->assertCount(1, $teams);
        $this->assertInstanceOf(GroupTeam::class, $teams[0]);
        $this->assertEquals(27, $teams[0]->getId());
    }

    public function testGetTeam(): void
    {
        $this->mockRequest([
            'uri' => 'https://organization_domain.crowdin.com/api/v2/groups/1/teams/2',
            'method' => 'get',
            'response' => json_encode([
                'data' => [
                    'id' => 27,
                    'team' => [
                        'id' => 2,
                        'name' => 'Translators Team',
                        'totalMembers' => 8,
                        'webUrl' => 'https://example.crowdin.com/u/teams/1',
                        'createdAt' => '2019-09-23T09:04:29+00:00',
                        'updatedAt' => '2019-09-23T09:04:29+00:00',
                    ],
                ],
            ]),
        ]);

        $team = $this->crowdin->group->getTeam(1, 2);

        $this->assertInstanceOf(GroupTeam::class, $team);
        $this->assertEquals(27, $team->getId());
        $this->assertInstanceOf(Team::class, $team->getTeam());
        $this->assertEquals('Translators Team', $team->getTeam()->getName());
    }
}
