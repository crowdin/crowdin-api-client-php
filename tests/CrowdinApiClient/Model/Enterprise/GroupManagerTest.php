<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model\Enterprise;

use CrowdinApiClient\Model\Enterprise\GroupManager;
use CrowdinApiClient\Model\Enterprise\Team;
use CrowdinApiClient\Model\Enterprise\User;
use PHPUnit\Framework\TestCase;

class GroupManagerTest extends TestCase
{
    public $data = [
        'id' => 27,
        'user' => [
            'id' => 12,
            'username' => 'john_smith',
            'email' => 'jsmith@example.com',
            'firstName' => 'John',
            'lastName' => 'Smith',
            'avatarUrl' => 'https://example.com/avatar.png',
            'fields' => [
                'some-field' => 'some value',
            ],
            'isAdmin' => true,
            'status' => 'active',
            'createdAt' => '2019-07-11T07:40:22+00:00',
            'lastSeen' => '2019-10-23T11:44:02+00:00',
            'emailVerified' => false,
            'twoFactor' => 'enabled',
            'timezone' => 'Europe/Kyiv',
            'joinDetails' => [
                'type' => 'privateInvitation',
                'invitedBy' => [
                    'id' => 19,
                    'username' => 'john_doe',
                    'fullName' => 'John Doe',
                    'avatarUrl' => '',
                ],
            ],
            'deviceVerification' => 'enabled',
            'trustedDevicesCount' => 0,
            'apiTokensCount' => 0,
            'loginMethods' => ['crowdin'],
            'mfaMethods' => ['authenticatorApp'],
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
    ];

    public function testLoadData(): void
    {
        $manager = new GroupManager($this->data);

        $this->assertInstanceOf(User::class, $manager->getUser());
        $this->assertEquals($this->data['id'], $manager->getId());

        $user = $manager->getUser();
        $this->assertEquals($this->data['user']['id'], $user->getId());
        $this->assertEquals($this->data['user']['username'], $user->getUsername());
        $this->assertEquals($this->data['user']['email'], $user->getEmail());
        $this->assertEquals($this->data['user']['firstName'], $user->getFirstName());
        $this->assertEquals($this->data['user']['lastName'], $user->getLastName());
        $this->assertEquals($this->data['user']['avatarUrl'], $user->getAvatarUrl());
        $this->assertEquals($this->data['user']['fields'], $user->getFields());
        $this->assertEquals($this->data['user']['isAdmin'], $user->isAdmin());
        $this->assertEquals($this->data['user']['status'], $user->getStatus());
        $this->assertEquals($this->data['user']['createdAt'], $user->getCreatedAt());
        $this->assertEquals($this->data['user']['lastSeen'], $user->getLastSeen());
        $this->assertEquals($this->data['user']['emailVerified'], $user->isEmailVerified());
        $this->assertEquals($this->data['user']['twoFactor'], $user->getTwoFactor());
        $this->assertEquals($this->data['user']['timezone'], $user->getTimezone());
        $this->assertEquals($this->data['user']['joinDetails'], $user->getJoinDetails());
        $this->assertEquals($this->data['user']['deviceVerification'], $user->getDeviceVerification());
        $this->assertEquals($this->data['user']['trustedDevicesCount'], $user->getTrustedDevicesCount());
        $this->assertEquals($this->data['user']['apiTokensCount'], $user->getApiTokensCount());
        $this->assertEquals($this->data['user']['loginMethods'], $user->getLoginMethods());
        $this->assertEquals($this->data['user']['mfaMethods'], $user->getMfaMethods());

        $this->assertCount(1, $manager->getTeams());
        $this->assertInstanceOf(Team::class, $manager->getTeams()[0]);
        $this->assertEquals($this->data['teams'][0]['id'], $manager->getTeams()[0]->getId());
        $this->assertEquals($this->data['teams'][0]['name'], $manager->getTeams()[0]->getName());
    }

    public function testLoadDataWithoutTeams(): void
    {
        $data = [
            'id' => 27,
            'user' => [
                'id' => 12,
                'username' => 'john_smith',
            ],
        ];

        $manager = new GroupManager($data);

        $this->assertInstanceOf(User::class, $manager->getUser());
        $this->assertEquals($data['id'], $manager->getId());
        $this->assertEquals($data['user']['username'], $manager->getUser()->getUsername());
        $this->assertCount(0, $manager->getTeams());
    }
}
