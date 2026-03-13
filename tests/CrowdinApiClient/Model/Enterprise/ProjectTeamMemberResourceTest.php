<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model\Enterprise;

use CrowdinApiClient\Model\Enterprise\ProjectTeamMemberResource;
use PHPUnit\Framework\TestCase;

class ProjectTeamMemberResourceTest extends TestCase
{
    public $data = [
        'id' => 1,
        'username' => 'jon_doe',
        'firstName' => 'Jon',
        'lastName' => 'Doe',
        'roles' => [
            [
                'name' => 'owner'
            ]
        ],
        'isManager' => true,
        'isDeveloper' => false,
        'isAdmin' => true,
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
        $projectTeamMemberResource = new ProjectTeamMemberResource($this->data);
        $this->assertEquals($this->data['id'], $projectTeamMemberResource->getId());
        $this->assertEquals($this->data['username'], $projectTeamMemberResource->getUsername());
        $this->assertEquals($this->data['firstName'], $projectTeamMemberResource->getFirstName());
        $this->assertEquals($this->data['lastName'], $projectTeamMemberResource->getLastName());
        $this->assertEquals($this->data['roles'], $projectTeamMemberResource->getRoles());
        $this->assertEquals($this->data['isAdmin'], $projectTeamMemberResource->isAdmin());
        $this->assertEquals($this->data['isDeveloper'], $projectTeamMemberResource->isDeveloper());
        $this->assertEquals($this->data['isManager'], $projectTeamMemberResource->isManager());
        $this->assertEquals($this->data['managerOfGroup'], $projectTeamMemberResource->getManagerOfGroup());
        $this->assertEquals(
            $this->data['accessToAllWorkflowSteps'],
            $projectTeamMemberResource->isAccessToAllWorkflowSteps()
        );
        $this->assertEquals($this->data['permissions'], $projectTeamMemberResource->getPermissions());
        $this->assertEquals($this->data['givenAccessAt'], $projectTeamMemberResource->getGivenAccessAt());
    }
}
