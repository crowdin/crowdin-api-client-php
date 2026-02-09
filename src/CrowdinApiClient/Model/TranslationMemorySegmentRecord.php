<?php

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class TranslationMemorySegmentRecord extends BaseModel
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $languageId;

    /**
     * @var string
     */
    protected $text;

    /**
     * @var integer
     */
    protected $usageCount;

    /**
     * @var integer
     */
    protected $createdBy;

    /**
     * @var integer
     */
    protected $updatedBy;

    /**
     * @var ?string
     */
    protected $createdAt;

    /**
     * @var ?string
     */
    protected $updatedAt;

    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->id = (int)$this->getDataProperty('id');
        $this->languageId = (string)$this->getDataProperty('languageId');
        $this->text = (string)$this->getDataProperty('text');
        $this->usageCount = (int)$this->getDataProperty('usageCount');
        $this->createdBy = (int)$this->getDataProperty('createdBy');
        $this->updatedBy = (int)$this->getDataProperty('updatedBy');
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
     * @return string
     */
    public function getLanguageId(): string
    {
        return $this->languageId;
    }

    /**
     * @param string $languageId
     */
    public function setLanguageId(string $languageId): void
    {
        $this->languageId = $languageId;
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
     * @return int
     */
    public function getUsageCount(): int
    {
        return $this->usageCount;
    }

    /**
     * @param int $usageCount
     */
    public function setUsageCount(int $usageCount): void
    {
        $this->usageCount = $usageCount;
    }

    /**
     * @return int
     */
    public function getCreatedBy(): int
    {
        return $this->createdBy;
    }

    /**
     * @param int $createdBy
     */
    public function setCreatedBy(int $createdBy): void
    {
        $this->createdBy = $createdBy;
    }

    /**
     * @return int
     */
    public function getUpdatedBy(): int
    {
        return $this->updatedBy;
    }

    /**
     * @param int $updatedBy
     */
    public function setUpdatedBy(int $updatedBy): void
    {
        $this->updatedBy = $updatedBy;
    }

    /**
     * @return string|null
     */
    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    /**
     * @param string|null $createdAt
     */
    public function setCreatedAt(?string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return string|null
     */
    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }

    /**
     * @param string|null $updatedAt
     */
    public function setUpdatedAt(?string $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}
