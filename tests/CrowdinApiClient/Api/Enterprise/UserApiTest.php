<?php

namespace CrowdinApiClient\Tests\Api\Enterprise;

use CrowdinApiClient\Model\Enterprise\ProjectContribution;
use CrowdinApiClient\Model\Enterprise\ProjectPermission;
use CrowdinApiClient\Model\Enterprise\ProjectTeamMemberAddedStatistics;
use CrowdinApiClient\Model\Enterprise\ProjectTeamMemberResource;
use CrowdinApiClient\Model\Enterprise\User;
use CrowdinApiClient\ModelCollection;

class UserApiTest extends AbstractTestApi
{
    public function testAddProjectTeamMember()
    {
        $params = [
            'userIds' => [1],
            'accessToAllWorkflowSteps' => false,
            'managerAccess' => false,
            'permissions' => [
                'it' => ['workflowStepIds' => [313]],
            ],
        ];

        $this->mockRequest([
            'path' => '/projects/1/members',
            'method' => 'post',
            'body' => json_encode($params),
            'response' => json_encode([
                'data' => [
                    'skipped' => [],
                    'added' => [
                        [
                            'data' => [
                                'id' => 1,
                                'username' => 'john_smith',
                                'firstName' => 'John',
                                'lastName' => 'Smith',
                                'isManager' => false,
                                'managerOfGroup' => ['id' => 1, 'name' => 'KB materials'],
                                'accessToAllWorkflowSteps' => false,
                                'permissions' => ['it' => ['workflowStepIds' => [313]]],
                                'givenAccessAt' => '2019-10-23T11:44:02+00:00',
                            ],
                        ],
                    ],
                    'pagination' => [
                        'offset' => 0,
                        'limit' => 25,
                    ],
                ],
            ]),
        ]);

        $projectTeamMemberAddedStatistics = $this->crowdin->user->addProjectTeamMember(1, $params);
        $this->assertInstanceOf(ProjectTeamMemberAddedStatistics::class, $projectTeamMemberAddedStatistics);
        $this->assertEquals([], $projectTeamMemberAddedStatistics->getSkipped());
    }

    public function testListProjectMembers()
    {
        $this->mockRequestGet(
            '/projects/1/members',
            json_encode([
                'data' => [
                    [
                        'data' => [
                            'id' => 1,
                            'username' => 'john_smith',
                            'firstName' => 'John',
                            'lastName' => 'Smith',
                            'isManager' => true,
                            'managerOfGroup' => ['id' => 1, 'name' => 'Marketing materials'],
                            'accessToAllWorkflowSteps' => true,
                            'permissions' => ['it' => ['workflowStepIds' => [313]]],
                            'givenAccessAt' => '2019-10-23T11:44:02+00:00',
                        ],
                    ],
                ],
                'pagination' => [
                    [
                        'offset' => 0,
                        'limit' => 0,
                    ],
                ],
            ])
        );

        $members = $this->crowdin->user->listProjectMembers(1, []);

        $this->assertInstanceOf(ModelCollection::class, $members);
        $this->assertCount(1, $members);
        $this->assertInstanceOf(ProjectTeamMemberResource::class, $members[0]);
        $this->assertEquals(1, $members[0]->getId());
    }

    public function testGetProjectMemberPermissions()
    {
        $this->mockRequestGet(
            '/projects/1/members/1',
            json_encode([
                'data' => [
                    'id' => 1,
                    'username' => 'john_smith',
                    'firstName' => 'John',
                    'lastName' => 'Smith',
                    'isManager' => true,
                    'managerOfGroup' => ['id' => 1, 'name' => 'Marketing materials'],
                    'accessToAllWorkflowSteps' => true,
                    'permissions' => ['it' => ['workflowStepIds' => [313]]],
                    'givenAccessAt' => '2019-10-23T11:44:02+00:00',
                ],
            ])
        );
        $member = $this->crowdin->user->getProjectMemberPermissions(1, 1);

        $this->assertInstanceOf(ProjectTeamMemberResource::class, $member);
        $this->assertEquals(1, $member->getId());
    }

