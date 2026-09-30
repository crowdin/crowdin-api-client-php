<?php

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class TranslationProjectBuild extends BaseModel
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
     * @var string
     */
    protected $status;

    /**
     * @var integer
     */
    protected $progress;

    /**
     * @var array
     */
    protected $attributes;

    /**
     * @var string|null
     */
    protected $createdAt;

    /**
     * @var array
     */
    protected $error;

    /**
     * @var string|null
     */
    protected $finishedAt;

    /**
     * @var string|null
     */
    protected $updatedAt;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (int)$this->getDataProperty('id');
        $this->projectId = (int)$this->getDataProperty('projectId');
        $this->status = (string)$this->getDataProperty('status');
        $this->progress = (int)$this->getDataProperty('progress');
        $this->attributes = (array)$this->getDataProperty('attributes');
        $this->createdAt = $this->nullableString('createdAt');
        $this->error = (array)$this->getDataProperty('error');
        $this->finishedAt = $this->nullableString('finishedAt');
        $this->updatedAt = $this->nullableString('updatedAt');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getProjectId(): int
    {
        return $this->projectId;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getProgress(): int
    {
        return $this->progress;
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    public function getError(): array
    {
        return $this->error;
    }

    public function getFinishedAt(): ?string
    {
        return $this->finishedAt;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }
}
