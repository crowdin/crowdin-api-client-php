<?php

namespace CrowdinApiClient\Model;

/**
 * Class SourceString
 * @package Crowdin\Model
 */
class SourceString extends BaseModel
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
    protected $fileId;

    /**
     * @var string
     */
    protected $identifier;

    /**
     * @var string
     */
    protected $text;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $context;

    /**
     * @var integer
     */
    protected $maxLength;

    /**
     * @var bool
     */
    protected $isHidden;

    /**
     * @var integer
     */
    protected $revision;

    /**
     * @var bool
     */
    protected $hasPlurals;

    /**
     * @var array
     */
    protected $plurals;

    /**
     * @var bool
     */
    protected $isIcu;

    /**
     * @var string
     */
    protected $createdAt;

    /**
     * @var string
     */
    protected $updatedAt;

    /**
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (integer)$this->getDataProperty('id');
        $this->projectId = (integer)$this->getDataProperty('projectId');
        $this->fileId = (integer)$this->getDataProperty('fileId');
        $this->identifier = (string)$this->getDataProperty('identifier');
        $this->text = (string)$this->getDataProperty('text');
        $this->type = (string)$this->getDataProperty('type');
        $this->context = (string)$this->getDataProperty('context');
        $this->maxLength = (integer)$this->getDataProperty('maxLength');
        $this->isHidden = (bool)$this->getDataProperty('isHidden');
        $this->revision = (integer)$this->getDataProperty('revision');
        $this->hasPlurals = (bool)$this->getDataProperty('hasPlurals');
        $this->plurals = (array)$this->getDataProperty('plurals');
        $this->isIcu = (bool)$this->getDataProperty('isIcu');
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
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getProjectId(): int
    {
        return $this->projectId;
    }

    /**
     * @param int $projectId
     */
    public function setProjectId(int $projectId): void
    {
        $this->projectId = $projectId;
    }

    /**
     * @return int
     */
    public function getFileId(): int
    {
        return $this->fileId;
    }

    /**
     * @param int $fileId
     */
    public function setFileId(int $fileId): void
    {
        $this->fileId = $fileId;
    }

    /**
     * @return string
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    /**
     * @param string $identifier
     */
    public function setIdentifier(string $identifier): void
    {
        $this->identifier = $identifier;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
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
     * @return int
     */
    public function getMaxLength(): int
    {
        return $this->maxLength;
    }

    /**
     * @param int $maxLength
     */
    public function setMaxLength(int $maxLength): void
    {
        $this->maxLength = $maxLength;
    }

    /**
     * @return bool
     */
    public function isHidden(): bool
    {
        return $this->isHidden;
    }

    /**
     * @param bool $isHidden
     */
    public function setIsHidden(bool $isHidden): void
    {
        $this->isHidden = $isHidden;
    }

    /**
     * @return int
     */
    public function getRevision(): int
    {
        return $this->revision;
    }

    /**
     * @param int $revision
     */
    public function setRevision(int $revision): void
    {
        $this->revision = $revision;
    }

    /**
     * @return bool
     */
    public function isHasPlurals(): bool
    {
        return $this->hasPlurals;
    }

    /**
     * @param bool $hasPlurals
     */
    public function setHasPlurals(bool $hasPlurals): void
    {
        $this->hasPlurals = $hasPlurals;
    }

    /**
     * @return array
     */
    public function getPlurals(): array
    {
        return $this->plurals;
    }

    /**
     * @param array $plurals
     */
    public function setPlurals(array $plurals): void
    {
        $this->plurals = $plurals;
    }

    /**
     * @return bool
     */
    public function isIcu(): bool
    {
        return $this->isIcu;
    }

    /**
     * @param bool $isIcu
     */
    public function setIsIcu(bool $isIcu): void
    {
        $this->isIcu = $isIcu;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @param string $createdAt
     */
    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    /**
     * @param string $updatedAt
     */
    public function setUpdatedAt(string $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}
