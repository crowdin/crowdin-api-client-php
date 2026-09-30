<?php

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class Label extends BaseModel
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
    protected $title;

    /**
     * @var bool|null
     */
    protected $isShared;

    /**
     * @var bool|null
     */
    protected $isSystem;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (int)$this->getDataProperty('id');
        $this->projectId = (int)$this->getDataProperty('projectId');
        $this->title = (string)$this->getDataProperty('title');
        $this->isShared = $this->nullableBool('isShared');
        $this->isSystem = $this->nullableBool('isSystem');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getProjectId(): int
    {
        return $this->projectId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function isShared(): ?bool
    {
        return $this->isShared;
    }

    public function isSystem(): ?bool
    {
        return $this->isSystem;
    }
}
