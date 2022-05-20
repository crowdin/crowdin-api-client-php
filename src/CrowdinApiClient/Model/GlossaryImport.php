<?php

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class GlossaryImport extends BaseModel
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

    /**
     * @return string
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return int
     */
    public function getProgress(): int
    {
        return $this->progress;
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
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
     * @return string
     */
    public function getStartedAt(): string
    {
        return $this->startedAt;
    }

    /**
     * @return string
     */
    public function getFinishedAt(): string
    {
        return $this->finishedAt;
    }
}
