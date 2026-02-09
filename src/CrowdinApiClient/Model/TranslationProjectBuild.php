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

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (int)$this->getDataProperty('id');
        $this->projectId = (int)$this->getDataProperty('projectId');
        $this->status = (string)$this->getDataProperty('status');
        $this->progress = (int)$this->getDataProperty('progress');
        $this->attributes = (array)$this->getDataProperty('attributes');
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
}
