<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model\Enterprise;

use CrowdinApiClient\Model\Enterprise\ProjectTeamMemberAddedStatistics;
use PHPUnit\Framework\TestCase;

class ProjectTeamMemberAddedStatisticsTest extends TestCase
{
    public $data = [
        'skipped' => [
            [
                'data' => [
                    'id' => 1,
                    'username' => 'john_smith',
                    'firstName' => 'John',
                    'lastName' => 'Smith',
                    'isManager' => false,
                    'managerOfGroup' => [
                        'id' => 1,
                        'name' => 'KB materials',
                    ],
                    'accessToAllWorkflowSteps' => false,
                    'permissions' => [
                        'it' => ['workflowStepIds' => [313]],
                    ],
                    'lastSeen' => '2019-10-23T11:44:02+00:00',
                ],
            ],
        ],
        'updated' => [
            [
                'data' => [
                    'id' => 1,
                    'username' => 'john_smith',
                    'firstName' => 'John',
                    'lastName' => 'Smith',
                    'isManager' => false,
                    'managerOfGroup' => [
                        'id' => 1,
                        'name' => 'KB materials',
                    ],
                    'accessToAllWorkflowSteps' => false,
                    'permissions' => [
                        'it' => ['workflowStepIds' => [313]],
                    ],
                    'lastSeen' => '2019-10-23T11:44:02+00:00',
                ],
            ],
        ],
        'added' => [
            [
                'data' => [
                    'id' => 1,
                    'username' => 'john_smith',
                    'firstName' => 'John',
                    'lastName' => 'Smith',
                    'isManager' => false,
                    'managerOfGroup' => [
                        'id' => 1,
                        'name' => 'KB materials',
                    ],
                    'accessToAllWorkflowSteps' => false,
                    'permissions' => [
                        'it' => ['workflowStepIds' => [313]],
                    ],
                    'lastSeen' => '2019-10-23T11:44:02+00:00',
                ],
            ],
        ],
        'pagination' => [
            'offset' => 0,
            'limit' => 25,
        ],
    ];

    public function testLoadData(): void
    {
        $projectTeamMemberAddedStatistics = new ProjectTeamMemberAddedStatistics($this->data);
        $this->assertEquals($this->data['skipped'], $projectTeamMemberAddedStatistics->getSkipped());
        $this->assertEquals($this->data['updated'], $projectTeamMemberAddedStatistics->getUpdated());
        $this->assertEquals($this->data['added'], $projectTeamMemberAddedStatistics->getAdded());
        $this->assertEquals($this->data['pagination'], $projectTeamMemberAddedStatistics->getPagination());
    }
}
