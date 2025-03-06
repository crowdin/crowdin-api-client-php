<?php

namespace CrowdinApiClient\Tests\Model\Enterprise;

use CrowdinApiClient\Model\Enterprise\ProjectTeam;
use PHPUnit\Framework\TestCase;

class ProjectTeamTest extends TestCase
{
    /**
     * @var ProjectTeam
     */
    public $projectTeam;

    public $data = [
        'id' => 1,
        'hasManagerAccess' => true,
        'hasAccessToAllWorkflowSteps' => false,
        'permissions' => [
            'it' => ['workflowStepIds' => 313],
        ],
    ];

    public function testLoadData(): void
    {
        $this->projectTeam = new ProjectTeam($this->data);
        $this->checkData();
    }

    public function testSetData(): void
    {
        $this->projectTeam = new ProjectTeam();
        $this->projectTeam->setHasManagerAccess($this->data['hasManagerAccess']);
        $this->projectTeam->setHasAccessToAllWorkflowSteps($this->data['hasAccessToAllWorkflowSteps']);
        $this->projectTeam->setPermissions($this->data['permissions']);

        $this->assertEquals($this->data['hasManagerAccess'], $this->projectTeam->getHasManagerAccess());
        $this->assertEquals(
            $this->data['hasAccessToAllWorkflowSteps'],
            $this->projectTeam->getHasAccessToAllWorkflowSteps()
        );
        $this->assertEquals($this->data['permissions'], $this->projectTeam->getPermissions());
    }

    public function checkData(): void
    {
        $this->assertEquals($this->data['hasManagerAccess'], $this->projectTeam->getHasManagerAccess());
        $this->assertEquals(
            $this->data['hasAccessToAllWorkflowSteps'],
            $this->projectTeam->getHasAccessToAllWorkflowSteps()
        );
        $this->assertEquals($this->data['permissions'], $this->projectTeam->getPermissions());
    }
}
