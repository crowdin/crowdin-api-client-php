<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\TaskComment;
use PHPUnit\Framework\TestCase;

class TaskCommentTest extends TestCase
{
    /**
     * @var TaskComment
     */
    public $taskComment;

    public $data = [
        'id' => 1233,
        'userId' => 5,
        'taskId' => 203,
        'text' => 'translate task',
        'timeSpent' => 3600,
        'createdAt' => '2019-09-23T09:04:29+00:00',
        'updatedAt' => '2019-09-23T09:04:29+00:00',
    ];

    public function testLoadData()
    {
        $this->taskComment = new TaskComment($this->data);
        $this->checkData();
    }

    public function testSetData()
    {
        $this->taskComment = new TaskComment();
        $this->taskComment->setText($this->data['text']);
        $this->taskComment->setTimeSpent($this->data['timeSpent']);

        $this->assertEquals($this->data['text'], $this->taskComment->getText());
        $this->assertEquals($this->data['timeSpent'], $this->taskComment->getTimeSpent());
    }

    public function checkData()
    {
        $this->assertEquals($this->data['id'], $this->taskComment->getId());
        $this->assertEquals($this->data['userId'], $this->taskComment->getUserId());
        $this->assertEquals($this->data['taskId'], $this->taskComment->getTaskId());
        $this->assertEquals($this->data['text'], $this->taskComment->getText());
        $this->assertEquals($this->data['timeSpent'], $this->taskComment->getTimeSpent());
        $this->assertEquals($this->data['createdAt'], $this->taskComment->getCreatedAt());
        $this->assertEquals($this->data['updatedAt'], $this->taskComment->getUpdatedAt());
    }
}
