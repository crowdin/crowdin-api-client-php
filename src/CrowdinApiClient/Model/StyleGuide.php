<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

class StyleGuide extends BaseModel
{
    /** @var int */
    protected $id;

    /** @var string */
    protected $name;

    /** @var string|null */
    protected $aiInstructions = null;

    /** @var int */
    protected $userId;

    /** @var string[]|null */
    protected $languageIds = null;

    /** @var int[]|null */
    protected $projectIds = null;

    /** @var bool */
    protected $isShared;

    /** @var string */
    protected $webUrl;

    /** @var string */
    protected $downloadLink;

    /** @var string */
    protected $createdAt;

    /** @var string */
    protected $updatedAt;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (int)$this->getDataProperty('id');
        $this->name = (string)$this->getDataProperty('name');
        $this->aiInstructions = $this->getDataProperty('aiInstructions');
        $this->userId = (int)$this->getDataProperty('userId');
        $this->languageIds = $this->getDataProperty('languageIds');
        $this->projectIds = $this->getDataProperty('projectIds');
        $this->isShared = (bool)$this->getDataProperty('isShared');
        $this->webUrl = (string)$this->getDataProperty('webUrl');
        $this->downloadLink = (string)$this->getDataProperty('downloadLink');
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

    public function getAiInstructions(): ?string
    {
        return $this->aiInstructions;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return string[]|null
     */
    public function getLanguageIds(): ?array
    {
        return $this->languageIds;
    }

    /**
     * @return int[]|null
     */
    public function getProjectIds(): ?array
    {
        return $this->projectIds;
    }

    public function isShared(): bool
    {
        return $this->isShared;
    }

    public function getWebUrl(): string
    {
        return $this->webUrl;
    }

    public function getDownloadLink(): ?string
    {
        return $this->downloadLink;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setAiInstructions(?string $aiInstructions): void
    {
        $this->aiInstructions = $aiInstructions;
    }

    public function setLanguageIds(?array $languageIds): void
    {
        $this->languageIds = $languageIds;
    }

    public function setProjectIds(?array $projectIds): void
    {
        $this->projectIds = $projectIds;
    }

    public function setIsShared(bool $isShared): void
    {
        $this->isShared = $isShared;
    }
}
