<?php

namespace CrowdinApiClient\Tests\Model\Enterprise;

use CrowdinApiClient\Model\Enterprise\AddedProjectTeamInfo;
use CrowdinApiClient\Model\Enterprise\ProjectTeam;
use PHPUnit\Framework\TestCase;

class AddedProjectTeamInfoTest extends TestCase
{
    /**
     * @var AddedProjectTeamInfo
     */
    public $addedProjectTeamInfo;

    public $data = [
        'added' => [
            'id' => 1,
            'hasManagerAccess' => false,
            'hasAccessToAllWorkflowSteps' => false,
            'permissions' => [
                'it' => ['workflowStepIds' => 313],
            ],
        ],
        'skipped' => null,
    ];

    public $projectTeam = [
        'id' => 1,
        'hasManagerAccess' => false,
        'hasAccessToAllWorkflowSteps' => false,
        'permissions' => [
            'it' => ['workflowStepIds' => 313],
        ],
    ];

    public function testLoadData(): void
    {
        $this->addedProjectTeamInfo = new AddedProjectTeamInfo($this->data);
        $this->checkData();
    }

    public function testSetData(): void
    {
        $this->addedProjectTeamInfo = new AddedProjectTeamInfo();
        $this->addedProjectTeamInfo->setAdded(new ProjectTeam($this->projectTeam));

        $this->assertEquals([], $this->addedProjectTeamInfo->getSkipped());
        $this->assertEquals(
            $this->projectTeam['hasManagerAccess'],
            $this->addedProjectTeamInfo->getAdded()->getHasManagerAccess()
        );
        $this->assertEquals(
            $this->projectTeam['hasAccessToAllWorkflowSteps'],
            $this->addedProjectTeamInfo->getAdded()->getHasAccessToAllWorkflowSteps()
        );
        $this->assertEquals(
            $this->projectTeam['permissions'],
            $this->addedProjectTeamInfo->getAdded()->getPermissions()
        );
    }

    public function checkData(): void
    {
        $this->assertEquals([], $this->addedProjectTeamInfo->getSkipped());
        $this->assertEquals(false, $this->addedProjectTeamInfo->getAdded()->getHasManagerAccess());
        $this->assertEquals(false, $this->addedProjectTeamInfo->getAdded()->getHasAccessToAllWorkflowSteps());
        $this->assertEquals(
            $this->data['added']['permissions'],
            $this->addedProjectTeamInfo->getAdded()->getPermissions()
        );
    }
}
