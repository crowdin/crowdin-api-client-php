<?php

namespace CrowdinApiClient\Tests\Model\Enterprise;

use CrowdinApiClient\Model\Enterprise\Team;
use PHPUnit\Framework\TestCase;

class TeamTest extends TestCase
{
    /**
     * @var Team
     */
    public $team;

    public $data = [
        'id' => 1,
        'name' => 'Team 1',
        'totalMembers' => 8,
        'createdAt' => '2019-09-23T09:04:29+00:00',
        'updatedAt' => '2019-09-23T09:04:29+00:00',
    ];

    public function testLoadData(): void
    {
        $this->team = new Team($this->data);
        $this->checkData();
    }

    public function testSetData(): void
    {
        $this->team = new Team();

        $this->team->setName($this->data['name']);
        $this->team->setTotalMembers($this->data['totalMembers']);
        $this->team->setCreatedAt($this->data['createdAt']);
        $this->team->setUpdatedAt($this->data['updatedAt']);

        $this->assertEquals($this->team->getName(), $this->data['name']);
        $this->assertEquals($this->team->getTotalMembers(), $this->data['totalMembers']);
        $this->assertEquals($this->team->getCreatedAt(), $this->data['createdAt']);
    }

    public function checkData(): void
    {
        $this->assertEquals($this->data['id'], $this->team->getId());
        $this->assertEquals($this->data['name'], $this->team->getName());
        $this->assertEquals($this->data['totalMembers'], $this->team->getTotalMembers());
        $this->assertEquals($this->data['createdAt'], $this->team->getCreatedAt());
        $this->assertEquals($this->data['updatedAt'], $this->team->getUpdatedAt());
    }
}
