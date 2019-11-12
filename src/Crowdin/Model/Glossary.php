<?php

namespace Crowdin\Model;

/**
 * Class Glossary
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
     * @var array
     */
    protected $languageIds;

    /**
     * @var array
     */
    protected $projectIds;

    /**
     * @var string
     */
    protected $createdAt;

    /**
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (integer)$this->getDataProperty('id');
        $this->name = (string)$this->getDataProperty('name');
        $this->groupId = (integer)$this->getDataProperty('groupId');
        $this->userId = (integer)$this->getDataProperty('userId');
        $this->terms = (integer)$this->getDataProperty('terms');
        $this->languageIds = (array)$this->getDataProperty('languageIds');
        $this->projectIds = (array)$this->getDataProperty('projectIds');
        $this->createdAt = (string)$this->getDataProperty('createdAt');
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
     * @return int
     */
    public function getGroupId(): int
    {
        return $this->groupId;
    }

    /**
     * @param int $groupId
     */
    public function setGroupId(int $groupId): void
    {
        $this->groupId = $groupId;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return int
     */
    public function getTerms(): int
    {
        return $this->terms;
    }

    /**
     * @param int $terms
     */
    public function setTerms(int $terms): void
    {
        $this->terms = $terms;
    }

    /**
     * @return array
     */
    public function getLanguageIds(): array
    {
        return $this->languageIds;
    }

    /**
     * @param array $languageIds
     */
    public function setLanguageIds(array $languageIds): void
    {
        $this->languageIds = $languageIds;
    }

    /**
     * @return array
     */
    public function getProjectIds(): array
    {
        return $this->projectIds;
    }

    /**
     * @param array $projectIds
     */
    public function setProjectIds(array $projectIds): void
    {
        $this->projectIds = $projectIds;
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
}
