<?php

namespace CrowdinApiClient\Tests\Model\Enterprise;

use CrowdinApiClient\Model\Enterprise\User;
use PHPUnit\Framework\TestCase;

/**
 * Class UserTest
 * @package CrowdinApiClient\Tests\Model\Enterprise
 */
class UserTest extends TestCase
{
    public $user;

    public $data = [
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
        'timezone' => 'Europe/Kiev',
    ];

    public function testLoadData()
    {
        $this->user = new User($this->data);
        $this->checkData();
    }

    public function testSetData()
    {
        $this->user = new User();
        $this->user->setId($this->data['id']);
        $this->user->setUsername($this->data['username']);
        $this->user->setEmail($this->data['email']);
        $this->user->setFirstName($this->data['firstName']);
        $this->user->setLastName($this->data['lastName']);
        $this->user->setStatus($this->data['status']);
        $this->user->setAvatarUrl($this->data['avatarUrl']);
        $this->user->setCreatedAt($this->data['createdAt']);
        $this->user->setLastSeen($this->data['lastSeen']);
        $this->user->setTwoFactor($this->data['twoFactor']);
        $this->user->setIsAdmin($this->data['isAdmin']);
        $this->user->setTimezone($this->data['timezone']);
        $this->checkData();
    }

    public function checkData()
    {
        $this->assertEquals($this->data['id'], $this->user->getId());
        $this->assertEquals($this->data['username'], $this->user->getUsername());
        $this->assertEquals($this->data['email'], $this->user->getEmail());
        $this->assertEquals($this->data['firstName'], $this->user->getFirstName());
        $this->assertEquals($this->data['lastName'], $this->user->getLastName());
        $this->assertEquals($this->data['status'], $this->user->getStatus());
        $this->assertEquals($this->data['avatarUrl'], $this->user->getAvatarUrl());
        $this->assertEquals($this->data['createdAt'], $this->user->getCreatedAt());
        $this->assertEquals($this->data['lastSeen'], $this->user->getLastSeen());
        $this->assertEquals($this->data['twoFactor'], $this->user->getTwoFactor());
        $this->assertEquals($this->data['isAdmin'], $this->user->isAdmin());
        $this->assertEquals($this->data['timezone'], $this->user->getTimezone());
    }
}
