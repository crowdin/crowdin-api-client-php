<?php

namespace CrowdinApiClient\Tests\Model\Enterprise;

use CrowdinApiClient\Model\Enterprise\WorkflowStep;
use PHPUnit\Framework\TestCase;

class WorkflowStepTest extends TestCase
{
    public $data = [
        'id' => 2,
        'title' => 'In-house + Machine Translation',
        'type' => 'Translation',
        'languages' => ['uk', 'pl'],
        'config' => [
            'assignees' => [
                'uk' => [1],
                'pl' => [2, 3],
            ],
        ],
    ];

    public function testLoadData(): void
    {
        $workflowStep = new WorkflowStep($this->data);

        $this->assertEquals($this->data['id'], $workflowStep->getId());
        $this->assertEquals($this->data['title'], $workflowStep->getTitle());
        $this->assertEquals($this->data['type'], $workflowStep->getType());
        $this->assertEquals($this->data['languages'], $workflowStep->getLanguages());
        $this->assertEquals($this->data['config'], $workflowStep->getConfig());
    }
}
