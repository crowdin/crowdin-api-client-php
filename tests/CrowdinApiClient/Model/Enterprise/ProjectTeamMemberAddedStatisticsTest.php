<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model\Enterprise;

use CrowdinApiClient\Model\Enterprise\ProjectTeamMemberAddedStatistics;
use PHPUnit\Framework\TestCase;

class ProjectTeamMemberAddedStatisticsTest extends TestCase
{
    /**
     * @var ProjectTeamMemberAddedStatistics
     */
    public $projectTeamMemberAddedStatistics;

    /**
     * @var array
     */
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
        $this->projectTeamMemberAddedStatistics = new ProjectTeamMemberAddedStatistics($this->data);
        $this->checkData();
    }

    public function testSetData(): void
    {
        $this->projectTeamMemberAddedStatistics = new ProjectTeamMemberAddedStatistics();
        $this->projectTeamMemberAddedStatistics->setSkipped($this->data['skipped']);
        $this->projectTeamMemberAddedStatistics->setAdded($this->data['added']);
        $this->projectTeamMemberAddedStatistics->setPagination($this->data['pagination']);

        $this->assertEquals($this->data['skipped'], $this->projectTeamMemberAddedStatistics->getSkipped());
        $this->assertEquals($this->data['added'], $this->projectTeamMemberAddedStatistics->getAdded());
        $this->assertEquals($this->data['pagination'], $this->projectTeamMemberAddedStatistics->getPagination());
    }

    public function checkData(): void
    {
        $this->assertEquals($this->data['skipped'], $this->projectTeamMemberAddedStatistics->getSkipped());
        $this->assertEquals($this->data['added'], $this->projectTeamMemberAddedStatistics->getAdded());
        $this->assertEquals($this->data['pagination'], $this->projectTeamMemberAddedStatistics->getPagination());
    }
}
