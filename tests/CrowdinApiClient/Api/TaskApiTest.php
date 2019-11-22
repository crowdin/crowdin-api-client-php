<?php

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\Task;
use CrowdinApiClient\ModelCollection;

class TaskApiTest extends AbstractTestApi
{
    public function testList()
    {
        $this->mockRequest([
            'path' => '/projects/2/tasks',
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
        $this->assertInstanceOf(ModelCollection::class, $tasks);
        $this->assertCount(1, $tasks);
        $this->assertInstanceOf(Task::class, $tasks[0]);
        $this->assertEquals(2, $tasks[0]->getId());
    }

    public function testCreate()
    {
        $params = [
            'workflowStepId' => 0,
            'title' => 'French',
            'languageId' => 'fr',
            'fileIds' =>
                [
                    0 => 1,
                ],
            'status' => 'todo',
            'description' => 'Proofread all French strings',
            'splitFiles' => false,
            'assignees' =>
                [
                    0 =>
                        [
                            'id' => 1,
                            'wordsCount' => 5,
                        ],
                ],
            'deadline' => '2019-09-27T07:00:14+00:00',
            'dateFrom' => '2019-09-23T07:00:14+00:00',
            'dateTo' => '2019-09-27T07:00:14+00:00',
        ];

        $this->mockRequest([
            'path' => '/projects/2/tasks',
            'method' => 'post',
            'body' => $params,
            'response' => '{
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
                }'

        ]);

        $task = $this->crowdin->task->create(2, $params);
        $this->assertInstanceOf(Task::class, $task);
        $this->assertEquals(2, $task->getId());
    }

    public function testGetAndUpdate()
    {
        $this->mockRequestGet('/projects/2/tasks/2', '{
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
                }');

        $task = $this->crowdin->task->get(2, 2);
        $this->assertInstanceOf(Task::class, $task);
        $this->assertEquals(2, $task->getId());

        $this->mockRequestPath('/projects/2/tasks/2', '{
                  "data": {
                    "id": 2,
                    "projectId": 2,
                    "creatorId": 6,
                    "type": 1,
                    "status": "todo",
                    "title": "test edit",
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
                }');

        $task->setTitle('test edit');
        $task = $this->crowdin->task->update($task);
        $this->assertInstanceOf(Task::class, $task);
        $this->assertEquals(2, $task->getId());
        $this->assertEquals('test edit', $task->getTitle());
    }

    public function testDelete()
    {
        $this->mockRequestDelete('/projects/2/tasks/2');
        $this->crowdin->task->delete(2, 2);
    }
}
