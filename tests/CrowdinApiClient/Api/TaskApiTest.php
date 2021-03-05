<?php

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\DownloadFile;
use CrowdinApiClient\Model\Task;
use CrowdinApiClient\Model\TaskForUpdate;
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
                        "vendor":null,
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
                        "buyUrl": null,
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
        $this->assertEquals(null, $tasks[0]->getBuyUrl());
    }

    public function testCreate()
    {
        $params = [
            'title' => 'string',
            'languageId' => 'es',
            'fileIds' =>
                [
                    0 => 0,
                ],
            'type' => 0,
            'status' => 'todo',
            'description' => 'string',
            'splitFiles' => false,
            'assignees' =>
                [
                    0 =>
                        [
                            'id' => 0,
                            'wordsCount' => 0,
                        ],
                ],
            'deadline' => '2100-12-31T23:59:59+00:00',
            'dateFrom' => '2100-12-31T23:59:59+00:00',
            'dateTo' => '2100-12-31T23:59:59+00:00',
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
                    "vendor":"gengo",
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
        $this->assertEquals("gengo", $task->getVendor());

        $this->mockRequestPath('/projects/2/tasks/2', '{
                  "data": {
                    "id": 2,
                    "projectId": 2,
                    "creatorId": 6,
                    "type": 1,
                    "vendor":"gengo",
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

        $taskForUpdate = new TaskForUpdate($task->getData());
        $taskForUpdate->setTitle('test edit');
        $taskForUpdate->setSkipAssignedStrings(true);
        $taskForUpdate->setSplitFiles(true);
        $taskForUpdate->setLabelIds([1, 3]);
        $taskForUpdate->setDateFrom('2021-01-23T09:04:29+00:00');
        $taskForUpdate->setDateTo('2021-02-12T09:04:29+00:00');

        $task = $this->crowdin->task->update($taskForUpdate);
        $this->assertInstanceOf(Task::class, $task);
        $this->assertEquals(2, $task->getId());
        $this->assertEquals('test edit', $task->getTitle());
        $this->assertEquals('gengo', $task->getVendor());
    }

    public function testDelete()
    {
        $this->mockRequestDelete('/projects/2/tasks/2');
        $this->crowdin->task->delete(2, 2);
    }

    public function testExportStrings()
    {
        $this->mockRequest([
            'path' => '/projects/2/tasks/3/exports',
            'method' => 'post',
            'response' => '{
              "data": {
                "url": "https://production-enterprise-importer.downloads.crowdin.com/992000002/2/14.xliff?response-content-disposition=attachment%3B%20filename%3D%22APP.xliff%22&X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAIGJKLQV66ZXPMMEA%2F20190920%2Fus-east-1%2Fs3%2Faws4_request&X-Amz-Date=20190920T093121Z&X-Amz-SignedHeaders=host&X-Amz-Expires=3600&X-Amz-Signature=439ebd69a1b7e4c23e6d17891a491c94f832e0c82e4692dedb35a6cd1e624b62",
                "expireIn": "2019-09-20T10:31:21+00:00"
              }
            }'

        ]);

        $export = $this->crowdin->task->exportStrings(2, 3);
        $this->assertInstanceOf(DownloadFile::class, $export);
        $this->assertEquals('https://production-enterprise-importer.downloads.crowdin.com/992000002/2/14.xliff?response-content-disposition=attachment%3B%20filename%3D%22APP.xliff%22&X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAIGJKLQV66ZXPMMEA%2F20190920%2Fus-east-1%2Fs3%2Faws4_request&X-Amz-Date=20190920T093121Z&X-Amz-SignedHeaders=host&X-Amz-Expires=3600&X-Amz-Signature=439ebd69a1b7e4c23e6d17891a491c94f832e0c82e4692dedb35a6cd1e624b62', $export->getUrl());
    }

    public function testListUserTasks()
    {
        $this->mockRequestGet('/user/tasks', '{
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
                    "updatedAt": "2019-09-23T09:04:29+00:00",
                    "isArchived": false
                  }
                }
              ],
              "pagination": [
                {
                  "offset": 0,
                  "limit": 25
                }
              ]
            }');

        $tasks = $this->crowdin->task->listUserTasks();
        $this->assertInstanceOf(ModelCollection::class, $tasks);
        $this->assertCount(1, $tasks);
        $this->assertInstanceOf(Task::class, $tasks[0]);
        $this->assertEquals(2, $tasks[0]->getId());
    }

    public function testUserTaskArchivedStatus()
    {
        $this->mockRequestPath('/user/tasks/2?projectId=2', '{
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
                    "updatedAt": "2019-09-23T09:04:29+00:00",
                    "isArchived": true
                  }
                }', [

        ]);

        $task = $this->crowdin->task->userTaskArchivedStatus(2, 2);

        $this->assertInstanceOf(Task::class, $task);
        $this->assertEquals(2, $task->getId());
        $this->assertTrue($task->isArchived());
    }
}
