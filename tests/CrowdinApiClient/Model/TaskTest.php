<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\Task;
use PHPUnit\Framework\TestCase;

class TaskTest extends TestCase
{
    public $data = [
        'id' => 2,
        'projectId' => 2,
        'creatorId' => 6,
        'type' => 1,
        'vendor' => 'gengo',
        'status' => 'todo',
        'title' => 'French',
        'assignees' => [
            [
                'id' => 1,
                'wordsCount' => 5,
            ],
        ],
        'assignedTeams' => [
            [
                'id' => 1,
                'wordsCount' => 5,
            ]
        ],
        'fileIds' => [
            1,
        ],
        'progress' => [
            'total' => 24,
            'done' => 15,
            'percent' => 62,
        ],
        'translateProgress' => null,
        'sourceLanguageId' => 'en',
        'targetLanguageId' => 'fr',
        'description' => 'Proofrea all French strings',
        'hash' => 'dac37aff364d83899128e68afe0de4994',
        'translationUrl' => '/proofrea/9092638ac9f2a2d1b5571d08edc53763/all/en-fr/10?task=dac37aff364d83899128e68afe0de4994',
        'wordsCount' => 24,
        'filesCount' => 2,
        'commentsCount' => 0,
        'deadline' => '2019-09-27T07:00:14+00:00',
        'timeRange' => 'string',
        'workflowStepId' => 10,
        'buyUrl' => 'https://www.paypal.com/cgi-bin/webscr?cmd=...',
        'createdAt' => '2019-09-23T09:04:29+00:00',
        'updatedAt' => '2019-09-23T09:04:29+00:00',
        'isArchived' => false,
        'fields' => [
            'client-company' => 'ACME Corp',
        ],
    ];

    public function testLoadData(): void
    {
        $task = new Task($this->data);
        $this->assertEquals($this->data['id'], $task->getId());
        $this->assertEquals($this->data['projectId'], $task->getProjectId());
        $this->assertEquals($this->data['creatorId'], $task->getCreatorId());
        $this->assertEquals($this->data['type'], $task->getType());
        $this->assertEquals($this->data['vendor'], $task->getVendor());
        $this->assertEquals($this->data['status'], $task->getStatus());
        $this->assertEquals($this->data['title'], $task->getTitle());
        $this->assertEquals($this->data['assignees'], $task->getAssignees());
        $this->assertEquals($this->data['assignedTeams'], $task->getAssignedTeams());
        $this->assertEquals($this->data['fileIds'], $task->getFileIds());
        $this->assertEquals($this->data['progress'], $task->getProgress());
        $this->assertEquals($this->data['translateProgress'], $task->getTranslateProgress());
        $this->assertEquals($this->data['sourceLanguageId'], $task->getSourceLanguageId());
        $this->assertEquals($this->data['targetLanguageId'], $task->getTargetLanguageId());
        $this->assertEquals($this->data['description'], $task->getDescription());
        $this->assertEquals($this->data['hash'], $task->getHash());
        $this->assertEquals($this->data['translationUrl'], $task->getTranslationUrl());
        $this->assertEquals($this->data['wordsCount'], $task->getWordsCount());
        $this->assertEquals($this->data['filesCount'], $task->getFilesCount());
        $this->assertEquals($this->data['commentsCount'], $task->getCommentsCount());
        $this->assertEquals($this->data['deadline'], $task->getDeadline());
        $this->assertEquals($this->data['timeRange'], $task->getTimeRange());
        $this->assertEquals($this->data['workflowStepId'], $task->getWorkflowStepId());
        $this->assertEquals($this->data['buyUrl'], $task->getBuyUrl());
        $this->assertEquals($this->data['createdAt'], $task->getCreatedAt());
        $this->assertEquals($this->data['updatedAt'], $task->getUpdatedAt());
        $this->assertEquals($this->data['isArchived'], $task->isArchived());
        $this->assertEquals($this->data['fields'], $task->getFields());
    }

    public function testSetData(): void
    {
        $task = new Task();
        $task->setStatus($this->data['status']);
        $task->setTitle($this->data['title']);
        $task->setAssignees($this->data['assignees']);
        $task->setAssignedTeams($this->data['assignedTeams']);
        $task->setFileIds($this->data['fileIds']);
        $task->setDescription($this->data['description']);
        $task->setDeadline($this->data['deadline']);
        $task->setIsArchived($this->data['isArchived']);
        $task->setFields($this->data['fields']);

        $this->assertEquals($this->data['status'], $task->getStatus());
        $this->assertEquals($this->data['title'], $task->getTitle());
        $this->assertEquals($this->data['assignees'], $task->getAssignees());
        $this->assertEquals($this->data['assignedTeams'], $task->getAssignedTeams());
        $this->assertEquals($this->data['fileIds'], $task->getFileIds());
        $this->assertEquals($this->data['description'], $task->getDescription());
        $this->assertEquals($this->data['deadline'], $task->getDeadline());
        $this->assertEquals($this->data['isArchived'], $task->isArchived());
        $this->assertEquals($this->data['fields'], $task->getFields());
    }
}
