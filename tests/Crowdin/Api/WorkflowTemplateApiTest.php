<?php

namespace Crowdin\Tests\Api;

use Crowdin\Model\WorkflowTemplate;

class WorkflowTemplateApiTest extends AbstractTestApi
{
    public function testList()
    {
        $this->mockRequest([
            'path' => '/workflow-templates',
            'method' => 'get',
            'response' => '{
                  "data": [
                    {
                      "data": {
                        "id": 2,
                        "title": "In-house + Machine Translation",
                        "description": "Combine the efforts of human translators and Machine Translation technology.\\n• Pre-translation - Translation Memory\\n• Pre-translation - Machine Translation\\n• Translation - in-house translators\\n• Proofreading - in-house translators",
                        "groupId": 2,
                        "isDefault": true
                      }
                    }
                  ],
                  "pagination": [
                    {
                      "offset": 0,
                      "limit": 0
                    }
                  ]
                }'
        ]);

        $workflowTemplates = $this->crowdin->workflowTemplate->list();

        $this->assertIsArray($workflowTemplates);
        $this->assertCount(1, $workflowTemplates);
        $this->assertInstanceOf(WorkflowTemplate::class, $workflowTemplates[0]);
        $this->assertEquals(2, $workflowTemplates[0]->getId());
    }

    public function testGet()
    {
        $this->mockRequestGet('/workflow-templates/2', '{
              "data": {
                "id": 2,
                "title": "In-house + Machine Translation",
                "description": "Combine the efforts of human translators and Machine Translation technology.\\n• Pre-translation - Translation Memory\\n• Pre-translation - Machine Translation\\n• Translation - in-house translators\\n• Proofreading - in-house translators",
                "groupId": 2,
                "isDefault": true
              }
        }');

        $workflowTemplate = $this->crowdin->workflowTemplate->get(2);
        $this->assertInstanceOf(WorkflowTemplate::class, $workflowTemplate);
        $this->assertEquals(2, $workflowTemplate->getId());
    }
}
