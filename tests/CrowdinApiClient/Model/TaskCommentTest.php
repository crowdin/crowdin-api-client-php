<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\TaskComment;
use PHPUnit\Framework\TestCase;

class TaskCommentTest extends TestCase
{
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
        $taskComment = new TaskComment($this->data);

        $this->assertEquals($this->data['id'], $taskComment->getId());
        $this->assertEquals($this->data['userId'], $taskComment->getUserId());
        $this->assertEquals($this->data['taskId'], $taskComment->getTaskId());
        $this->assertEquals($this->data['text'], $taskComment->getText());
        $this->assertEquals($this->data['timeSpent'], $taskComment->getTimeSpent());
        $this->assertEquals($this->data['createdAt'], $taskComment->getCreatedAt());
        $this->assertEquals($this->data['updatedAt'], $taskComment->getUpdatedAt());
    }

    public function testSetData()
    {
        $text = 'New task comment text';
        $timeSpent = 7200;

        $taskComment = new TaskComment();
        $taskComment->setText($text);
        $taskComment->setTimeSpent($timeSpent);

        $this->assertEquals($text, $taskComment->getText());
        $this->assertEquals($timeSpent, $taskComment->getTimeSpent());
    }
}
