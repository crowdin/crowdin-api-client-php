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
     * @var int
     */
    protected $parserVersion;

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
        $this->status = (string)$this->getDataProperty('status');
        $this->revisionId = (integer)$this->getDataProperty('revisionId');
        $this->priority = (string)$this->getDataProperty('priority');
        $this->importOptions = (array)$this->getDataProperty('importOptions');
        $this->exportOptions = (array)$this->getDataProperty('exportOptions');
        $this->excludedTargetLanguages = $this->getDataProperty('excludedTargetLanguages') ? (array)$this->getDataProperty('excludedTargetLanguages') : null;
        $this->parserVersion = (int)$this->getDataProperty('parserVersion');
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

    public function getBranchId(): int
    {
        return $this->branchId;
    }

    public function setBranchId(int $branchId): void
    {
        $this->branchId = $branchId;
    }

    public function getDirectoryId(): int
    {
        return $this->directoryId;
    }

    public function setDirectoryId(int $directoryId): void
    {
        $this->directoryId = $directoryId;
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

    public function getContext(): string
    {
        return $this->context;
    }

    public function setContext(string $context): void
    {
        $this->context = $context;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    public function getRevisionId(): int
    {
        return $this->revisionId;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getPriority(): string
    {
        return $this->priority;
    }

    public function setPriority(string $priority): void
    {
        $this->priority = $priority;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function getImportOptions(): array
    {
        return $this->importOptions;
    }

    public function setImportOptions(array $importOptions): void
    {
        $this->importOptions = $importOptions;
    }

    public function getExportOptions(): array
    {
        return $this->exportOptions;
    }

    public function setExportOptions(array $exportOptions): void
    {
        $this->exportOptions = $exportOptions;
    }

    /**
     * @return string[]|null
     */
    public function getExcludedTargetLanguages(): ?array
    {
        return $this->excludedTargetLanguages;
    }

    /**
     * @param string[]|null $excludedTargetLanguages
     */
    public function setExcludedTargetLanguages(?array $excludedTargetLanguages): void
    {
        $this->excludedTargetLanguages = $excludedTargetLanguages;
    }

    public function getParserVersion(): int
    {
        return $this->parserVersion;
    }
}
