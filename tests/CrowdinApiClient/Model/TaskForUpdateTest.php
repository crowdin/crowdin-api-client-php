<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\TaskForUpdate;
use PHPUnit\Framework\TestCase;

class TaskForUpdateTest extends TestCase
{
    public $data = [
        'id' => 2,
        'projectId' => 2,
        'creatorId' => 6,
        'type' => 1,
        'status' => 'todo',
        'title' => 'French',
        'batchId' => 1,
        'splitFiles' => true,
        'splitContent' => true,
        'stringIds' => [1, 2, 3],
        'skipAssignedStrings' => true,
        'assignees' => [
            [
                'id' => 1,
                'username' => 'john.doe',
                'fullName' => 'John Doe',
                'avatarUrl' => '',
                'wordsCount' => 165,
                'wordsLeft' => 5,
                'timeSpent' => 56,
            ],
        ],
        'assignedTeams' => [
            [
                'id' => 1,
                'wordsCount' => 5,
                'timeSpent' => 3600,
            ],
        ],
        'progress' => [
            'total' => 24,
            'done' => 15,
            'percent' => 62,
        ],
        'translateProgress' => [
            'total' => 24,
            'done' => 15,
            'percent' => 62,
        ],
        'sourceLanguageId' => 'en',
        'targetLanguageId' => 'fr',
        'description' => 'Proofread all French strings',
        'translationUrl' => '/proofread/9092638ac9f2a2d1b5571d08edc53763/all/en-fr/10?task=dac37aff364d83899128e68afe0de4994',
        'webUrl' => 'https://crowdin.com/project/example/tasks/2',
        'wordsCount' => 24,
        'commentsCount' => 0,
        'deadline' => '2019-09-27T07:00:14+00:00',
        'startedAt' => '2019-09-25T07:00:14+00:00',
        'resolvedAt' => '2019-09-26T07:00:14+00:00',
        'dateFrom' => '2019-09-23T09:04:29+00:00',
        'dateTo' => '2019-09-27T07:00:14+00:00',
        'translationsUpdatedDateFrom' => '2019-09-20T09:04:29+00:00',
        'translationsUpdatedDateTo' => '2019-09-25T09:04:29+00:00',
        'timeRange' => 'string',
        'translationsUpdatedTimeRange' => 'string',
        'workflowStepId' => 10,
        'buyUrl' => 'https://www.paypal.com/cgi-bin/webscr?cmd=...',
        'createdAt' => '2019-09-23T09:04:29+00:00',
        'updatedAt' => '2019-09-23T09:04:29+00:00',
        'sourceLanguage' => [
            'id' => 'en',
            'name' => 'English',
        ],
        'targetLanguages' => [
            [
                'id' => 'fr',
                'name' => 'French',
            ],
        ],
        'labelIds' => [13, 27],
        'labelMatchRule' => 'all',
        'excludeLabelIds' => [],
        'excludeLabelMatchRule' => null,
        'precedingTaskId' => 1,
        'estimatedCost' => [
            'cost' => 10.0,
            'date' => '2019-09-23T09:04:29+00:00',
            'currency' => 'USD',
        ],
        'actualCost' => [
            'cost' => 12.0,
            'date' => '2019-09-23T09:04:29+00:00',
            'currency' => 'USD',
        ],
        'generateCostEstimate' => true,
        'generateTranslationCost' => false,
        'reportSettingsTemplateId' => null,
        'vendor' => 'gengo',
        'filesCount' => 2,
        'fileIds' => [1, 2],
        'isArchived' => false,
        'fields' => [
            'client-company' => 'ACME Corp',
        ],
    ];

