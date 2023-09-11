<?php

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class BundleExport extends BaseModel
{
    /**
     * @var string
     */
    protected $identifier;

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
     * @var string
     */
    protected $createdAt;

    /**
     * @var string
     */
    protected $updatedAt;

    /**
     * @var string
     */
    protected $startedAt;

    /**
     * @var string
     */
    protected $finishedAt;

    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->identifier = (string)$this->getDataProperty('identifier');
        $this->status = (string)$this->getDataProperty('status');
        $this->progress = (integer)$this->getDataProperty('progress');
        $this->attributes = (array)$this->getDataProperty('attributes');
        $this->createdAt = (string)$this->getDataProperty('createdAt');
        $this->updatedAt = (string)$this->getDataProperty('updatedAt');
        $this->startedAt = (string)$this->getDataProperty('startedAt');
        $this->finishedAt = (string)$this->getDataProperty('finishedAt');
    }

    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    public function setIdentifier(string $identifier): void
    {
        $this->identifier = $identifier;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getProgress(): int
    {
        return $this->progress;
    }

    public function setProgress(int $progress): void
    {
        $this->progress = $progress;
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function setAttributes(array $attributes): void
    {
        $this->attributes = $attributes;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(string $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getStartedAt(): string
    {
        return $this->startedAt;
    }

    public function setStartedAt(string $startedAt): void
    {
        $this->startedAt = $startedAt;
    }

    public function getFinishedAt(): string
    {
        return $this->finishedAt;
    }

    public function setFinishedAt(string $finishedAt): void
    {
        $this->finishedAt = $finishedAt;
    }
}