    public function testReplaceProjectMemberPermissions()
    {
        $params = [
            'managerAccess' => true,
            'permissions' => [
                'it' => [
                    'workflowStepIds' => [1, 2, 3],
                ],
            ],
        ];

        $this->mockRequest([
            'path' => '/projects/1/members/1',
            'method' => 'put',
            'body' => json_encode($params),
            'response' => json_encode([
                'data' => [
                    'id' => 1,
                    'username' => 'john_smith',
                    'firstName' => 'John',
                    'lastName' => 'Smith',
                    'isManager' => true,
                    'managerOfGroup' => ['id' => 1, 'name' => 'Marketing materials'],
                    'accessToAllWorkflowSteps' => true,
                    'permissions' => ['it' => ['workflowStepIds' => [1, 2, 3]]],
                    'givenAccessAt' => '2019-10-23T11:44:02+00:00',
                ],
            ]),
        ]);

        $member = $this->crowdin->user->replaceProjectMemberPermissions(1, 1, $params);

        $this->assertInstanceOf(ProjectTeamMemberResource::class, $member);
        $this->assertEquals(['it' => ['workflowStepIds' => [1, 2, 3]]], $member->getPermissions());
        $this->assertEquals(true, $member->isManager());
    }

    public function testDelete()
    {
        $this->mockRequest([
            'path' => '/projects/2/members/1',
            'method' => 'delete',
        ]);

        $this->crowdin->user->deleteMemberFromProject(2, 1);
    }

