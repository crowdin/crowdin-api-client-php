<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public $data = [
        'id' => 1,
        'username' => 'john_smith',
        'email' => 'jsmith@example.com',
        'emailVerified' => true,
        'fullName' => 'John Smith',
        'avatarUrl' => '',
        'createdAt' => '2019-07-11T07:40:22+00:00',
        'lastSeen' => '2019-10-23T11:44:02+00:00',
        'twoFactor' => 'enabled',
        'timezone' => 'Europe/Kyiv',
    ];

    public function testLoadData()
    {
        $user = new User($this->data);
        $this->assertEquals($this->data['id'], $user->getId());
        $this->assertEquals($this->data['username'], $user->getUsername());
        $this->assertEquals($this->data['email'], $user->getEmail());
        $this->assertEquals($this->data['emailVerified'], $user->getEmailVerified());
        $this->assertEquals($this->data['fullName'], $user->getFullName());
        $this->assertEquals($this->data['avatarUrl'], $user->getAvatarUrl());
        $this->assertEquals($this->data['createdAt'], $user->getCreatedAt());
        $this->assertEquals($this->data['lastSeen'], $user->getLastSeen());
        $this->assertEquals($this->data['twoFactor'], $user->getTwoFactor());
        $this->assertEquals($this->data['timezone'], $user->getTimezone());
    }

    public function testSetData()
    {
        $newUsername = 'john.smith';
        $newFullName = 'John Blacksmith';
        $newTimezone = 'Europe/London';

        $user = new User($this->data);
        $user->setUsername($newUsername);
        $user->setFullName($newFullName);
        $user->setTimezone($newTimezone);

        $this->assertEquals($newUsername, $user->getUsername());
        $this->assertEquals($newFullName, $user->getFullName());
        $this->assertEquals($newTimezone, $user->getTimezone());
    }
}
