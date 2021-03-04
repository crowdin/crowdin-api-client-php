<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\TaskForUpdate;
use PHPUnit\Framework\TestCase;

class TaskForUpdateTest extends TestCase
{
    /**
     * @var TaskForUpdate
     */
    public $taskForUpdate;

    public $data = [
        'id' => 2,
        'projectId' => 2,
        'creatorId' => 6,
        'type' => 1,
        'vendor' => 'gengo',
        'status' => 'todo',
        'title' => 'French',
        'assignees' =>
            [
                0 =>
                    [
                        'id' => 1,
                        'wordsCount' => 5,
                    ],
            ],
        "assignedTeams" => [
            [
                'id' => 1,
                'wordsCount' => 5,
            ]
        ],
        'fileIds' =>
            [
                0 => 1,
            ],
        'progress' =>
            [
                'total' => 24,
                'done' => 15,
                'percent' => 62,
            ],
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
        'isArchived' => false
    ];

    public function testLoadData()
    {
        $this->taskForUpdate = new TaskForUpdate($this->data);
        $this->checkData();
    }

    public function testSetData()
    {
        $this->taskForUpdate = new TaskForUpdate();
        $this->taskForUpdate->setStatus($this->data['status']);
        $this->taskForUpdate->setTitle($this->data['title']);
        $this->taskForUpdate->setSkipAssignedStrings(true);
        $this->taskForUpdate->setSplitFiles(true);
        $this->taskForUpdate->setDateFrom('2021-03-01T11:05:24+00:00');
        $this->taskForUpdate->setDateTo('2021-03-04T11:05:24+00:00');
        $this->taskForUpdate->setLabelIds([8, 9, 23]);

        $this->assertEquals($this->data['status'], $this->taskForUpdate->getStatus());
        $this->assertEquals($this->data['title'], $this->taskForUpdate->getTitle());
        $this->assertEquals(true, $this->taskForUpdate->getSkipAssignedStrings());
        $this->assertEquals(true, $this->taskForUpdate->getSplitFiles());
        $this->assertEquals('2021-03-01T11:05:24+00:00', $this->taskForUpdate->getDateFrom());
        $this->assertEquals('2021-03-04T11:05:24+00:00', $this->taskForUpdate->getDateTo());
        $this->assertEquals([8, 9, 23], $this->taskForUpdate->getLabelIds());
    }

    public function checkData()
    {
        $this->assertEquals($this->data['id'], $this->taskForUpdate->getId());
        $this->assertEquals($this->data['projectId'], $this->taskForUpdate->getProjectId());
        $this->assertEquals($this->data['creatorId'], $this->taskForUpdate->getCreatorId());
        $this->assertEquals($this->data['type'], $this->taskForUpdate->getType());
        $this->assertEquals($this->data['vendor'], $this->taskForUpdate->getVendor());
        $this->assertEquals($this->data['status'], $this->taskForUpdate->getStatus());
        $this->assertEquals($this->data['title'], $this->taskForUpdate->getTitle());
        $this->assertEquals($this->data['assignees'], $this->taskForUpdate->getAssignees());
        $this->assertEquals($this->data['assignedTeams'], $this->taskForUpdate->getAssignedTeams());
        $this->assertEquals($this->data['fileIds'], $this->taskForUpdate->getFileIds());
        $this->assertEquals($this->data['progress'], $this->taskForUpdate->getProgress());
        $this->assertEquals($this->data['sourceLanguageId'], $this->taskForUpdate->getSourceLanguageId());
        $this->assertEquals($this->data['targetLanguageId'], $this->taskForUpdate->getTargetLanguageId());
        $this->assertEquals($this->data['description'], $this->taskForUpdate->getDescription());
        $this->assertEquals($this->data['hash'], $this->taskForUpdate->getHash());
        $this->assertEquals($this->data['translationUrl'], $this->taskForUpdate->getTranslationUrl());
        $this->assertEquals($this->data['wordsCount'], $this->taskForUpdate->getWordsCount());
        $this->assertEquals($this->data['filesCount'], $this->taskForUpdate->getFilesCount());
        $this->assertEquals($this->data['commentsCount'], $this->taskForUpdate->getCommentsCount());
        $this->assertEquals($this->data['deadline'], $this->taskForUpdate->getDeadline());
        $this->assertEquals($this->data['timeRange'], $this->taskForUpdate->getTimeRange());
        $this->assertEquals($this->data['workflowStepId'], $this->taskForUpdate->getWorkflowStepId());
        $this->assertEquals($this->data['buyUrl'], $this->taskForUpdate->getBuyUrl());
        $this->assertEquals($this->data['createdAt'], $this->taskForUpdate->getCreatedAt());
        $this->assertEquals($this->data['updatedAt'], $this->taskForUpdate->getUpdatedAt());
        $this->assertEquals($this->data['isArchived'], $this->taskForUpdate->isArchived());
    }
}
