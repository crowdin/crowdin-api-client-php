<?php

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\ProjectMember;
use CrowdinApiClient\Model\ProjectMemberAddedStatistics;
use CrowdinApiClient\Model\User;

class UserApiTest extends AbstractTestApi
{
    public function testGetAuthenticatedUser()
    {
        $this->mockRequestGet(
            '/user',
            json_encode([
                'data' => [
                    'id' => 1,
                    'username' => 'john_smith',
                    'email' => 'jsmith@example.com',
                    'fullName' => 'John Smith',
                    'avatarUrl' => '',
                    'createdAt' => '2019-07-11T07:40:22+00:00',
                    'lastSeen' => '2019-10-23T11:44:02+00:00',
                    'twoFactor' => 'enabled',
                    'timezone' => 'Europe/Kyiv',
                ],
            ])
        );

        $user = $this->crowdin->user->getAuthenticatedUser();

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals(1, $user->getId());
    }

    public function testUpdateAuthenticatedUser(): void
    {
        $this->mockRequestPatch(
            '/user',
            json_encode([
                'data' => [
                    'id' => 1,
                    'username' => 'john_smith',
                    'email' => 'jsmith@example.com',
                    'fullName' => 'John Smith',
                    'avatarUrl' => '',
                    'createdAt' => '2019-07-11T07:40:22+00:00',
                    'lastSeen' => '2019-10-23T11:44:02+00:00',
                    'twoFactor' => 'enabled',
                    'timezone' => 'Europe/Kyiv',
                ],
            ])
        );

        $user = new User([
            'id' => 1,
            'username' => 'john_smith',
            'email' => 'jsmith@example.com',
            'fullName' => 'John Smith',
            'avatarUrl' => '',
            'createdAt' => '2019-07-11T07:40:22+00:00',
            'lastSeen' => '2019-10-23T11:44:02+00:00',
            'twoFactor' => 'enabled',
            'timezone' => 'Europe/Kyiv',
        ]);

        $user = $this->crowdin->user->updateAuthenticatedUser($user);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals(1, $user->getId());
    }

    public function testList()
    {
        $this->mockRequestGet(
            '/projects/1/members',
            json_encode([
                'data' => [
                    [
                        'data' => [
                            'id' => 1,
                            'username' => 'john_smith',
                            'fullName' => 'John Smith',
                            'role' => 'translator',
                            'permissions' => [
                                'uk' => 'translator',
                                'it' => 'proofreader',
                                'en' => 'denied',
                            ],
                            'avatarUrl' => '',
                            'joinedAt' => '2019-07-11T07:40:22+00:00',
                            'timezone' => 'Europe/Kyiv',
                        ],
                    ],
                ],
                'pagination' => [
                    [
                        'offset' => 0,
                        'limit' => 25,
                    ],
                ],
            ])
        );

        $users = $this->crowdin->user->list(1);
        /** @var User $user */
        $user = $users[0];

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals(1, $user->getId());
    }

