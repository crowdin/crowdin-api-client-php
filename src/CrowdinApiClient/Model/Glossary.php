<?php

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class Glossary extends BaseModel
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
     * @var integer
     */
    protected $groupId;

    /**
     * @var integer
     */
    protected $userId;

    /**
     * @var integer
     */
    protected $terms;

    /**
     * @var string
     */
    protected $languageId;

    /**
     * @var string[]
     */
    protected $languageIds;

    /**
     * @var int[]
     */
    protected $defaultProjectIds;

    /**
     * @var int[]
     */
    protected $projectIds;

    /**
     * @var string
     */
    protected $webUrl;

    /**
     * @var string
     */
    protected $createdAt;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (int)$this->getDataProperty('id');
        $this->name = (string)$this->getDataProperty('name');
        $this->groupId = (int)$this->getDataProperty('groupId');
        $this->userId = (int)$this->getDataProperty('userId');
        $this->terms = (int)$this->getDataProperty('terms');
        $this->languageId = (string)$this->getDataProperty('languageId');
        $this->languageIds = (array)$this->getDataProperty('languageIds');
        $this->defaultProjectIds = (array)$this->getDataProperty('defaultProjectIds');
        $this->projectIds = (array)$this->getDataProperty('projectIds');
        $this->webUrl = (string)$this->getDataProperty('webUrl');
        $this->createdAt = (string)$this->getDataProperty('createdAt');
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

    public function getGroupId(): int
    {
        return $this->groupId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getTerms(): int
    {
        return $this->terms;
    }

    public function getLanguageId(): string
    {
        return $this->languageId;
    }

    /**
     * @return string[]
     */
    public function getLanguageIds(): array
    {
        return $this->languageIds;
    }

    /**
     * @return int[]
     */
    public function getDefaultProjectIds(): array
    {
        return $this->defaultProjectIds;
    }

    /**
     * @return int[]
     */
    public function getProjectIds(): array
    {
        return $this->projectIds;
    }

    public function getWebUrl(): string
    {
        return $this->webUrl;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
}
