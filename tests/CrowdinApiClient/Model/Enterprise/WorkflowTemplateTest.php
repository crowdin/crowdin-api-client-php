<?php

namespace CrowdinApiClient\Tests\Model\Enterprise;

use CrowdinApiClient\Model\Enterprise\WorkflowTemplate;
use PHPUnit\Framework\TestCase;

/**
 * Class WorkflowTemplateTest
 * @package CrowdinApiClient\Tests\Model\Enterprise
 */
class WorkflowTemplateTest extends TestCase
{
    public $workflowTemplate;

    public $data = [
        'id' => 2,
        'title' => 'In-house + Machine Translation',
        'description' => 'Combine the efforts of human translators and Machine Translation technology.\\n• Pre-translation - Translation Memory\\n• Pre-translation - Machine Translation\\n• Translation - in-house translators\\n• Proofreading - in-house translators',
        'groupId' => 2,
        'isDefault' => true,
    ];

    public function testLoadData()
    {
        $this->workflowTemplate = new WorkflowTemplate($this->data);
        $this->assertEquals($this->data['id'], $this->workflowTemplate->getId());
        $this->assertEquals($this->data['title'], $this->workflowTemplate->getTitle());
        $this->assertEquals($this->data['description'], $this->workflowTemplate->getDescription());
        $this->assertEquals($this->data['groupId'], $this->workflowTemplate->getGroupId());
        $this->assertEquals($this->data['isDefault'], $this->workflowTemplate->isDefault());
    }
}
