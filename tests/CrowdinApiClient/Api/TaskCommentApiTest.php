<?php

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\TaskComment;
use CrowdinApiClient\ModelCollection;

class TaskCommentApiTest extends AbstractTestApi
{
    public function testList()
    {
        $this->mockRequest([
            'path' => '/projects/2/tasks/203/comments',
            'method' => 'get',
            'response' => '{
                  "data": [
                    {
                      "data": {
                        "id": 1233,
                        "userId": 5,
                        "taskId": 203,
                        "text": "translate task",
                        "timeSpent": 3600,
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

        $taskComments = $this->crowdin->taskComment->list(2, 203);
        $this->assertInstanceOf(ModelCollection::class, $taskComments);
        $this->assertCount(1, $taskComments);
        $this->assertInstanceOf(TaskComment::class, $taskComments[0]);
        $this->assertEquals(1233, $taskComments[0]->getId());
    }

    public function testGet()
    {
        $this->mockRequest([
            'path' => '/projects/2/tasks/203/comments/1233',
            'method' => 'get',
            'response' => '{
                  "data": {
                    "id": 1233,
                    "userId": 5,
                    "taskId": 203,
                    "text": "translate task",
                    "timeSpent": 3600,
                    "createdAt": "2019-09-23T09:04:29+00:00",
                    "updatedAt": "2019-09-23T09:04:29+00:00"
                  }
                }'
        ]);

        $taskComment = $this->crowdin->taskComment->get(2, 203, 1233);
        $this->assertInstanceOf(TaskComment::class, $taskComment);
        $this->assertEquals(1233, $taskComment->getId());
    }
}
