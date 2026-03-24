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
        'status' => 'todo',
        'title' => 'French',
        'batchId' => 1,
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
        'hash' => 'd41d8cd98f00b204e9800998ecf8427e',
    ];

    public function testLoadData(): void
    {
        $task = new Task($this->data);

        $this->assertEquals($this->data['id'], $task->getId());
        $this->assertEquals($this->data['projectId'], $task->getProjectId());
        $this->assertEquals($this->data['creatorId'], $task->getCreatorId());
        $this->assertEquals($this->data['type'], $task->getType());
        $this->assertEquals($this->data['status'], $task->getStatus());
        $this->assertEquals($this->data['title'], $task->getTitle());
        $this->assertEquals($this->data['batchId'], $task->getBatchId());
        $this->assertEquals($this->data['assignees'], $task->getAssignees());
        $this->assertEquals($this->data['assignedTeams'], $task->getAssignedTeams());
        $this->assertEquals($this->data['progress'], $task->getProgress());
        $this->assertEquals($this->data['translateProgress'], $task->getTranslateProgress());
        $this->assertEquals($this->data['sourceLanguageId'], $task->getSourceLanguageId());
        $this->assertEquals($this->data['targetLanguageId'], $task->getTargetLanguageId());
        $this->assertEquals($this->data['description'], $task->getDescription());
        $this->assertEquals($this->data['translationUrl'], $task->getTranslationUrl());
        $this->assertEquals($this->data['webUrl'], $task->getWebUrl());
        $this->assertEquals($this->data['wordsCount'], $task->getWordsCount());
        $this->assertEquals($this->data['commentsCount'], $task->getCommentsCount());
        $this->assertEquals($this->data['deadline'], $task->getDeadline());
        $this->assertEquals($this->data['startedAt'], $task->getStartedAt());
        $this->assertEquals($this->data['resolvedAt'], $task->getResolvedAt());
        $this->assertEquals($this->data['timeRange'], $task->getTimeRange());
        $this->assertEquals($this->data['translationsUpdatedTimeRange'], $task->getTranslationsUpdatedTimeRange());
        $this->assertEquals($this->data['workflowStepId'], $task->getWorkflowStepId());
        $this->assertEquals($this->data['buyUrl'], $task->getBuyUrl());
        $this->assertEquals($this->data['createdAt'], $task->getCreatedAt());
        $this->assertEquals($this->data['updatedAt'], $task->getUpdatedAt());
        $this->assertEquals($this->data['sourceLanguage'], $task->getSourceLanguage());
        $this->assertEquals($this->data['targetLanguages'], $task->getTargetLanguages());
        $this->assertEquals($this->data['labelIds'], $task->getLabelIds());
        $this->assertEquals($this->data['labelMatchRule'], $task->getLabelMatchRule());
        $this->assertEquals($this->data['excludeLabelIds'], $task->getExcludeLabelIds());
        $this->assertEquals($this->data['excludeLabelMatchRule'], $task->getExcludeLabelMatchRule());
        $this->assertEquals($this->data['precedingTaskId'], $task->getPrecedingTaskId());
        $this->assertEquals($this->data['estimatedCost'], $task->getEstimatedCost());
        $this->assertEquals($this->data['actualCost'], $task->getActualCost());
        $this->assertEquals($this->data['generateCostEstimate'], $task->getGenerateCostEstimate());
        $this->assertEquals($this->data['generateTranslationCost'], $task->getGenerateTranslationCost());
        $this->assertEquals($this->data['reportSettingsTemplateId'], $task->getReportSettingsTemplateId());
        $this->assertEquals($this->data['vendor'], $task->getVendor());
        $this->assertEquals($this->data['filesCount'], $task->getFilesCount());
        $this->assertEquals($this->data['fileIds'], $task->getFileIds());
        $this->assertEquals($this->data['isArchived'], $task->isArchived());
        $this->assertEquals($this->data['fields'], $task->getFields());
        $this->assertEquals($this->data['hash'], $task->getHash());
    }

    public function testSetData(): void
    {
        $status = 'in_progress';
        $title = 'New Title';
        $assignees = [
            [
                'id' => 2,
                'wordsCount' => 10,
            ],
        ];
        $assignedTeams = [
            [
                'id' => 2,
                'wordsCount' => 5,
                'timeSpent' => 7200,
            ],
        ];
        $fileIds = [3, 4];
        $description = 'New description';
        $deadline = '2021-12-31T23:59:59+00:00';
        $startedAt = '2021-06-01T10:00:00+00:00';
        $resolvedAt = '2021-06-15T10:00:00+00:00';
        $labelIds = [1, 2, 3];
        $labelMatchRule = 'any';
        $excludeLabelIds = [4, 5];
        $excludeLabelMatchRule = 'all';
        $generateCostEstimate = false;
        $generateTranslationCost = true;
        $reportSettingsTemplateId = 10;
        $fields = ['key' => 'value'];
        $buyUrl = 'https://example.com/buy';
        $vendor = 'lokalise';
        $isArchived = true;

        $data = $this->data;
        $data['excludeLabelMatchRule'] = 'any';
        $data['reportSettingsTemplateId'] = 8;
        $task = new Task($data);

        $task->setStatus($status);
        $task->setTitle($title);
        $task->setAssignees($assignees);
        $task->setAssignedTeams($assignedTeams);
        $task->setFileIds($fileIds);
        $task->setDescription($description);
        $task->setDeadline($deadline);
        $task->setStartedAt($startedAt);
        $task->setResolvedAt($resolvedAt);
        $task->setLabelIds($labelIds);
        $task->setLabelMatchRule($labelMatchRule);
        $task->setExcludeLabelIds($excludeLabelIds);
        $task->setExcludeLabelMatchRule($excludeLabelMatchRule);
        $task->setGenerateCostEstimate($generateCostEstimate);
        $task->setGenerateTranslationCost($generateTranslationCost);
        $task->setReportSettingsTemplateId($reportSettingsTemplateId);
        $task->setFields($fields);
        $task->setBuyUrl($buyUrl);
        $task->setVendor($vendor);
        $task->setIsArchived($isArchived);

        $this->assertEquals($status, $task->getStatus());
        $this->assertEquals($title, $task->getTitle());
        $this->assertEquals($assignees, $task->getAssignees());
        $this->assertEquals($assignedTeams, $task->getAssignedTeams());
        $this->assertEquals($fileIds, $task->getFileIds());
        $this->assertEquals($description, $task->getDescription());
        $this->assertEquals($deadline, $task->getDeadline());
        $this->assertEquals($startedAt, $task->getStartedAt());
        $this->assertEquals($resolvedAt, $task->getResolvedAt());
        $this->assertEquals($labelIds, $task->getLabelIds());
        $this->assertEquals($labelMatchRule, $task->getLabelMatchRule());
        $this->assertEquals($excludeLabelIds, $task->getExcludeLabelIds());
        $this->assertEquals($excludeLabelMatchRule, $task->getExcludeLabelMatchRule());
        $this->assertEquals($generateCostEstimate, $task->getGenerateCostEstimate());
        $this->assertEquals($generateTranslationCost, $task->getGenerateTranslationCost());
        $this->assertEquals($reportSettingsTemplateId, $task->getReportSettingsTemplateId());
        $this->assertEquals($fields, $task->getFields());
        $this->assertEquals($buyUrl, $task->getBuyUrl());
        $this->assertEquals($vendor, $task->getVendor());
        $this->assertEquals($isArchived, $task->isArchived());
    }
}
