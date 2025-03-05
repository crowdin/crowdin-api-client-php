<?php

namespace CrowdinApiClient\Tests\Api\Enterprise;

use CrowdinApiClient\Model\Enterprise\WorkflowStep;
use CrowdinApiClient\ModelCollection;

class WorkflowStepApiTest extends AbstractTestApi
{
    public function testList(): void
    {
        $this->mockRequest([
            'path' => '/projects/1/workflow-steps',
            'method' => 'get',
            'response' => json_encode([
                'data' => [
                    [
                        'data' => [
                            'id' => 311,
                            'title' => 'Translate',
                            'type' => 'Translate',
                            'languages' => ['uk'],
                            'config' => [
                                'assignees' => [
                                    'de' => [346],
                                    'it' => [43],
                                ],
                            ],
                        ],
                    ],
                ],
                'pagination' => [
                    'offset' => 0,
                    'limit' => 25,
                ],
            ]),
        ]);

        $workflowSteps = $this->crowdin->workflowStep->list(1);

        $this->assertInstanceOf(ModelCollection::class, $workflowSteps);
        $this->assertCount(1, $workflowSteps);
        $this->assertInstanceOf(WorkflowStep::class, $workflowSteps[0]);
        $this->assertEquals(311, $workflowSteps[0]->getId());
    }

    public function testGet(): void
    {
        $this->mockRequestGet(
            '/projects/1/workflow-steps/311',
            json_encode([
                'data' => [
                    'id' => 311,
                    'title' => 'Translate',
                    'type' => 'Translate',
                    'languages' => ['uk'],
                    'config' => [
                        'assignees' => [
                            'de' => [346],
                            'it' => [43],
                        ],
                    ],
                ],
            ])
        );

        $workflowStep = $this->crowdin->workflowStep->get(1, 311);

        $this->assertInstanceOf(WorkflowStep::class, $workflowStep);
        $this->assertEquals(311, $workflowStep->getId());
    }

    public function testListStrings(): void
    {
        $this->mockRequestGet(
            '/projects/1/workflow-steps/8/strings',
            json_encode([
                'data' => [
                    [
                        'data' => [
                            'id' => 1,
                            'projectId' => 1,
                            'branchId' => null,
                            'identifier' => 'Identifier',
                            'text' => 'Text to translate',
                            'type' => 'text',
                            'context' => 'Context',
                            'maxLength' => 0,
                            'isHidden' => false,
                            'isDuplicate' => false,
                            'masterStringId' => null,
                            'hasPlurals' => false,
                            'isIcu' => false,
                            'labelIds' => [],
                            'webUrl' => 'https://nasa.crowdin.com/editor/1/all/en-uk#1',
                            'createdAt' => '2025-03-05T15:58:11+00:00',
                            'updatedAt' => null,
                            'fields' => [],
                            'fileId' => 1,
                            'directoryId' => null,
                            'revision' => 1,
                        ],
                    ],
                ],
                'pagination' => [
                    'offset' => 0,
                    'limit' => 1,
                ],
            ])
        );

        $sourceStrings = $this->crowdin->workflowStep->listStrings(1, 8);

        $this->assertInstanceOf(ModelCollection::class, $sourceStrings);
        $this->assertCount(1, $sourceStrings);
        $this->assertSame('Identifier', $sourceStrings[0]->getIdentifier());
    }
}
