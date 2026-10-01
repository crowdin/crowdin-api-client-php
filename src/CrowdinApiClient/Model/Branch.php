<?php

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class Branch extends BaseModel
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
    protected $name;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $exportPattern;

    /**
     * @var string
     */
    protected $priority;

    /**
     * @var bool
     */
    protected $isProtected;

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
        $this->projectId = (int)$this->getDataProperty('projectId');
        $this->name = (string)$this->getDataProperty('name');
        $this->title = (string)$this->getDataProperty('title');
        $this->exportPattern = (string)$this->getDataProperty('exportPattern');
        $this->priority = (string)$this->getDataProperty('priority');
        $this->isProtected = (bool)$this->getDataProperty('isProtected');
        $this->createdAt = (string)$this->getDataProperty('createdAt');
        $this->updatedAt = (string)$this->getDataProperty('updatedAt');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getProjectId(): int
    {
        return $this->projectId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getExportPattern(): string
    {
        return $this->exportPattern;
    }

    public function setExportPattern(string $exportPattern): void
    {
        $this->exportPattern = $exportPattern;
    }

    public function getPriority(): string
    {
        return $this->priority;
    }

    public function setPriority(string $priority): void
    {
        $this->priority = $priority;
    }

    public function isProtected(): bool
    {
        return $this->isProtected;
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
