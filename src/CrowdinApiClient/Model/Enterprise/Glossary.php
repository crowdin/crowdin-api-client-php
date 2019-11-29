<?php

namespace CrowdinApiClient\Model\Enterprise;

use CrowdinApiClient\Model\BaseModel;

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
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return int
     */
    public function getTerms(): int
    {
        return $this->terms;
    }

    /**
     * @return array
     */
    public function getLanguageIds(): array
    {
        return $this->languageIds;
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
}
