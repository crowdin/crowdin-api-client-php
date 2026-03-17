<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model\Enterprise;

use CrowdinApiClient\Model\Enterprise\GroupTeam;
use CrowdinApiClient\Model\Enterprise\Team;
use PHPUnit\Framework\TestCase;

class GroupTeamTest extends TestCase
{
    public $data = [
        'id' => 27,
        'team' => [
            'id' => 2,
            'name' => 'Translators Team',
            'totalMembers' => 8,
            'webUrl' => 'https://example.crowdin.com/u/teams/1',
            'createdAt' => '2019-09-23T09:04:29+00:00',
            'updatedAt' => '2019-09-23T09:04:29+00:00',
        ],
    ];

    public function testLoadData(): void
    {
        $groupTeam = new GroupTeam($this->data);

        $this->assertEquals($this->data['id'], $groupTeam->getId());
        $this->assertInstanceOf(Team::class, $groupTeam->getTeam());
        $this->assertEquals($this->data['team']['id'], $groupTeam->getTeam()->getId());
        $this->assertEquals($this->data['team']['name'], $groupTeam->getTeam()->getName());
        $this->assertEquals($this->data['team']['totalMembers'], $groupTeam->getTeam()->getTotalMembers());
        $this->assertEquals($this->data['team']['webUrl'], $groupTeam->getTeam()->getWebUrl());
        $this->assertEquals($this->data['team']['createdAt'], $groupTeam->getTeam()->getCreatedAt());
        $this->assertEquals($this->data['team']['updatedAt'], $groupTeam->getTeam()->getUpdatedAt());
    }
}