    public function testLoadData()
    {
        $taskForUpdate = new TaskForUpdate($this->data);
        $this->assertEquals($this->data['id'], $taskForUpdate->getId());
        $this->assertEquals($this->data['projectId'], $taskForUpdate->getProjectId());
        $this->assertEquals($this->data['creatorId'], $taskForUpdate->getCreatorId());
        $this->assertEquals($this->data['type'], $taskForUpdate->getType());
        $this->assertEquals($this->data['vendor'], $taskForUpdate->getVendor());
        $this->assertEquals($this->data['status'], $taskForUpdate->getStatus());
        $this->assertEquals($this->data['title'], $taskForUpdate->getTitle());
        $this->assertEquals($this->data['splitFiles'], $taskForUpdate->getSplitFiles());
        $this->assertEquals($this->data['splitContent'], $taskForUpdate->getSplitContent());
        $this->assertEquals($this->data['stringIds'], $taskForUpdate->getStringIds());
        $this->assertEquals($this->data['skipAssignedStrings'], $taskForUpdate->getSkipAssignedStrings());
        $this->assertEquals($this->data['assignees'], $taskForUpdate->getAssignees());
        $this->assertEquals($this->data['assignedTeams'], $taskForUpdate->getAssignedTeams());
        $this->assertEquals($this->data['fileIds'], $taskForUpdate->getFileIds());
        $this->assertEquals($this->data['progress'], $taskForUpdate->getProgress());
        $this->assertEquals($this->data['translateProgress'], $taskForUpdate->getTranslateProgress());
        $this->assertEquals($this->data['sourceLanguageId'], $taskForUpdate->getSourceLanguageId());
        $this->assertEquals($this->data['targetLanguageId'], $taskForUpdate->getTargetLanguageId());
        $this->assertEquals($this->data['description'], $taskForUpdate->getDescription());
        $this->assertEquals($this->data['translationUrl'], $taskForUpdate->getTranslationUrl());
        $this->assertEquals($this->data['wordsCount'], $taskForUpdate->getWordsCount());
        $this->assertEquals($this->data['filesCount'], $taskForUpdate->getFilesCount());
        $this->assertEquals($this->data['commentsCount'], $taskForUpdate->getCommentsCount());
        $this->assertEquals($this->data['deadline'], $taskForUpdate->getDeadline());
        $this->assertEquals($this->data['startedAt'], $taskForUpdate->getStartedAt());
        $this->assertEquals($this->data['resolvedAt'], $taskForUpdate->getResolvedAt());
        $this->assertEquals($this->data['dateFrom'], $taskForUpdate->getDateFrom());
        $this->assertEquals($this->data['dateTo'], $taskForUpdate->getDateTo());
        $this->assertEquals($this->data['translationsUpdatedDateFrom'], $taskForUpdate->getTranslationsUpdatedDateFrom());
        $this->assertEquals($this->data['translationsUpdatedDateTo'], $taskForUpdate->getTranslationsUpdatedDateTo());
        $this->assertEquals($this->data['timeRange'], $taskForUpdate->getTimeRange());
        $this->assertEquals($this->data['translationsUpdatedTimeRange'], $taskForUpdate->getTranslationsUpdatedTimeRange());
        $this->assertEquals($this->data['workflowStepId'], $taskForUpdate->getWorkflowStepId());
        $this->assertEquals($this->data['buyUrl'], $taskForUpdate->getBuyUrl());
        $this->assertEquals($this->data['createdAt'], $taskForUpdate->getCreatedAt());
        $this->assertEquals($this->data['updatedAt'], $taskForUpdate->getUpdatedAt());
        $this->assertEquals($this->data['isArchived'], $taskForUpdate->isArchived());
    }

    public function testSetData()
    {
        $status = 'in_progress';
        $title = 'New Title';
        $splitFiles = true;
        $splitContent = false;
        $stringIds = [4, 5, 6];
        $skipAssignedStrings = true;
        $dateFrom = '2021-03-01T11:05:24+00:00';
        $dateTo = '2021-03-04T11:05:24+00:00';
        $translationsUpdatedDateFrom = '2021-02-01T11:05:24+00:00';
        $translationsUpdatedDateTo = '2021-02-15T11:05:24+00:00';
        $labelIds = [8, 9, 23];

        $data = $this->data;
        $data['stringIds'] = null;

        $taskForUpdate = new TaskForUpdate($data);
        $taskForUpdate->setStatus($status);
        $taskForUpdate->setTitle($title);
        $taskForUpdate->setSplitFiles($splitFiles);
        $taskForUpdate->setSplitContent($splitContent);
        $taskForUpdate->setStringIds($stringIds);
        $taskForUpdate->setSkipAssignedStrings($skipAssignedStrings);
        $taskForUpdate->setDateFrom($dateFrom);
        $taskForUpdate->setDateTo($dateTo);
        $taskForUpdate->setTranslationsUpdatedDateFrom($translationsUpdatedDateFrom);
        $taskForUpdate->setTranslationsUpdatedDateTo($translationsUpdatedDateTo);
        $taskForUpdate->setLabelIds($labelIds);

        $this->assertEquals($status, $taskForUpdate->getStatus());
        $this->assertEquals($title, $taskForUpdate->getTitle());
        $this->assertEquals($splitFiles, $taskForUpdate->getSplitFiles());
        $this->assertEquals($splitContent, $taskForUpdate->getSplitContent());
        $this->assertEquals($stringIds, $taskForUpdate->getStringIds());
        $this->assertEquals($skipAssignedStrings, $taskForUpdate->getSkipAssignedStrings());
        $this->assertEquals($dateFrom, $taskForUpdate->getDateFrom());
        $this->assertEquals($dateTo, $taskForUpdate->getDateTo());
        $this->assertEquals($translationsUpdatedDateFrom, $taskForUpdate->getTranslationsUpdatedDateFrom());
        $this->assertEquals($translationsUpdatedDateTo, $taskForUpdate->getTranslationsUpdatedDateTo());
        $this->assertEquals($labelIds, $taskForUpdate->getLabelIds());
    }
}
