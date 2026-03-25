<?php

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\HourlyReportSettingsTemplateConfig;
use CrowdinApiClient\Model\HourlyUserReportSettingsTemplate;
use CrowdinApiClient\Model\ProjectMember;
use CrowdinApiClient\Model\ProjectMemberAddedStatistics;
use CrowdinApiClient\Model\ReportSettingsTemplateConfig;
use CrowdinApiClient\Model\User;
use CrowdinApiClient\Model\UserReportSettingsTemplate;
use CrowdinApiClient\ModelCollection;

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
                'languageAccess' => [],
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
                            'languageAccess' => [],
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

    public function listReportsDataProvider(): array
    {
        $pagination = [
            'offset' => 0,
            'limit' => 25,
        ];

        return [
            'userReportSettingsTemplate' => [
                'requestData' => [
                    'data' => [
                        [
                            'data' => [
                                'id' => 1,
                                'name' => 'Default template',
                                'currency' => 'USD',
                                'unit' => 'words',
                                'config' => [
                                    'baseRates' => [
                                        'fullTranslation' => 0.1,
                                        'proofread' => 0.12,
                                    ],
                                    'individualRates' => [
                                        [
                                            'languageIds' => ['uk'],
                                            'userIds' => [],
                                            'fullTranslation' => 0.1,
                                            'proofread' => 0.12,
                                        ],
                                    ],
                                    'netRateSchemes' => [
                                        'tmMatch' => [
                                            [
                                                'matchType' => '100',
                                                'price' => 0.1,
                                            ],
                                        ],
                                        'mtMatch' => [
                                            [
                                                'matchType' => '100-82',
                                                'price' => 0.1,
                                            ],
                                        ],
                                        'aiMatch' => [
                                            [
                                                'matchType' => '100-74',
                                                'price' => 0.1,
                                            ],
                                        ],
                                        'suggestionMatch' => [
                                            [
                                                'matchType' => 'perfect',
                                                'price' => 0.1,
                                            ],
                                        ],
                                    ],
                                    'calculateInternalMatches' => false,
                                    'includePreTranslatedStrings' => false,
                                    'excludeApprovalsForEditedTranslations' => false,
                                    'preTranslatedStringsCategorizationAdjustment' => false,
                                ],
                                'createdAt' => '2019-09-23T11:26:54+00:00',
                                'updatedAt' => '2019-09-23T11:26:54+00:00',
                            ],
                        ],
                    ],
                    'pagination' => $pagination,
                ],
                'className' => UserReportSettingsTemplate::class,
                'configClassName' => ReportSettingsTemplateConfig::class,
            ],
            'hourlyUserReportSettingsTemplate' => [
                'requestData' => [
                    'data' => [
                        [
                            'data' => [
                                'id' => 12,
                                'name' => 'Hourly template',
                                'currency' => 'USD',
                                'unit' => 'hours',
                                'config' => [
                                    'baseRates' => [
                                        'hourly' => 50.0,
                                    ],
                                    'individualRates' => [
                                        [
                                            'languageIds' => ['uk'],
                                            'userIds' => [8],
                                            'hourly' => 75.0,
                                        ],
                                    ],
                                ],
                                'createdAt' => '2025-01-23T15:23:11+00:00',
                                'updatedAt' => '2025-01-23T15:35:49+00:00',
                            ],
                        ],
                    ],
                    'pagination' => $pagination,
                ],
                'className' => HourlyUserReportSettingsTemplate::class,
                'configClassName' => HourlyReportSettingsTemplateConfig::class,
            ],
        ];
    }

    /**
     * @dataProvider listReportsDataProvider
     */
    public function testListReportsSettingsTemplates(
        array $requestData,
        string $className,
        string $configClassName
    ): void {
        $this->mockRequestGet(
            '/users/1/reports/settings-templates?limit=25&offset=0',
            json_encode($requestData)
        );

        $templates = $this->crowdin->user->listReportSettingsTemplates(1, ['limit' => 25, 'offset' => 0]);
        $data = $requestData['data'][0]['data'];

        $this->assertInstanceOf(ModelCollection::class, $templates);
        $this->assertCount(1, $templates);
        $this->assertInstanceOf($className, $templates[0]);
        $this->assertEquals($data['id'], $templates[0]->getId());
        $this->assertEquals($data['name'], $templates[0]->getName());
        $this->assertEquals($data['currency'], $templates[0]->getCurrency());
        $this->assertEquals($data['unit'], $templates[0]->getUnit());
        $this->assertInstanceOf($configClassName, $templates[0]->getConfig());
    }

    public function testCreateReportSettingsTemplate(): void
    {
        $this->mockRequestPost(
            '/users/1/reports/settings-templates',
            json_encode([
                'name' => 'Default template',
                'currency' => 'USD',
                'unit' => 'words',
                'config' => [
                    'baseRates' => [
                        'fullTranslation' => 0.1,
                        'proofread' => 0.12,
                    ],
                    'individualRates' => [],
                    'netRateSchemes' => [
                        'tmMatch' => [],
                        'mtMatch' => [],
                        'aiMatch' => [],
                        'suggestionMatch' => [],
                    ],
                ],
            ]),
            json_encode([
                'data' => [
                    'id' => 1,
                    'name' => 'Default template',
                    'currency' => 'USD',
                    'unit' => 'words',
                    'config' => [
                        'baseRates' => [
                            'fullTranslation' => 0.1,
                            'proofread' => 0.12,
                        ],
                        'individualRates' => [],
                        'netRateSchemes' => [
                            'tmMatch' => [],
                            'mtMatch' => [],
                            'aiMatch' => [],
                            'suggestionMatch' => [],
                        ],
                    ],
                    'isPublic' => false,
                    'isGlobal' => false,
                    'createdAt' => '2019-09-23T11:26:54+00:00',
                    'updatedAt' => null,
                ],
            ])
        );

        $params = [
            'name' => 'Default template',
            'currency' => 'USD',
            'unit' => 'words',
            'config' => [
                'baseRates' => [
                    'fullTranslation' => 0.1,
                    'proofread' => 0.12,
                ],
                'individualRates' => [],
                'netRateSchemes' => [
                    'tmMatch' => [],
                    'mtMatch' => [],
                    'aiMatch' => [],
                    'suggestionMatch' => [],
                ],
            ],
        ];

        $template = $this->crowdin->user->createReportSettingsTemplate(1, $params);

        $this->assertInstanceOf(UserReportSettingsTemplate::class, $template);
        $this->assertEquals(1, $template->getId());
        $this->assertEquals('Default template', $template->getName());
        $this->assertEquals('USD', $template->getCurrency());
    }

    public function getReportSettingsTemplateDataProvider(): array
    {
        return [
            'userReportSettingsTemplate' => [
                'requestData' => [
                    'data' => [
                        'id' => 1,
                        'name' => 'Default template',
                        'currency' => 'USD',
                        'unit' => 'words',
                        'config' => [
                            'baseRates' => [
                                'fullTranslation' => 0.1,
                                'proofread' => 0.12,
                            ],
                            'individualRates' => [
                                [
                                    'languageIds' => ['uk'],
                                    'userIds' => [],
                                    'fullTranslation' => 0.1,
                                    'proofread' => 0.12,
                                ],
                            ],
                            'netRateSchemes' => [
                                'tmMatch' => [
                                    [
                                        'matchType' => '100',
                                        'price' => 0.1,
                                    ],
                                ],
                                'mtMatch' => [
                                    [
                                        'matchType' => '100-82',
                                        'price' => 0.1,
                                    ],
                                ],
                                'aiMatch' => [
                                    [
                                        'matchType' => '100-74',
                                        'price' => 0.1,
                                    ],
                                ],
                                'suggestionMatch' => [
                                    [
                                        'matchType' => 'perfect',
                                        'price' => 0.1,
                                    ],
                                ],
                            ],
                            'calculateInternalMatches' => false,
                            'includePreTranslatedStrings' => false,
                            'excludeApprovalsForEditedTranslations' => false,
                            'preTranslatedStringsCategorizationAdjustment' => false,
                        ],
                        'createdAt' => '2019-09-23T11:26:54+00:00',
                        'updatedAt' => '2019-09-23T11:26:54+00:00',
                    ],
                ],
                'className' => UserReportSettingsTemplate::class,
                'configClassName' => ReportSettingsTemplateConfig::class,
            ],
            'hourlyUserReportSettingsTemplate' => [
                'requestData' => [
                    'data' => [
                        'id' => 12,
                        'name' => 'Hourly template',
                        'currency' => 'USD',
                        'unit' => 'hours',
                        'config' => [
                            'baseRates' => [
                                'hourly' => 50.0,
                            ],
                            'individualRates' => [
                                [
                                    'languageIds' => ['uk'],
                                    'userIds' => [8],
                                    'hourly' => 75.0,
                                ],
                            ],
                        ],
                        'createdAt' => '2025-01-23T15:23:11+00:00',
                        'updatedAt' => '2025-01-23T15:35:49+00:00',
                    ],
                ],
                'className' => HourlyUserReportSettingsTemplate::class,
                'configClassName' => HourlyReportSettingsTemplateConfig::class,
            ],
        ];
    }

    /**
     * @dataProvider getReportSettingsTemplateDataProvider
     */
    public function testGetReportSettingsTemplate(array $requestData, string $className, string $configClassName): void
    {
        $this->mockRequestGet(
            '/users/1/reports/settings-templates/1',
            json_encode($requestData)
        );

        $template = $this->crowdin->user->getReportSettingsTemplate(1, 1);

        $this->assertInstanceOf($className, $template);
        $this->assertEquals($requestData['data']['id'], $template->getId());
        $this->assertEquals($requestData['data']['name'], $template->getName());
        $this->assertEquals($requestData['data']['currency'], $template->getCurrency());
        $this->assertInstanceOf($configClassName, $template->getConfig());
    }

    public function testDeleteReportSettingsTemplate(): void
    {
        $this->mockRequestDelete('/users/1/reports/settings-templates/1');

        $this->crowdin->user->deleteReportSettingsTemplate(1, 1);
    }

    public function testUpdateReportSettingsTemplate(): void
    {
        $this->mockRequestPatch(
            '/users/1/reports/settings-templates/1',
            json_encode([
                'data' => [
                    'id' => 1,
                    'name' => 'Updated template name',
                    'currency' => 'EUR',
                    'unit' => 'words',
                    'config' => [
                        'baseRates' => [
                            'fullTranslation' => 0.1,
                            'proofread' => 0.12,
                        ],
                        'individualRates' => [
                            [
                                'languageIds' => ['uk'],
                                'userIds' => [],
                                'fullTranslation' => 0.1,
                                'proofread' => 0.12,
                            ],
                        ],
                        'netRateSchemes' => [
                            'tmMatch' => [
                                [
                                    'matchType' => '100',
                                    'price' => 0.1,
                                ],
                            ],
                            'mtMatch' => [
                                [
                                    'matchType' => '100-82',
                                    'price' => 0.1,
                                ],
                            ],
                            'aiMatch' => [
                                [
                                    'matchType' => '100-74',
                                    'price' => 0.1,
                                ],
                            ],
                            'suggestionMatch' => [
                                [
                                    'matchType' => 'perfect',
                                    'price' => 0.1,
                                ],
                            ],
                        ],
                        'calculateInternalMatches' => false,
                        'includePreTranslatedStrings' => false,
                        'excludeApprovalsForEditedTranslations' => false,
                        'preTranslatedStringsCategorizationAdjustment' => false,
                    ],
                    'createdAt' => '2019-09-23T11:26:54+00:00',
                    'updatedAt' => '2019-09-23T11:26:54+00:00',
                ],
            ])
        );

        $template = new UserReportSettingsTemplate([
            'id' => 1,
            'name' => 'Default template',
            'currency' => 'USD',
            'unit' => 'words',
            'config' => [
                'baseRates' => [
                    'fullTranslation' => 0.1,
                    'proofread' => 0.12,
                ],
                'individualRates' => [
                    [
                        'languageIds' => ['uk'],
                        'userIds' => [],
                        'fullTranslation' => 0.1,
                        'proofread' => 0.12,
                    ],
                ],
                'netRateSchemes' => [
                    'tmMatch' => [
                        [
                            'matchType' => '100',
                            'price' => 0.1,
                        ],
                    ],
                    'mtMatch' => [
                        [
                            'matchType' => '100-82',
                            'price' => 0.1,
                        ],
                    ],
                    'aiMatch' => [
                        [
                            'matchType' => '100-74',
                            'price' => 0.1,
                        ],
                    ],
                    'suggestionMatch' => [
                        [
                            'matchType' => 'perfect',
                            'price' => 0.1,
                        ],
                    ],
                ],
                'calculateInternalMatches' => false,
                'includePreTranslatedStrings' => false,
                'excludeApprovalsForEditedTranslations' => false,
                'preTranslatedStringsCategorizationAdjustment' => false,
            ],
            'createdAt' => '2019-09-23T11:26:54+00:00',
            'updatedAt' => '2019-09-23T11:26:54+00:00',
        ]);
        $template->setName('Updated template name');
        $template->setCurrency('EUR');

        $result = $this->crowdin->user->updateReportSettingsTemplate(1, $template);

        $this->assertInstanceOf(UserReportSettingsTemplate::class, $result);
        $this->assertEquals(1, $result->getId());
        $this->assertEquals('Updated template name', $result->getName());
        $this->assertEquals('EUR', $result->getCurrency());
    }
}
