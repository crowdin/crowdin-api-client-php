<?php

namespace Crowdin\Tests\Api;

use Crowdin\Model\Task;

class TaskApiTest extends AbstractTestApi
{
    public function testList()
    {
        $this->mockRequestTest([
            'uri' => 'https://organization_domain.crowdin.com/api/v2/projects/2/tasks',
            'method' => 'get',
            'response' => '{
                  "data": [
                    {
                      "data": {
                        "id": 2,
                        "projectId": 2,
                        "creatorId": 6,
                        "type": 1,
                        "status": "todo",
                        "title": "French",
                        "assignees": [
                          {
                            "id": 1,
                            "wordsCount": 5
                          }
                        ],
                        "fileIds": [
                          1
                        ],
                        "progress": {
                          "total": 24,
                          "done": 15,
                          "percent": 62
                        },
                        "sourceLanguageId": "en",
                        "targetLanguageId": "fr",
                        "description": "Proofread all French strings",
                        "hash": "dac37aff364d83899128e68afe0de4994",
                        "translationUrl": "/proofread/9092638ac9f2a2d1b5571d08edc53763/all/en-fr/10?task=dac37aff364d83899128e68afe0de4994",
                        "wordsCount": 24,
                        "filesCount": 2,
                        "commentsCount": 0,
                        "deadline": "2019-09-27T07:00:14+00:00",
                        "timeRange": "string",
                        "workflowStepId": 10,
                        "createdAt": "2019-09-23T09:04:29+00:00",
                        "updatedAt": "2019-09-23T09:04:29+00:00"
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

        $tasks = $this->crowdin->task->list(2);
        $this->assertIsArray($tasks);
        $this->assertCount(1, $tasks);
        $this->assertInstanceOf(Task::class, $tasks[0]);
        $this->assertEquals(2, $tasks[0]->getId());
    }
}
