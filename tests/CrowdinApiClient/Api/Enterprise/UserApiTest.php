<?php

namespace CrowdinApiClient\Tests\Api\Enterprise;

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
                'it' => ['workflowStepIds' => [313]]
            ]
        ];

        $this->mockRequest([
            'path' => '/projects/1/members',
            'method' => 'post',
            'body' => json_encode($params),
            'response' => '{
            "skipped": [],
            "added": [
                {
                    "data": {
                        "id": 1,
                        "username": "john_smith",
                        "firstName": "John",
                        "lastName": "Smith",
                        "isManager": false,
                        "managerOfGroup": {
                            "id": 1,
                            "name": "KB materials"
                        },
                        "accessToAllWorkflowSteps": false,
                        "permissions": {
                            "it": {
                                "workflowStepIds": [
                                    313
                                ]
                            }
                        },
                        "givenAccessAt": "2019-10-23T11:44:02+00:00"
                    }
                }
            ],
            "pagination": {
                "offset": 0,
                "limit": 25
            }
        }'
        ]);

        $projectTeamMemberAddedStatistics = $this->crowdin->user->addProjectTeamMember(1, $params);
        $this->assertInstanceOf(ProjectTeamMemberAddedStatistics::class, $projectTeamMemberAddedStatistics);
        $this->assertEquals([], $projectTeamMemberAddedStatistics->getSkipped());
    }

    public function testListProjectMembers()
    {
        $this->mockRequestGet('/projects/1/members', '{
                  "data": [
                    {
                      "data": {
                        "id": 1,
                        "username": "john_smith",
                        "firstName": "John",
                        "lastName": "Smith",
                        "isManager": true,
                        "managerOfGroup": {"id": 1, "name": "Marketing materials"},
                        "accessToAllWorkflowSteps": true,
                        "permissions": {"it": {"workflowStepIds": [313]}},
                        "givenAccessAt": "2019-10-23T11:44:02+00:00"
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
        );

        $members = $this->crowdin->user->listProjectMembers(1, []);

        $this->assertInstanceOf(ModelCollection::class, $members);
        $this->assertCount(1, $members);
        $this->assertInstanceOf(ProjectTeamMemberResource::class, $members[0]);
        $this->assertEquals(1, $members[0]->getId());
    }

    public function testGetProjectMemberPermissions()
    {
        $this->mockRequestGet('/projects/1/members/1', '{
              "data": {
                "id": 1,
                "username": "john_smith",
                "firstName": "John",
                "lastName": "Smith",
                "isManager": true,
                "managerOfGroup": {"id": 1, "name": "Marketing materials"},
                "accessToAllWorkflowSteps": true,
                "permissions": {"it": {"workflowStepIds": [313]}},
                "givenAccessAt": "2019-10-23T11:44:02+00:00"
              }
        }');

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
            'response' => '{
              "data": {
                "id": 1,
                "username": "john_smith",
                "firstName": "John",
                "lastName": "Smith",
                "isManager": true,
                "managerOfGroup": {"id": 1, "name": "Marketing materials"},
                "accessToAllWorkflowSteps": true,
                "permissions": {"it": {"workflowStepIds": [1,2,3]}},
                "givenAccessAt": "2019-10-23T11:44:02+00:00"
              }
            }'
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
            'response' => '{
                  "data": [
                    {
                      "data": {
                        "id": 1,
                        "username": "john_smith",
                        "email": "jsmith@example.com",
                        "firstName": "John",
                        "lastName": "Smith",
                        "status": "active",
                        "avatarUrl": "",
                        "createdAt": "2019-07-11T07:40:22+00:00",
                        "lastSeen": "2019-10-23T11:44:02+00:00",
                        "twoFactor": "enabled",
                        "isAdmin": true,
                        "timezone": "Europe/Kiev"
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

        $users = $this->crowdin->user->list();

        $this->assertInstanceOf(ModelCollection::class, $users);
        $this->assertCount(1, $users);
        $this->assertInstanceOf(User::class, $users[0]);
        $this->assertEquals(1, $users[0]->getId());
    }

    public function testGetUser()
    {
        $this->mockRequestGet('/users/1', '{
              "data": {
                "id": 1,
                "username": "john_smith",
                "email": "jsmith@example.com",
                "firstName": "John",
                "lastName": "Smith",
                "status": "active",
                "avatarUrl": "",
                "createdAt": "2019-07-11T07:40:22+00:00",
                "lastSeen": "2019-10-23T11:44:02+00:00",
                "twoFactor": "enabled",
                "isAdmin": true,
                "timezone": "Europe/Kiev"
              }
            }');

        $user = $this->crowdin->user->get(1);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals(1, $user->getId());
    }

    public function testGetAuthenticatedUser()
    {
        $this->mockRequestGet('/user', '{
              "data": {
                "id": 1,
                "username": "john_smith",
                "email": "jsmith@example.com",
                "firstName": "John",
                "lastName": "Smith",
                "status": "active",
                "avatarUrl": "",
                "createdAt": "2019-07-11T07:40:22+00:00",
                "lastSeen": "2019-10-23T11:44:02+00:00",
                "twoFactor": "enabled",
                "isAdmin": true,
                "timezone": "Europe/Kiev"
              }
            }');

        $user = $this->crowdin->user->getAuthenticatedUser();

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals(1, $user->getId());
    }

    public function testInviteUser()
    {
        $this->mockRequest([
            'path' => '/users',
            'method' => 'post',
            'response' => '{
                  "data": {
                    "id": 1,
                    "username": "john_smith",
                    "email": "jsmith@example.com",
                    "firstName": "John",
                    "lastName": "Smith",
                    "status": "active",
                    "avatarUrl": "",
                    "createdAt": "2019-07-11T07:40:22+00:00",
                    "lastSeen": "2019-10-23T11:44:02+00:00",
                    "twoFactor": "enabled",
                    "isAdmin": true,
                    "timezone": "Europe/Kiev"
                  }
                }'
        ]);

        $user = $this->crowdin->user->invite([
            'email' => 'jsmith@example.com',
            'firstname' => 'John',
            'lastname' => 'Smith',
            'timezone' => 'Europe/Kiev'
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
        $this->mockRequestGet('/users/1', '{
              "data": {
                "id": 1,
                "username": "john_smith",
                "email": "jsmith@example.com",
                "firstName": "John",
                "lastName": "Smith",
                "status": "active",
                "avatarUrl": "",
                "createdAt": "2019-07-11T07:40:22+00:00",
                "lastSeen": "2019-10-23T11:44:02+00:00",
                "twoFactor": "enabled",
                "isAdmin": true,
                "timezone": "Europe/Kiev"
              }
            }');

        $user = $this->crowdin->user->get(1);
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals(1, $user->getId());

        $user->setFirstName('Joe');

        $this->mockRequestPatch('/users/1', '{
              "data": {
                "id": 1,
                "username": "john_smith",
                "email": "jsmith@example.com",
                "firstName": "Joe",
                "lastName": "Smith",
                "status": "active",
                "avatarUrl": "",
                "createdAt": "2019-07-11T07:40:22+00:00",
                "lastSeen": "2019-10-23T11:44:02+00:00",
                "twoFactor": "enabled",
                "isAdmin": true,
                "timezone": "Europe/Kiev"
              }
        }');

        $this->crowdin->user->update($user);
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals(1, $user->getId());
        $this->assertEquals('Joe', $user->getFirstName());
    }
}