    public function testList()
    {
        $this->mockRequest([
            'path' => '/users',
            'method' => 'get',
            'response' => json_encode([
                'data' => [
                    [
                        'data' => [
                            'id' => 1,
                            'username' => 'john_smith',
                            'email' => 'jsmith@example.com',
                            'firstName' => 'John',
                            'lastName' => 'Smith',
                            'status' => 'active',
                            'avatarUrl' => '',
                            'createdAt' => '2019-07-11T07:40:22+00:00',
                            'lastSeen' => '2019-10-23T11:44:02+00:00',
                            'twoFactor' => 'enabled',
                            'isAdmin' => true,
                            'timezone' => 'Europe/Kyiv',
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

        $users = $this->crowdin->user->list();

        $this->assertInstanceOf(ModelCollection::class, $users);
        $this->assertCount(1, $users);
        $this->assertInstanceOf(User::class, $users[0]);
        $this->assertEquals(1, $users[0]->getId());
    }

    public function testGetUser()
    {
        $this->mockRequestGet(
            '/users/1',
            json_encode([
                'data' => [
                    'id' => 1,
                    'username' => 'john_smith',
                    'email' => 'jsmith@example.com',
                    'firstName' => 'John',
                    'lastName' => 'Smith',
                    'status' => 'active',
                    'avatarUrl' => '',
                    'createdAt' => '2019-07-11T07:40:22+00:00',
                    'lastSeen' => '2019-10-23T11:44:02+00:00',
                    'twoFactor' => 'enabled',
                    'isAdmin' => true,
                    'timezone' => 'Europe/Kyiv',
                ],
            ])
        );

        $user = $this->crowdin->user->get(1);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals(1, $user->getId());
    }

    public function testGetAuthenticatedUser()
    {
        $this->mockRequestGet(
            '/user',
            json_encode([
                'data' => [
                    'id' => 1,
                    'username' => 'john_smith',
                    'email' => 'jsmith@example.com',
                    'firstName' => 'John',
                    'lastName' => 'Smith',
                    'status' => 'active',
                    'avatarUrl' => '',
                    'createdAt' => '2019-07-11T07:40:22+00:00',
                    'lastSeen' => '2019-10-23T11:44:02+00:00',
                    'twoFactor' => 'enabled',
                    'isAdmin' => true,
                    'timezone' => 'Europe/Kyiv',
                ],
            ])
        );

        $user = $this->crowdin->user->getAuthenticatedUser();

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals(1, $user->getId());
    }

    public function testInviteUser()
    {
        $this->mockRequest([
            'path' => '/users',
            'method' => 'post',
            'response' => json_encode([
                'data' => [
                    'id' => 1,
                    'username' => 'john_smith',
                    'email' => 'jsmith@example.com',
                    'firstName' => 'John',
                    'lastName' => 'Smith',
                    'status' => 'active',
                    'avatarUrl' => '',
                    'createdAt' => '2019-07-11T07:40:22+00:00',
                    'lastSeen' => '2019-10-23T11:44:02+00:00',
                    'twoFactor' => 'enabled',
                    'isAdmin' => true,
                    'timezone' => 'Europe/Kyiv',
                ],
            ]),
        ]);

        $user = $this->crowdin->user->invite([
            'email' => 'jsmith@example.com',
            'firstname' => 'John',
            'lastname' => 'Smith',
            'timezone' => 'Europe/Kyiv',
        ]);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals(1, $user->getId());
    }

    public function testDeleteUser()
    {
        $this->mockRequestDelete('/users/2');
        $this->crowdin->user->delete(2);
    }

    public function testGetAndUpdateUser()
    {
        $this->mockRequestGet(
            '/users/1',
            json_encode([
                'data' => [
                    'id' => 1,
                    'username' => 'john_smith',
                    'email' => 'jsmith@example.com',
                    'firstName' => 'John',
                    'lastName' => 'Smith',
                    'status' => 'active',
                    'avatarUrl' => '',
                    'createdAt' => '2019-07-11T07:40:22+00:00',
                    'lastSeen' => '2019-10-23T11:44:02+00:00',
                    'twoFactor' => 'enabled',
                    'isAdmin' => true,
                    'timezone' => 'Europe/Kyiv',
                ],
            ])
        );

        $user = $this->crowdin->user->get(1);
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals(1, $user->getId());

        $user->setFirstName('Joe');

        $this->mockRequestPatch(
            '/users/1',
            json_encode([
                'data' => [
                    'id' => 1,
                    'username' => 'john_smith',
                    'email' => 'jsmith@example.com',
                    'firstName' => 'Joe',
                    'lastName' => 'Smith',
                    'status' => 'active',
                    'avatarUrl' => '',
                    'createdAt' => '2019-07-11T07:40:22+00:00',
                    'lastSeen' => '2019-10-23T11:44:02+00:00',
                    'twoFactor' => 'enabled',
                    'isAdmin' => true,
                    'timezone' => 'Europe/Kyiv',
                ],
            ])
        );
        $this->crowdin->user->update($user);
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals(1, $user->getId());
        $this->assertEquals('Joe', $user->getFirstName());
    }

    public function testListProjectPermissions(): void
    {
        $this->mockRequestGet(
            '/users/7/projects/permissions',
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

        $permissions = $this->crowdin->user->listProjectPermissions(7);

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
            'path' => '/users/7/projects/permissions',
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

        $permissions = $this->crowdin->user->updateProjectPermissions(7, $data);

        $this->assertInstanceOf(ModelCollection::class, $permissions);
        $this->assertInstanceOf(ProjectPermission::class, $permissions[0]);
    }

    public function testListProjectContributions(): void
    {
        $this->mockRequestGet(
            '/users/7/projects/contributions',
            json_encode([
                'data' => [
                    [
                        'data' => [
                            'id' => 2,
                            'translated' => ['strings' => 10, 'words' => 42],
                            'approved' => ['strings' => 3, 'words' => 12],
                            'voted' => ['strings' => 0, 'words' => 0],
                            'commented' => ['strings' => 1, 'words' => 0],
                            'project' => ['id' => 2, 'name' => 'Knowledge Base', 'identifier' => 'knowledge-base'],
                        ],
                    ],
                ],
                'pagination' => ['offset' => 0, 'limit' => 25],
            ])
        );

        $contributions = $this->crowdin->user->listProjectContributions(7);

        $this->assertInstanceOf(ModelCollection::class, $contributions);
        $this->assertCount(1, $contributions);
        $this->assertInstanceOf(ProjectContribution::class, $contributions[0]);
        $this->assertEquals(42, $contributions[0]->getTranslated()['words']);
        $this->assertEquals(2, $contributions[0]->getProject()->getId());
    }
}
