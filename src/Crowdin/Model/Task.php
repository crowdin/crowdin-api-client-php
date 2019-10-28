<?php


namespace Crowdin\Model;

/**
 * Class Task
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
     * @var integer
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
    protected $fileIds;

    /**
     * @var array
     */
    protected $progress;

    /**
     * @var integer
     */
    protected $sourceLanguageId;

    /**
     * @var integer
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
     * @var string
     */
    protected $createdAt;

    /**
     * @var string
     */
    protected $updatedAt;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = $this->getDataProperty('id');
        $this->projectId = $this->getDataProperty('projectId');
        $this->creatorId = $this->getDataProperty('creatorId');
        $this->type = $this->getDataProperty('type');
        $this->status = $this->getDataProperty('status');
        $this->title = $this->getDataProperty('title');
        $this->assignees = $this->getDataProperty('assignees');
        $this->fileIds = $this->getDataProperty('fileIds');
        $this->progress = $this->getDataProperty('progress');
        $this->sourceLanguageId = $this->getDataProperty('sourceLanguageId');
        $this->targetLanguageId = $this->getDataProperty('targetLanguageId');
        $this->description = $this->getDataProperty('description');
        $this->hash = $this->getDataProperty('hash');
        $this->translationUrl = $this->getDataProperty('translationUrl');
        $this->wordsCount = $this->getDataProperty('wordsCount');
        $this->filesCount = $this->getDataProperty('filesCount');
        $this->commentsCount = $this->getDataProperty('commentsCount');
        $this->deadline = $this->getDataProperty('deadline');
        $this->timeRange = $this->getDataProperty('timeRange');
        $this->workflowStepId = $this->getDataProperty('workflowStepId');
        $this->createdAt = $this->getDataProperty('createdAt');
        $this->updatedAt = $this->getDataProperty('updatedAt');
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getProjectId(): int
    {
        return $this->projectId;
    }

    /**
     * @param int $projectId
     */
    public function setProjectId(int $projectId): void
    {
        $this->projectId = $projectId;
    }

    /**
     * @return int
     */
    public function getCreatorId(): int
    {
        return $this->creatorId;
    }

    /**
     * @param int $creatorId
     */
    public function setCreatorId(int $creatorId): void
    {
        $this->creatorId = $creatorId;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @param int $type
     */
    public function setType(int $type): void
    {
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
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
     * @param array $progress
     */
    public function setProgress(array $progress): void
    {
        $this->progress = $progress;
    }

    /**
     * @return int
     */
    public function getSourceLanguageId(): int
    {
        return $this->sourceLanguageId;
    }

    /**
     * @param int $sourceLanguageId
     */
    public function setSourceLanguageId(int $sourceLanguageId): void
    {
        $this->sourceLanguageId = $sourceLanguageId;
    }

    /**
     * @return int
     */
    public function getTargetLanguageId(): int
    {
        return $this->targetLanguageId;
    }

    /**
     * @param int $targetLanguageId
     */
    public function setTargetLanguageId(int $targetLanguageId): void
    {
        $this->targetLanguageId = $targetLanguageId;
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
     * @param string $hash
     */
    public function setHash(string $hash): void
    {
        $this->hash = $hash;
    }

    /**
     * @return string
     */
    public function getTranslationUrl(): string
    {
        return $this->translationUrl;
    }

    /**
     * @param string $translationUrl
     */
    public function setTranslationUrl(string $translationUrl): void
    {
        $this->translationUrl = $translationUrl;
    }

    /**
     * @return int
     */
    public function getWordsCount(): int
    {
        return $this->wordsCount;
    }

    /**
     * @param int $wordsCount
     */
    public function setWordsCount(int $wordsCount): void
    {
        $this->wordsCount = $wordsCount;
    }

    /**
     * @return int
     */
    public function getFilesCount(): int
    {
        return $this->filesCount;
    }

    /**
     * @param int $filesCount
     */
    public function setFilesCount(int $filesCount): void
    {
        $this->filesCount = $filesCount;
    }

    /**
     * @return int
     */
    public function getCommentsCount(): int
    {
        return $this->commentsCount;
    }

    /**
     * @param int $commentsCount
     */
    public function setCommentsCount(int $commentsCount): void
    {
        $this->commentsCount = $commentsCount;
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
     * @param string $timeRange
     */
    public function setTimeRange(string $timeRange): void
    {
        $this->timeRange = $timeRange;
    }

    /**
     * @return int
     */
    public function getWorkflowStepId(): int
    {
        return $this->workflowStepId;
    }

    /**
     * @param int $workflowStepId
     */
    public function setWorkflowStepId(int $workflowStepId): void
    {
        $this->workflowStepId = $workflowStepId;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @param string $createdAt
     */
    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    /**
     * @param string $updatedAt
     */
    public function setUpdatedAt(string $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

}
