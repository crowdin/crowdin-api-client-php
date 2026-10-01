<?php

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class TranslationMemory extends BaseModel
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var integer
     */
    protected $groupId;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var array
     */
    protected $languageIds;

    /**
     * @var integer
     */
    protected $segmentsCount;

    /**
     * @var array
     */
    protected $defaultProjectIds;

    /**
     * @var array
     */
    protected $projectIds;

    /**
     * @var string
     */
    protected $createdAt;

    /**
     * @var bool
     */
    protected $isShared;

    /**
     * @var string|null
     */
    protected $languageId;

    /**
     * @var int|null
     */
    protected $userId;

    /**
     * @var string
     */
    protected $webUrl;

    /**
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = $this->getDataProperty('id');
        $this->groupId = $this->getDataProperty('groupId');
        $this->name = $this->getDataProperty('name');
        $this->languageIds = $this->getDataProperty('languageIds');
        $this->segmentsCount = $this->getDataProperty('segmentsCount');
        $this->defaultProjectIds = $this->getDataProperty('defaultProjectIds');
        $this->projectIds = $this->getDataProperty('projectIds');
        $this->createdAt = $this->getDataProperty('createdAt');
        $this->isShared = (bool)$this->getDataProperty('isShared');
        $this->languageId = $this->nullableString('languageId');
        $this->userId = $this->nullableInt('userId');
        $this->webUrl = (string)$this->getDataProperty('webUrl');
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
    public function getGroupId(): int
    {
        return $this->groupId;
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
     * @return array
     */
    public function getLanguageIds(): array
    {
        return $this->languageIds;
    }

    /**
     * @return int
     */
    public function getSegmentsCount(): int
    {
        return $this->segmentsCount;
    }

    /**
     * @return array
     */
    public function getDefaultProjectIds(): array
    {
        return $this->defaultProjectIds;
    }

    /**
     * @return array
     */
    public function getProjectIds(): array
    {
        return $this->projectIds;
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

    public function isShared(): bool
    {
        return $this->isShared;
    }

    public function setIsShared(bool $isShared): void
    {
        $this->isShared = $isShared;
    }

    public function getLanguageId(): ?string
    {
        return $this->languageId;
    }

    public function setLanguageId(string $languageId): void
    {
        $this->languageId = $languageId;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function getWebUrl(): string
    {
        return $this->webUrl;
    }
}
