<?php

namespace CrowdinApiClient\Tests\Model\Enterprise;

use CrowdinApiClient\Model\Enterprise\AddedProjectTeamInfo;
use PHPUnit\Framework\TestCase;

class AddedProjectTeamInfoTest extends TestCase
{
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

    public function testLoadData(): void
    {
        $addedProjectTeamInfo = new AddedProjectTeamInfo($this->data);
        $this->assertEquals([], $addedProjectTeamInfo->getSkipped());
        $this->assertEquals(false, $addedProjectTeamInfo->getAdded()->getHasManagerAccess());
        $this->assertEquals(false, $addedProjectTeamInfo->getAdded()->getHasAccessToAllWorkflowSteps());
        $this->assertEquals(
            $this->data['added']['permissions'],
            $addedProjectTeamInfo->getAdded()->getPermissions()
        );
    }
}
