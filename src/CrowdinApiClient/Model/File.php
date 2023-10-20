<?php

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class File extends BaseModel
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
    protected $branchId;

    /**
     * @var integer
     */
    protected $directoryId;

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
    protected $context;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $path;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var integer
     */
    protected $revisionId;

    /**
     * @var string
     */
    protected $priority;

    /**
     * @var array
     */
    protected $importOptions = [];

    /**
     * @var array
     */
    protected $exportOptions = [];

    /**
     * @var null|array
     */
    protected $excludedTargetLanguages;

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
        $this->projectId = (integer)$this->getDataProperty('projectId');
        $this->branchId = (integer)$this->getDataProperty('branchId');
        $this->directoryId = (integer)$this->getDataProperty('directoryId');
        $this->name = (string)$this->getDataProperty('name');
        $this->title = (string)$this->getDataProperty('title');
        $this->context = (string)$this->getDataProperty('context');
        $this->type = (string)$this->getDataProperty('type');
        $this->path = (string)$this->getDataProperty('path');
        $this->revisionId = (integer)$this->getDataProperty('revisionId');
        $this->status = (string)$this->getDataProperty('status');
        $this->priority = (string)$this->getDataProperty('priority');
        $this->createdAt = (string)$this->getDataProperty('createdAt');
        $this->updatedAt = (string)$this->getDataProperty('updatedAt');
        $this->importOptions = (array)$this->getDataProperty('importOptions');
        $this->exportOptions = (array)$this->getDataProperty('exportOptions');
        $this->excludedTargetLanguages = $this->getDataProperty('excludedTargetLanguages') ? (array)$this->getDataProperty('excludedTargetLanguages') : null;
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
    public function getBranchId(): int
    {
        return $this->branchId;
    }

    /**
     * @param int $branchId
     */
    public function setBranchId(int $branchId): void
    {
        $this->branchId = $branchId;
    }

    /**
     * @return int
     */
    public function getDirectoryId(): int
    {
        return $this->directoryId;
    }

    /**
     * @param int $directoryId
     */
    public function setDirectoryId(int $directoryId): void
    {
        $this->directoryId = $directoryId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
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
     * @return string
     */
    public function getContext(): string
    {
        return $this->context;
    }

    /**
     * @param string $context
     */
    public function setContext(string $context): void
    {
        $this->context = $context;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    /**
     * @return int
     */
    public function getRevisionId(): int
    {
        return $this->revisionId;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getPriority(): string
    {
        return $this->priority;
    }

    /**
     * @param string $priority
     */
    public function setPriority(string $priority): void
    {
        $this->priority = $priority;
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
     * @return array
     */
    public function getImportOptions(): array
    {
        return $this->importOptions;
    }

    /**
     * @param array $importOptions
     */
    public function setImportOptions(array $importOptions): void
    {
        $this->importOptions = $importOptions;
    }

    /**
     * @return array
     */
    public function getExportOptions(): array
    {
        return $this->exportOptions;
    }

    /**
     * @param array $exportOptions
     */
    public function setExportOptions(array $exportOptions): void
    {
        $this->exportOptions = $exportOptions;
    }

    /**
     * @return array|null
     */
    public function getExcludedTargetLanguages(): ?array
    {
        return $this->excludedTargetLanguages;
    }

    /**
     * @param array|null $excludedTargetLanguages
     */
    public function setExcludedTargetLanguages(?array $excludedTargetLanguages): void
    {
        $this->excludedTargetLanguages = $excludedTargetLanguages;
    }
}
