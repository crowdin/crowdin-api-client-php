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
     * @var string|null
     */
    protected $vendor;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var string
     */
    protected $title;

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
    protected $fileIds;

    /**
     * @var array
     */
    protected $progress;

    /**
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
    protected $hash;

    /**
     * @var string
     */
    protected $translationUrl;

    /**
     * @var integer
     */
    protected $wordsCount;

    /**
     * @var integer
     */
    protected $filesCount;

    /**
     * @var integer
     */
    protected $commentsCount;

    /**
     * @var string
     */
    protected $deadline;

    /**
     * @var string
     */
    protected $timeRange;

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
     * @var bool
     */
    protected $isArchived;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (integer)$this->getDataProperty('id');
        $this->projectId = (integer)$this->getDataProperty('projectId');
        $this->creatorId = (integer)$this->getDataProperty('creatorId');
        $this->type = (string)$this->getDataProperty('type');
        $this->vendor = $this->getDataProperty('vendor') ? (string)$this->getDataProperty('vendor') : null;
        $this->status = (string)$this->getDataProperty('status');
        $this->title = (string)$this->getDataProperty('title');
        $this->assignees = (array)$this->getDataProperty('assignees');
        $this->assignedTeams = (array)$this->getDataProperty('assignedTeams');
        $this->fileIds = (array)$this->getDataProperty('fileIds');
        $this->progress = (array)$this->getDataProperty('progress');
        $this->translateProgress = $this->getDataProperty('translateProgress') ? (array)$this->getDataProperty('translateProgress') : null;
        $this->sourceLanguageId = (string)$this->getDataProperty('sourceLanguageId');
        $this->targetLanguageId = (string)$this->getDataProperty('targetLanguageId');
        $this->description = (string)$this->getDataProperty('description');
        $this->hash = (string)$this->getDataProperty('hash');
        $this->translationUrl = (string)$this->getDataProperty('translationUrl');
        $this->wordsCount = (integer)$this->getDataProperty('wordsCount');
        $this->filesCount = (integer)$this->getDataProperty('filesCount');
        $this->commentsCount = (integer)$this->getDataProperty('commentsCount');
        $this->deadline = (string)$this->getDataProperty('deadline');
        $this->timeRange = (string)$this->getDataProperty('timeRange');
        $this->workflowStepId = (integer)$this->getDataProperty('workflowStepId');
        $this->buyUrl = $this->getDataProperty('buyUrl') ? (string)$this->getDataProperty('buyUrl') : null;
        $this->createdAt = (string)$this->getDataProperty('createdAt');
        $this->updatedAt = (string)$this->getDataProperty('updatedAt');
        $this->isArchived = (bool)$this->getDataProperty('isArchived');
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

    public function getVendor(): ?string
    {
        return $this->vendor;
    }

    public function setVendor(string $vendor): void
    {
        $this->vendor = $vendor;
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
    public function getHash(): string
    {
        return $this->hash;
    }

    /**
     * @return string
     */
    public function getTranslationUrl(): string
    {
        return $this->translationUrl;
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
    public function getFilesCount(): int
    {
        return $this->filesCount;
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

    /**
     * @return string
     */
    public function getTimeRange(): string
    {
        return $this->timeRange;
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

    public function setBuyUrl(string $buyUrl): void
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

    /**
     * @return bool
     */
    public function isArchived(): ?bool
    {
        return $this->isArchived;
    }

    /**
     * @param bool $isArchived
     */
    public function setIsArchived(?bool $isArchived): void
    {
        $this->isArchived = $isArchived;
    }
}
