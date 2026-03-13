<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\ProjectMember;
use PHPUnit\Framework\TestCase;

class ProjectMemberTest extends TestCase
{
    public $data = [
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
    ];

    public function testLoadData()
    {
        $member = new ProjectMember($this->data);
        $this->assertEquals($this->data['id'], $member->getId());
        $this->assertEquals($this->data['username'], $member->getUsername());
        $this->assertEquals($this->data['fullName'], $member->getFullName());
        $this->assertEquals($this->data['role'], $member->getRole());
        $this->assertEquals($this->data['permissions'], $member->getPermissions());
        $this->assertEquals($this->data['roles'], $member->getRoles());
        $this->assertEquals($this->data['avatarUrl'], $member->getAvatarUrl());
        $this->assertEquals($this->data['joinedAt'], $member->getJoinedAt());
        $this->assertEquals($this->data['timezone'], $member->getTimezone());
    }
}
