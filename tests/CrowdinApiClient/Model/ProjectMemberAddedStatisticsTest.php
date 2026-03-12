<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\ProjectMemberAddedStatistics;
use PHPUnit\Framework\TestCase;

class ProjectMemberAddedStatisticsTest extends TestCase
{
    public $data = [
        'skipped' => [],
        'updated' => [],
        'added' => [
            [
                'id' => 12,
                'username' => 'jsmith@example.com',
                'fullName' => '',
                'role' => 'member',
                'permissions' => [],
                'avatarUrl' => '',
                'joinedAt' => '2026-07-11T07:40:22+00:00',
                'timezone' => 'Europe/Kyiv',
            ],
        ],
        'pagination' => [
            'offset' => 0,
            'limit' => 25,
        ],
    ];

    public function testLoadData()
    {
        $statistics = new ProjectMemberAddedStatistics($this->data);
        $this->assertEquals($this->data['skipped'], $statistics->getSkipped());
        $this->assertEquals($this->data['updated'], $statistics->getUpdated());
        $this->assertEquals($this->data['added'], $statistics->getAdded());
        $this->assertEquals($this->data['pagination'], $statistics->getPagination());
    }
}
