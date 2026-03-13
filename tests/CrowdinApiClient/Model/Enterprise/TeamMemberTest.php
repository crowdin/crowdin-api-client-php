<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model\Enterprise;

use CrowdinApiClient\Model\Enterprise\TeamMember;
use PHPUnit\Framework\TestCase;

class TeamMemberTest extends TestCase
{
    public $data = [
        'id' => 1,
        'username' => 'john.doe',
        'firstName' => 'John',
        'lastName' => 'Doe',
        'avatarUrl' => '',
        'addedAt' => '2019-09-23T09:04:29+00:00',
    ];

    public function testLoadData(): void
    {
        $teamMember = new TeamMember($this->data);
        $this->assertEquals($this->data['id'], $teamMember->getId());
        $this->assertEquals($this->data['username'], $teamMember->getUsername());
        $this->assertEquals($this->data['firstName'], $teamMember->getFirstName());
        $this->assertEquals($this->data['lastName'], $teamMember->getLastName());
        $this->assertEquals($this->data['avatarUrl'], $teamMember->getAvatarUrl());
        $this->assertEquals($this->data['addedAt'], $teamMember->getAddedAt());
    }
}
