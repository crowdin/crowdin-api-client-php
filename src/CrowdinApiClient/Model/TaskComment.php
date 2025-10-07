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

        $this->id = (integer)$this->getDataProperty('id');
        $this->userId = (integer)$this->getDataProperty('userId');
        $this->taskId = (integer)$this->getDataProperty('taskId');
        $this->text = (string)$this->getDataProperty('text');
        $this->timeSpent = $this->getDataProperty('timeSpent') ? (integer)$this->getDataProperty('timeSpent') : null;
        $this->createdAt = (string)$this->getDataProperty('createdAt');
        $this->updatedAt = (string)$this->getDataProperty('updatedAt');
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
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return int
     */
    public function getTaskId(): int
    {
        return $this->taskId;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    /**
     * @return int|null
     */
    public function getTimeSpent(): ?int
    {
        return $this->timeSpent;
    }

    /**
     * @param int|null $timeSpent
     */
    public function setTimeSpent(?int $timeSpent): void
    {
        $this->timeSpent = $timeSpent;
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
}
