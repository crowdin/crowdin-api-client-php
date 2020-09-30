<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\Enterprise\WorkflowStep;
use PHPUnit\Framework\TestCase;

class WorkflowStepTest extends TestCase
{
    public $workflowStep;

    public $data = [
        'id' => 2,
        'title' => 'In-house + Machine Translation',
        'type' => 'Translation',
        'languages' => ['uk', 'pl'],
        'config' => [
            "assignees" => [
                "uk" => [1],
                "pl" => [2, 3]
            ]
        ],
    ];

    public function testLoadData()
    {
        $this->workflowStep = new WorkflowStep($this->data);
        $this->assertEquals($this->data['id'], $this->workflowStep->getId());
        $this->assertEquals($this->data['title'], $this->workflowStep->getTitle());
        $this->assertEquals($this->data['type'], $this->workflowStep->getType());
        $this->assertEquals($this->data['languages'], $this->workflowStep->getLanguages());
        $this->assertEquals($this->data['config'], $this->workflowStep->getConfig());
    }
}
