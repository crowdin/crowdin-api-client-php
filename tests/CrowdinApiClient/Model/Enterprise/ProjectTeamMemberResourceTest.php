<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model\Enterprise;

use CrowdinApiClient\Model\Enterprise\ProjectTeamMemberResource;
use PHPUnit\Framework\TestCase;

class ProjectTeamMemberResourceTest extends TestCase
{
    /**
     * @var ProjectTeamMemberResource
     */
    public $projectTeamMemberResource;

    public $data = [
        'id' => 1,
        'username' => 'jon_doe',
        'firstName' => 'Jon',
        'lastName' => 'Doe',
        'isManager' => true,
        'managerOfGroup' => [
            'id' => 1,
            'name' => 'KB materials',
        ],
        'accessToAllWorkflowSteps' => true,
        'permissions' => [
            'it' => [
                'workflowStepIds' => [
                    313,
                ],
            ],
        ],
        'givenAccessAt' => '2019-10-23T11:44:02+00:00',
    ];

    public function testLoadData(): void
    {
        $this->projectTeamMemberResource = new ProjectTeamMemberResource($this->data);
        $this->checkData();
    }

    public function testSetData(): void
    {
        $this->projectTeamMemberResource = new ProjectTeamMemberResource();
        $this->projectTeamMemberResource->setAccessToAllWorkflowSteps($this->data['accessToAllWorkflowSteps']);
        $this->projectTeamMemberResource->setPermissions($this->data['permissions']);

        $this->assertEquals(
            $this->data['accessToAllWorkflowSteps'],
            $this->projectTeamMemberResource->isAccessToAllWorkflowSteps()
        );
        $this->assertEquals($this->data['permissions'], $this->projectTeamMemberResource->getPermissions());
    }

    public function checkData(): void
    {
        $this->assertEquals($this->data['id'], $this->projectTeamMemberResource->getId());
        $this->assertEquals($this->data['username'], $this->projectTeamMemberResource->getUsername());
        $this->assertEquals($this->data['firstName'], $this->projectTeamMemberResource->getFirstName());
        $this->assertEquals($this->data['lastName'], $this->projectTeamMemberResource->getLastName());
        $this->assertEquals($this->data['isManager'], $this->projectTeamMemberResource->isManager());
        $this->assertEquals($this->data['managerOfGroup'], $this->projectTeamMemberResource->getManagerOfGroup());
        $this->assertEquals(
            $this->data['accessToAllWorkflowSteps'],
            $this->projectTeamMemberResource->isAccessToAllWorkflowSteps()
        );
        $this->assertEquals($this->data['permissions'], $this->projectTeamMemberResource->getPermissions());
        $this->assertEquals($this->data['givenAccessAt'], $this->projectTeamMemberResource->getGivenAccessAt());
    }
}
