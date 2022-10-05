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
     * @var string[]
     */
    protected $labelIds;

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
        $this->labelIds = (array)$this->getDataProperty('labelIds');
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
    public function getFormat(): string
    {
        return $this->format;
    }

    /**
     * @param string $format
     */
    public function setFormat(string $format): void
    {
        $this->format = $format;
    }

    /**
     * @return array|string[]
     */
    public function getSourcePatterns(): array
    {
        return $this->sourcePatterns;
    }

    /**
     * @param array|string[] $sourcePatterns
     */
    public function setSourcePatterns(array $sourcePatterns): void
    {
        $this->sourcePatterns = $sourcePatterns;
    }

    /**
     * @return array|string[]
     */
    public function getIgnorePatterns(): array
    {
        return $this->ignorePatterns;
    }

    /**
     * @param array|string[] $ignorePatterns
     */
    public function setIgnorePatterns(array $ignorePatterns): void
    {
        $this->ignorePatterns = $ignorePatterns;
    }

    /**
     * @return string
     */
    public function getExportPattern(): string
    {
        return $this->exportPattern;
    }

    /**
     * @param string $exportPattern
     */
    public function setExportPattern(string $exportPattern): void
    {
        $this->exportPattern = $exportPattern;
    }

    /**
     * @return array|string[]
     */
    public function getLabelIds(): array
    {
        return $this->labelIds;
    }

    /**
     * @param array|string[] $labelIds
     */
    public function setLabelIds(array $labelIds): void
    {
        $this->labelIds = $labelIds;
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
