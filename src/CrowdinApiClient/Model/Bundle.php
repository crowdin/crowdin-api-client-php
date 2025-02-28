<?php

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class Bundle extends BaseModel
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $format;

    /**
     * @var string[]
     */
    protected $sourcePatterns;

    /**
     * @var string[]
     */
    protected $ignorePatterns;

    /**
     * @var string
     */
    protected $exportPattern;

    /**
     * @var bool
     */
    protected $isMultilingual;

    /**
     * @var bool
     */
    protected $includeProjectSourceLanguage;

    /**
     * @var bool
     */
    protected $includeInContextPseudoLanguage;

    /**
     * @var int[]
     */
    protected $labelIds;

    /**
     * @var int[]
     */
    protected $excludeLabelIds;

    /**
     * @var string
     */
    protected $webUrl;

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
        $this->name = (string)$this->getDataProperty('name');
        $this->format = (string)$this->getDataProperty('format');
        $this->sourcePatterns = (array)$this->getDataProperty('sourcePatterns');
        $this->ignorePatterns = (array)$this->getDataProperty('ignorePatterns');
        $this->exportPattern = (string)$this->getDataProperty('exportPattern');
        $this->isMultilingual = (bool)$this->getDataProperty('isMultilingual');
        $this->includeProjectSourceLanguage = (bool)$this->getDataProperty('includeProjectSourceLanguage');
        $this->includeInContextPseudoLanguage = (bool)$this->getDataProperty('includeInContextPseudoLanguage');
        $this->labelIds = (array)$this->getDataProperty('labelIds');
        $this->excludeLabelIds = (array)$this->getDataProperty('excludeLabelIds');
        $this->webUrl = (string)$this->getDataProperty('webUrl');
        $this->createdAt = (string)$this->getDataProperty('createdAt');
        $this->updatedAt = (string)$this->getDataProperty('updatedAt');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getFormat(): string
    {
        return $this->format;
    }

    public function setFormat(string $format): void
    {
        $this->format = $format;
    }

    /**
     * @return string[]
     */
    public function getSourcePatterns(): array
    {
        return $this->sourcePatterns;
    }

    /**
     * @param string[] $sourcePatterns
     */
    public function setSourcePatterns(array $sourcePatterns): void
    {
        $this->sourcePatterns = $sourcePatterns;
    }

    /**
     * @return string[]
     */
    public function getIgnorePatterns(): array
    {
        return $this->ignorePatterns;
    }

    /**
     * @param string[] $ignorePatterns
     */
    public function setIgnorePatterns(array $ignorePatterns): void
    {
        $this->ignorePatterns = $ignorePatterns;
    }

    public function getExportPattern(): string
    {
        return $this->exportPattern;
    }

    public function setExportPattern(string $exportPattern): void
    {
        $this->exportPattern = $exportPattern;
    }

    public function getIsMultilingual(): bool
    {
        return $this->isMultilingual;
    }

    public function setIsMultilingual(bool $isMultilingual): void
    {
        $this->isMultilingual = $isMultilingual;
    }

    public function getIncludeProjectSourceLanguage(): bool
    {
        return $this->includeProjectSourceLanguage;
    }

    public function setIncludeProjectSourceLanguage(bool $includeProjectSourceLanguage): void
    {
        $this->includeProjectSourceLanguage = $includeProjectSourceLanguage;
    }

    public function getIncludeInContextPseudoLanguage(): bool
    {
        return $this->includeInContextPseudoLanguage;
    }

    public function setIncludeInContextPseudoLanguage(bool $includeInContextPseudoLanguage): void
    {
        $this->includeInContextPseudoLanguage = $includeInContextPseudoLanguage;
    }

    /**
     * @return int[]
     */
    public function getLabelIds(): array
    {
        return $this->labelIds;
    }

    /**
     * @param int[] $labelIds
     */
    public function setLabelIds(array $labelIds): void
    {
        $this->labelIds = $labelIds;
    }

    /**
     * @return int[]
     */
    public function getExcludeLabelIds(): array
    {
        return $this->excludeLabelIds;
    }

    /**
     * @param int[] $excludeLabelIds
     */
    public function setExcludeLabelIds(array $excludeLabelIds): void
    {
        $this->excludeLabelIds = $excludeLabelIds;
    }

    public function getWebUrl(): string
    {
        return $this->webUrl;
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