    public function testGet()
    {
        $this->mockRequestGet(
            '/projects/1/members/1',
            json_encode([
                'data' => [
                    'id' => 1,
                    'username' => 'john_smith',
                    'fullName' => 'John Smith',
                    'role' => 'translator',
                    'permissions' => [
                        'uk' => 'translator',
                        'it' => 'proofreader',
                        'en' => 'denied',
                    ],
                    'avatarUrl' => '',
                    'joinedAt' => '2019-07-11T07:40:22+00:00',
                    'timezone' => 'Europe/Kyiv',
                ],
            ])
        );

        $user = $this->crowdin->user->get(1, 1);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals(1, $user->getId());
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
                            'fullName' => 'John Smith',
                            'role' => 'translator',
                            'permissions' => [
                                'uk' => 'translator',
                                'it' => 'proofreader',
                                'en' => 'denied',
                            ],
                            'roles' => [
                                [
                                    'name' => 'translator',
                                ],
                            ],
                            'avatarUrl' => '',
                            'joinedAt' => '2019-07-11T07:40:22+00:00',
                            'timezone' => 'Europe/Kyiv',
                        ],
                    ],
                ],
                'pagination' => [
                    [
                        'offset' => 0,
                        'limit' => 25,
                    ],
                ],
            ])
        );

        $projectMembers = $this->crowdin->user->listProjectMembers(1);
        /** @var ProjectMember $projectMember */
        $projectMember = $projectMembers[0];

        $this->assertInstanceOf(ProjectMember::class, $projectMember);
        $this->assertEquals(1, $projectMember->getId());
        $this->assertEquals('translator', $projectMember->getRole());
    }

    public function testAddProjectTeamMember(): void
    {
        $emails = [
            'emails' => ['jsmith@example.com'],
        ];
        $members = [
            [
                'id' => 12,
                'username' => 'jsmith@example.com',
                'fullName' => '',
                'role' => 'member',
                'permissions' => [],
                'avatarUrl' => '',
                'joinedAt' => '2026-07-11T07:40:22+00:00',
                'timezone' => 'Europe/Kyiv',
            ],
        ];
        $this->mockRequestPost(
            '/projects/1/members',
            json_encode($emails),
            json_encode([
                'data' => [
                    'skipped' => [],
                    'updated' => [],
                    'added' => $members,
                    'pagination' => [
                        'offset' => 0,
                        'limit' => 25,
                    ],
                ],
            ])
        );

        $statistics = $this->crowdin->user->addProjectMember(1, $emails);

        $this->assertInstanceOf(ProjectMemberAddedStatistics::class, $statistics);
        $this->assertIsArray($statistics->getAdded());
        $this->assertEquals($members, $statistics->getAdded());
    }

    public function testGetProjectMemberInfo()
    {
        $this->mockRequestGet(
            '/projects/1/members/1',
            json_encode([
                'data' => [
                    'id' => 1,
                    'username' => 'john_smith',
                    'fullName' => 'John Smith',
                    'role' => 'translator',
                    'permissions' => [
                        'uk' => 'translator',
                        'it' => 'proofreader',
                        'en' => 'denied',
                    ],
                    'roles' => [
                        [
                            'name' => 'translator',
                        ],
                    ],
                    'avatarUrl' => '',
                    'joinedAt' => '2019-07-11T07:40:22+00:00',
                    'timezone' => 'Europe/Kyiv',
                ],
            ])
        );

        $projectMember = $this->crowdin->user->getProjectMemberInfo(1, 1);

        $this->assertInstanceOf(ProjectMember::class, $projectMember);
        $this->assertEquals(1, $projectMember->getId());
        $this->assertEquals('translator', $projectMember->getRole());
    }

    public function testReplaceProjectMemberPermissions(): void
    {
        $roles = [
            'name' => 'translator',
            'permissions' => [
                'allLanguages' => true,
                'languageAccess' => []
            ],
        ];

        $this->mockRequestPut(
            '/projects/1/members/1',
            json_encode([
                'data' => [
                    'id' => 1,
                    'username' => 'john_smith',
                    'fullName' => 'John Smith',
                    'role' => 'translator',
                    'permissions' => [
                        'uk' => 'translator',
                        'it' => 'proofreader',
                        'en' => 'denied',
                    ],
                    'roles' => [
                        'name' => 'translator',
                        'permissions' => [
                            'allLanguages' => true,
                            'languageAccess' => []
                        ],
                    ],
                    'avatarUrl' => '',
                    'joinedAt' => '2019-07-11T07:40:22+00:00',
                    'timezone' => 'Europe/Kyiv',
                ],
            ])
        );

        $member = $this->crowdin->user->replaceProjectMemberPermissions(1, 1, [
            'roles' => $roles,
        ]);

        $this->assertInstanceOf(ProjectMember::class, $member);
        $this->assertEquals(1, $member->getId());
        $this->assertEquals($roles, $member->getRoles());
    }

    public function testDeleteMemberFromProject(): void
    {
        $this->mockRequestDelete('/projects/1/members/1');

        $this->crowdin->user->deleteMemberFromProject(1, 1);
    }
}
