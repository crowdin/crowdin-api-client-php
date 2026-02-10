<?php

namespace CrowdinApiClient\Model;

use InvalidArgumentException;

/**
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
     * @var ?integer
     */
    protected $branchId;

    /**
     * @var ?integer
     */
    protected $directoryId;

    /**
     * @var string
     */
    protected $identifier;

    /**
     * @var string|array
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
     * @var bool
     */
    protected $isIcu;

    /**
     * @var array
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

    /**
     * @var bool
     */
    protected $isDuplicate = false;

    /**
     * @var ?integer
     */
    protected $masterStringId;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (int)$this->getDataProperty('id');
        $this->projectId = (int)$this->getDataProperty('projectId');
        $this->fileId = (int)$this->getDataProperty('fileId');
        $this->branchId = $this->getDataProperty('branchId')
            ? (int)$this->getDataProperty('branchId')
            : null;
        $this->directoryId = $this->getDataProperty('directoryId')
            ? (int)$this->getDataProperty('directoryId')
            : null;
        $this->identifier = (string)$this->getDataProperty('identifier');
        $this->text = is_array($this->getDataProperty('text'))
            ? $this->getDataProperty('text')
            : (string)$this->getDataProperty('text');
        $this->type = (string)$this->getDataProperty('type');
        $this->context = (string)$this->getDataProperty('context');
        $this->maxLength = (int)$this->getDataProperty('maxLength');
        $this->isHidden = (bool)$this->getDataProperty('isHidden');
        $this->revision = (int)$this->getDataProperty('revision');
        $this->hasPlurals = (bool)$this->getDataProperty('hasPlurals');
        $this->isIcu = (bool)$this->getDataProperty('isIcu');
        $this->labelIds = (array)$this->getDataProperty('labelIds');
        $this->createdAt = (string)$this->getDataProperty('createdAt');
        $this->updatedAt = (string)$this->getDataProperty('updatedAt');
        $this->isDuplicate = (bool)$this->getDataProperty('isDuplicate');
        $this->masterStringId = $this->getDataProperty('masterStringId');
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
    public function getFileId(): int
    {
        return $this->fileId;
    }

    /**
     * @return int|null
     */
    public function getBranchId(): ?int
    {
        return $this->branchId;
    }

    /**
     * @return int|null
     */
    public function getDirectoryId(): ?int
    {
        return $this->directoryId;
    }

    /**
     * @return string
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    /**
     * @return string|array
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string|array $text
     */
    public function setText($text): void
    {
        if (gettype($this->text) !== gettype($text)) {
            throw new InvalidArgumentException(
                sprintf(
                    'Argument "text" must have the same type as the current value. Current value type: %s',
                    gettype($this->text)
                )
            );
        }

        if (
            is_array($text) &&
            (array_diff_key($this->text, $text) !== [] || array_diff_key($text, $this->text) !== [])
        ) {
            throw new InvalidArgumentException('Argument "text" must have the same keys as the current value');
        }

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
     * @return bool
     */
    public function isHasPlurals(): bool
    {
        return $this->hasPlurals;
    }

    /**
     * Alias of isHasPlurals
     * @return bool
     */
    public function isPlural(): bool
    {
        return $this->hasPlurals;
    }

    /**
     * @return bool
     */
    public function isIcu(): bool
    {
        return $this->isIcu;
    }

    /**
     * @return array
     */
    public function getLabelIds(): array
    {
        return $this->labelIds;
    }

    /**
     * @param array $labelIds
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

    /**
     * @return bool
     */
    public function isDuplicate(): bool
    {
        return $this->isDuplicate;
    }

    /**
     * @return int|null
     */
    public function getMasterStringId(): ?int
    {
        return $this->masterStringId;
    }
}
