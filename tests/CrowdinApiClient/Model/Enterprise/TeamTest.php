<?php

namespace CrowdinApiClient\Tests\Model\Enterprise;

use CrowdinApiClient\Model\Enterprise\Team;
use PHPUnit\Framework\TestCase;

class TeamTest extends TestCase
{
    public $data = [
        'id' => 1,
        'name' => 'Team 1',
        'totalMembers' => 8,
        'webUrl' => 'https://crowdin.com/u/teams/1',
        'createdAt' => '2019-09-23T09:04:29+00:00',
        'updatedAt' => '2019-09-23T09:04:29+00:00',
    ];

    public function testLoadData(): void
    {
        $team = new Team($this->data);
        $this->assertEquals($this->data['id'], $team->getId());
        $this->assertEquals($this->data['name'], $team->getName());
        $this->assertEquals($this->data['totalMembers'], $team->getTotalMembers());
        $this->assertEquals($this->data['webUrl'], $team->getWebUrl());
        $this->assertEquals($this->data['createdAt'], $team->getCreatedAt());
        $this->assertEquals($this->data['updatedAt'], $team->getUpdatedAt());
    }

    public function testSetData(): void
    {
        $team = new Team();
        $team->setName($this->data['name']);

        $this->assertEquals($team->getName(), $this->data['name']);
    }
}
