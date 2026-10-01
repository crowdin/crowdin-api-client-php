<?php

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class TaskComment extends BaseModel
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var integer
     */
    protected $userId;

    /**
     * @var integer
     */
    protected $taskId;

    /**
     * @var string
     */
    protected $text;

    /**
     * @var integer|null
     */
    protected $timeSpent;

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

        $this->id = (int)$this->getDataProperty('id');
        $this->userId = (int)$this->getDataProperty('userId');
        $this->taskId = (int)$this->getDataProperty('taskId');
        $this->text = (string)$this->getDataProperty('text');
        $this->timeSpent = $this->nullableInt('timeSpent');
        $this->createdAt = (string)$this->getDataProperty('createdAt');
        $this->updatedAt = (string)$this->getDataProperty('updatedAt');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getTaskId(): int
    {
        return $this->taskId;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function getTimeSpent(): ?int
    {
        return $this->timeSpent;
    }

    public function setTimeSpent(?int $timeSpent): void
    {
        $this->timeSpent = $timeSpent;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }
}
