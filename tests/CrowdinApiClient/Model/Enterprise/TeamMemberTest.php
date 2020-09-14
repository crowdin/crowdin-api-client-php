<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model\Enterprise;

use PHPUnit\Framework\TestCase;

class TeamMemberTest extends TestCase
{
    /**
     * @var TeamMember
     */
    public $teamMember;

    public $data = [
        'id' => 1,
        'username' => 'john.doe',
        'firstName' => 'John',
        'lastName' => 'Doe',
        'avatarUrl' => '',
        'addedAt' => '2019-09-23T09:04:29+00:00'
    ];

    public function testLoadData()
    {
        $this->teamMember = new TeamMember($this->data);
        $this->checkData();
    }

    public function testSetData()
    {
        $this->teamMember = new TeamMember();

        $this->teamMember->setUsername($this->data['username']);
        $this->teamMember->setFirstName($this->data['firstName']);
        $this->teamMember->setLastName($this->data['lastName']);
        $this->teamMember->setAvatarUrl($this->data['avatarUrl']);
        $this->teamMember->setAddedAt($this->data['addedAt']);

        $this->assertEquals($this->teamMember->getUsername(), $this->data['username']);
        $this->assertEquals($this->teamMember->getFirstName(), $this->data['firstName']);
        $this->assertEquals($this->teamMember->getLastName(), $this->data['lastName']);
        $this->assertEquals($this->teamMember->getAvatarUrl(), $this->data['avatarUrl']);
        $this->assertEquals($this->teamMember->getAddedAt(), $this->data['addedAt']);
    }

    public function checkData()
    {
        $this->assertEquals($this->data['id'], $this->teamMember->getId());
        $this->assertEquals($this->data['username'], $this->teamMember->getUsername());
        $this->assertEquals($this->data['firstName'], $this->teamMember->getFirstName());
        $this->assertEquals($this->data['lastName'], $this->teamMember->getLastName());
        $this->assertEquals($this->data['avatarUrl'], $this->teamMember->getAvatarUrl());
        $this->assertEquals($this->data['addedAt'], $this->teamMember->getAddedAt());
    }
}
