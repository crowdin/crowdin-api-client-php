<?php

namespace CrowdinApiClient\Tests\Api\Enterprise;

use CrowdinApiClient\Model\Enterprise\WorkflowStep;
use CrowdinApiClient\ModelCollection;

class WorkflowStepApiTest extends AbstractTestApi
{
    public function testList()
    {
        $this->mockRequest([
            'path' => '/projects/1/workflow-steps',
            'method' => 'get',
            'response' => '
            {
              "data": [
                {
                    "data": {
                      "id": 311,
                      "title": "Translate",
                      "type": "Translate",
                      "languages": [
                        "uk"
                      ],
                      "config": {
                        "assignees": {
                          "de": [
                            346
                          ],
                          "it": [
                            43
                          ]
                        }
                      }
                    }
                }
              ],
              "pagination": {
                "offset": 0,
                "limit": 25
              }
            }
            '
        ]);
        $workflowSteps = $this->crowdin->workflowStep->list(1);

        $this->assertInstanceOf(ModelCollection::class, $workflowSteps);
        $this->assertCount(1, $workflowSteps);
        $this->assertInstanceOf(WorkflowStep::class, $workflowSteps[0]);
        $this->assertEquals(311, $workflowSteps[0]->getId());
    }

    public function testGet()
    {
        $this->mockRequestGet('/projects/1/workflow-steps/311', '
        {
          "data": {
            "id": 311,
            "title": "Translate",
            "type": "Translate",
            "languages": [
              "uk"
            ],
            "config": {
              "assignees": {
                "de": [
                  346
                ],
                "it": [
                  43
                ]
              }
            }
          }
        }
        ');

        $workflowStep = $this->crowdin->workflowStep->get(1, 311);
        $this->assertInstanceOf(WorkflowStep::class, $workflowStep);
        $this->assertEquals(311, $workflowStep->getId());
    }
}
