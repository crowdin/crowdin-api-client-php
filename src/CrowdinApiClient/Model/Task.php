<?php

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class Task extends BaseModel
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var integer
     */
    protected $projectId;

    /**
     * @var integer
     */
    protected $creatorId;

    /**
     * @var integer
     */
    protected $type;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var integer|null
     */
    protected $batchId;

    /**
     * @var array
     */
    protected $assignees;

    /**
     * @var array
     */
    protected $assignedTeams;

    /**
     * @var array
     */
    protected $progress;

    /**
     * @deprecated
     * @var array|null
     */
    protected $translateProgress;

    /**
     * @var string
     */
    protected $sourceLanguageId;

    /**
     * @var string
     */
    protected $targetLanguageId;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $translationUrl;

    /**
     * @var string|null
     */
    protected $webUrl;

    /**
     * @var integer
     */
    protected $wordsCount;

    /**
     * @var integer
     */
    protected $commentsCount;

    /**
     * @var string
     */
    protected $deadline;

    /**
     * @var string|null
     */
    protected $startedAt;

    /**
     * @var string|null
     */
    protected $resolvedAt;

    /**
     * @var string
     */
    protected $timeRange;

    /**
     * @var string
     */
    protected $translationsUpdatedTimeRange;

    /**
     * @var integer
     */
    protected $workflowStepId;

    /**
     * @var string|null
     */
    protected $buyUrl;

    /**
     * @var string
     */
    protected $createdAt;

    /**
     * @var string
     */
    protected $updatedAt;

    /**
     * @var array
     */
    protected $sourceLanguage;

    /**
     * @var array
     */
    protected $targetLanguages;

    /**
     * @var int[]
     */
    protected $labelIds;

    /**
     * @var string|null
     */
    protected $labelMatchRule;

    /**
     * @var array
     */
    protected $excludeLabelIds;

    /**
     * @var string|null
     */
    protected $excludeLabelMatchRule;

    /**
     * @var int
     */
    protected $precedingTaskId;

    /**
     * @var array
     */
    protected $estimatedCost;

    /**
     * @var array
     */
    protected $actualCost;

    /**
     * @var bool
     */
    protected $generateCostEstimate;

    /**
     * @var bool
     */
    protected $generateTranslationCost;

    /**
     * @var int|null
     */
    protected $reportSettingsTemplateId;

    /**
     * @var string|null
     */
    protected $vendor;

    /**
     * @var integer
     */
    protected $filesCount;

    /**
     * @var array
     */
    protected $fileIds;

    /**
     * @var bool
     */
    protected $isArchived;

    /**
     * @var array
     */
    protected $fields = [];

    /**
     * @var string
     */
    protected $hash;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (int)$this->getDataProperty('id');
        $this->projectId = (int)$this->getDataProperty('projectId');
        $this->creatorId = (int)$this->getDataProperty('creatorId');
        $this->type = (int)$this->getDataProperty('type');
        $this->status = (string)$this->getDataProperty('status');
        $this->title = (string)$this->getDataProperty('title');
        $this->batchId = $this->getDataProperty('batchId') !== null ? (int)$this->getDataProperty('batchId') : null;
        $this->assignees = (array)$this->getDataProperty('assignees');
        $this->assignedTeams = (array)$this->getDataProperty('assignedTeams');
        $this->progress = (array)$this->getDataProperty('progress');
        $this->translateProgress = $this->getDataProperty('translateProgress')
            ? (array)$this->getDataProperty('translateProgress')
            : null;
        $this->sourceLanguageId = (string)$this->getDataProperty('sourceLanguageId');
        $this->targetLanguageId = (string)$this->getDataProperty('targetLanguageId');
        $this->description = (string)$this->getDataProperty('description');
        $this->translationUrl = (string)$this->getDataProperty('translationUrl');
        $this->webUrl = $this->getDataProperty('webUrl') ? (string)$this->getDataProperty('webUrl') : null;
        $this->wordsCount = (int)$this->getDataProperty('wordsCount');
        $this->commentsCount = (int)$this->getDataProperty('commentsCount');
        $this->deadline = (string)$this->getDataProperty('deadline');
        $this->startedAt = $this->getDataProperty('startedAt') ? (string)$this->getDataProperty('startedAt') : null;
        $this->resolvedAt = $this->getDataProperty('resolvedAt') ? (string)$this->getDataProperty('resolvedAt') : null;
        $this->timeRange = (string)$this->getDataProperty('timeRange');
        $this->translationsUpdatedTimeRange = (string)$this->getDataProperty('translationsUpdatedTimeRange');
        $this->workflowStepId = (int)$this->getDataProperty('workflowStepId');
        $this->buyUrl = $this->getDataProperty('buyUrl') ? (string)$this->getDataProperty('buyUrl') : null;
        $this->createdAt = (string)$this->getDataProperty('createdAt');
        $this->updatedAt = (string)$this->getDataProperty('updatedAt');
        $this->sourceLanguage = (array)$this->getDataProperty('sourceLanguage');
        $this->targetLanguages = (array)$this->getDataProperty('targetLanguages');
        $this->labelIds = $this->getDataProperty('labelIds') !== null
            ? (array)$this->getDataProperty('labelIds')
            : null;
        $this->labelMatchRule = $this->getDataProperty('labelMatchRule')
            ? (string)$this->getDataProperty('labelMatchRule')
            : null;
        $this->excludeLabelIds = (array)$this->getDataProperty('excludeLabelIds');
        $this->excludeLabelMatchRule = $this->getDataProperty('excludeLabelMatchRule')
            ? (string)$this->getDataProperty('excludeLabelMatchRule')
            : null;
        $this->precedingTaskId = (int)$this->getDataProperty('precedingTaskId');
        $this->estimatedCost = (array)$this->getDataProperty('estimatedCost');
        $this->actualCost = (array)$this->getDataProperty('actualCost');
        $this->generateCostEstimate = (bool)$this->getDataProperty('generateCostEstimate');
        $this->generateTranslationCost = (bool)$this->getDataProperty('generateTranslationCost');
        $this->reportSettingsTemplateId = $this->getDataProperty('reportSettingsTemplateId')
            ? (int)$this->getDataProperty('reportSettingsTemplateId')
            : null;
        $this->vendor = $this->getDataProperty('vendor') ? (string)$this->getDataProperty('vendor') : null;
        $this->filesCount = (int)$this->getDataProperty('filesCount');
        $this->fileIds = (array)$this->getDataProperty('fileIds');

        // User Task
        $this->isArchived = (bool)$this->getDataProperty('isArchived');

        // Enterprise only
        $this->fields = (array)$this->getDataProperty('fields');

        // Deprecated
        $this->hash = (string)$this->getDataProperty('hash');
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getProjectId(): int
    {
        return $this->projectId;
    }

    /**
     * @return int
     */
    public function getCreatorId(): int
    {
        return $this->creatorId;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getBatchId(): ?int
    {
        return $this->batchId;
    }

    /**
     * @return array
     */
    public function getAssignees(): array
    {
        return $this->assignees;
    }

    /**
     * @param array $assignees
     */
    public function setAssignees(array $assignees): void
    {
        $this->assignees = $assignees;
    }

    public function getAssignedTeams(): array
    {
        return $this->assignedTeams;
    }

    public function setAssignedTeams(array $assignedTeams): void
    {
        $this->assignedTeams = $assignedTeams;
    }

    /**
     * @return array
     */
    public function getProgress(): array
    {
        return $this->progress;
    }

    /**
     * @return array|null
     */
    public function getTranslateProgress(): ?array
    {
        return $this->translateProgress;
    }

    /**
     * @return string
     */
    public function getSourceLanguageId(): string
    {
        return $this->sourceLanguageId;
    }

    /**
     * @return string
     */
    public function getTargetLanguageId(): string
    {
        return $this->targetLanguageId;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getTranslationUrl(): string
    {
        return $this->translationUrl;
    }

    public function getWebUrl(): ?string
    {
        return $this->webUrl;
    }

    /**
     * @return int
     */
    public function getWordsCount(): int
    {
        return $this->wordsCount;
    }

    /**
     * @return int
     */
    public function getCommentsCount(): int
    {
        return $this->commentsCount;
    }

    /**
     * @return string
     */
    public function getDeadline(): string
    {
        return $this->deadline;
    }

    /**
     * @param string $deadline
     */
    public function setDeadline(string $deadline): void
    {
        $this->deadline = $deadline;
    }

    public function getStartedAt(): ?string
    {
        return $this->startedAt;
    }

    public function setStartedAt(?string $startedAt): void
    {
        $this->startedAt = $startedAt;
    }

    public function getResolvedAt(): ?string
    {
        return $this->resolvedAt;
    }

    public function setResolvedAt(?string $resolvedAt): void
    {
        $this->resolvedAt = $resolvedAt;
    }

    /**
     * @return string
     */
    public function getTimeRange(): string
    {
        return $this->timeRange;
    }

    public function getTranslationsUpdatedTimeRange(): string
    {
        return $this->translationsUpdatedTimeRange;
    }

    /**
     * @return int
     */
    public function getWorkflowStepId(): int
    {
        return $this->workflowStepId;
    }

    public function getBuyUrl(): ?string
    {
        return $this->buyUrl;
    }

    /**
     * @deprecated Crowdin API does not allow update this property. This method is will be removed in a future major release.
     * @param string|null $buyUrl
     */
    public function setBuyUrl(?string $buyUrl): void
    {
        $this->buyUrl = $buyUrl;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function getVendor(): ?string
    {
        return $this->vendor;
    }

    /**
     * @deprecated Crowdin API does not allow update this property. This method is will be removed in a future major release.
     * @param string|null $vendor
     */
    public function setVendor(?string $vendor): void
    {
        $this->vendor = $vendor;
    }

    /**
     * @return int
     */
    public function getFilesCount(): int
    {
        return $this->filesCount;
    }

    /**
     * @return array
     */
    public function getFileIds(): array
    {
        return $this->fileIds;
    }

    /**
     * @param array $fileIds
     */
    public function setFileIds(array $fileIds): void
    {
        $this->fileIds = $fileIds;
    }

    /**
     * @return bool
     */
    public function isArchived(): ?bool
    {
        return $this->isArchived;
    }

    /**
     * @deprecated Crowdin API does not allow update this property. This method is will be removed in a future major release.
     * @param bool $isArchived
     */
    public function setIsArchived(bool $isArchived): void
    {
        $this->isArchived = $isArchived;
    }

    /**
     * @return array
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * @param array $fields
     */
    public function setFields(array $fields): void
    {
        $this->fields = $fields;
    }

    public function getSourceLanguage(): array
    {
        return $this->sourceLanguage;
    }

    public function getTargetLanguages(): array
    {
        return $this->targetLanguages;
    }

    /**
     * @return int[]|null
     */
    public function getLabelIds(): ?array
    {
        return $this->labelIds;
    }

    /**
     * @param int[] $labelIds
     */
    public function setLabelIds(array $labelIds): void
    {
        $this->labelIds = $labelIds;
    }

    public function getLabelMatchRule(): ?string
    {
        return $this->labelMatchRule;
    }

    public function setLabelMatchRule(?string $labelMatchRule): void
    {
        $this->labelMatchRule = $labelMatchRule;
    }

    public function getExcludeLabelIds(): array
    {
        return $this->excludeLabelIds;
    }

    public function setExcludeLabelIds(array $excludeLabelIds): void
    {
        $this->excludeLabelIds = $excludeLabelIds;
    }

    public function getExcludeLabelMatchRule(): ?string
    {
        return $this->excludeLabelMatchRule;
    }

    public function setExcludeLabelMatchRule(?string $excludeLabelMatchRule): void
    {
        $this->excludeLabelMatchRule = $excludeLabelMatchRule;
    }

    public function getPrecedingTaskId(): int
    {
        return $this->precedingTaskId;
    }

    public function getEstimatedCost(): array
    {
        return $this->estimatedCost;
    }

    public function getActualCost(): array
    {
        return $this->actualCost;
    }

    public function getGenerateCostEstimate(): bool
    {
        return $this->generateCostEstimate;
    }

    public function setGenerateCostEstimate(bool $generateCostEstimate): void
    {
        $this->generateCostEstimate = $generateCostEstimate;
    }

    public function getGenerateTranslationCost(): bool
    {
        return $this->generateTranslationCost;
    }

    public function setGenerateTranslationCost(bool $generateTranslationCost): void
    {
        $this->generateTranslationCost = $generateTranslationCost;
    }

    public function getReportSettingsTemplateId(): ?int
    {
        return $this->reportSettingsTemplateId;
    }

    public function setReportSettingsTemplateId(?int $reportSettingsTemplateId): void
    {
        $this->reportSettingsTemplateId = $reportSettingsTemplateId;
    }

    /**
     * @deprecated Crowdin API does not return this property anymore. This method is will be removed in a future major release.
     * @return string|null
     */
    public function getHash(): ?string
    {
        return $this->hash;
    }
}
