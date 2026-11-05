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
        'name' => 'Translators Team',
        'hasManagerAccess' => true,
        'hasDeveloperAccess' => true,
        'hasAccessToAllWorkflowSteps' => false,
        'permissions' => [
            'it' => ['workflowStepIds' => 313],
        ],
        'roles' => [
            ['name' => 'proofreader', 'permissions' => ['allLanguages' => true, 'languagesAccess' => []]],
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

    public function testLoadDataWithoutOptionalFields(): void
    {
        $projectTeam = new ProjectTeam(['id' => 1]);

        $this->assertSame('', $projectTeam->getName());
        $this->assertFalse($projectTeam->getHasDeveloperAccess());
        $this->assertSame([], $projectTeam->getRoles());
    }

    public function checkData(): void
    {
        $this->assertEquals($this->data['id'], $this->projectTeam->getId());
        $this->assertEquals($this->data['name'], $this->projectTeam->getName());
        $this->assertEquals($this->data['hasDeveloperAccess'], $this->projectTeam->getHasDeveloperAccess());
        $this->assertEquals($this->data['roles'], $this->projectTeam->getRoles());
        $this->assertEquals($this->data['hasManagerAccess'], $this->projectTeam->getHasManagerAccess());
        $this->assertEquals(
            $this->data['hasAccessToAllWorkflowSteps'],
            $this->projectTeam->getHasAccessToAllWorkflowSteps()
        );
        $this->assertEquals($this->data['permissions'], $this->projectTeam->getPermissions());
    }
}
