<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /**
     * @var User
     */
    public $user;

    public $data = [
        'id' => 1,
        'username' => 'john_smith',
        'email' => 'jsmith@example.com',
        'fullName' => 'John Smith',
        'avatarUrl' => '',
        'createdAt' => '2019-07-11T07:40:22+00:00',
        'lastSeen' => '2019-10-23T11:44:02+00:00',
        'twoFactor' => 'enabled',
        'timezone' => 'Europe/Kiev',
    ];

    public function testLoadData()
    {
        $this->user = new User($this->data);
        $this->checkData();
    }

    public function checkData()
    {
        $this->assertEquals($this->data['id'], $this->user->getId());
        $this->assertEquals($this->data['username'], $this->user->getUsername());
        $this->assertEquals($this->data['email'], $this->user->getEmail());
        $this->assertEquals($this->data['fullName'], $this->user->getFullName());
        $this->assertEquals($this->data['avatarUrl'], $this->user->getAvatarUrl());
        $this->assertEquals($this->data['createdAt'], $this->user->getCreatedAt());
        $this->assertEquals($this->data['lastSeen'], $this->user->getLastSeen());
        $this->assertEquals($this->data['twoFactor'], $this->user->getTwoFactor());
        $this->assertEquals($this->data['timezone'], $this->user->getTimezone());
    }
}
