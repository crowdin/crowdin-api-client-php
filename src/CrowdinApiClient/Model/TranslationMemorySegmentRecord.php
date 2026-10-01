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
     * @var string|null
     */
    protected $createdAt;

    /**
     * @var string|null
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
        $this->createdAt = $this->nullableString('createdAt');
        $this->updatedAt = $this->nullableString('updatedAt');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getLanguageId(): string
    {
        return $this->languageId;
    }

    public function setLanguageId(string $languageId): void
    {
        $this->languageId = $languageId;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function getUsageCount(): int
    {
        return $this->usageCount;
    }

    public function setUsageCount(int $usageCount): void
    {
        $this->usageCount = $usageCount;
    }

    public function getCreatedBy(): int
    {
        return $this->createdBy;
    }

    public function setCreatedBy(int $createdBy): void
    {
        $this->createdBy = $createdBy;
    }

    public function getUpdatedBy(): int
    {
        return $this->updatedBy;
    }

    public function setUpdatedBy(int $updatedBy): void
    {
        $this->updatedBy = $updatedBy;
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?string $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}
