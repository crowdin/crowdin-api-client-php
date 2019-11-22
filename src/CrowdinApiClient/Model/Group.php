<?php

namespace CrowdinApiClient\Model;

/**
 * Class Group
 * @package Crowdin\Model
 */
class Group extends BaseModel
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
    protected $description;

    /**
     * @var integer
     */
    protected $parentId;

    /**
     * @var integer
     */
    protected $organizationId;

    /**
     * @var integer
     */
    protected $userId;

    /**
     * @var integer
     */
    protected $subgroupsCount = 0;

    /**
     * @var integer
     */
    protected $projectsCount = 0;

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
        $this->visibility = (integer)$this->getDataProperty('visibility');
        $this->name = (string)$this->getDataProperty('name');
        $this->description = (string)$this->getDataProperty('description');
        $this->parentId = (integer)$this->getDataProperty('parentId');
        $this->organizationId = (integer)$this->getDataProperty('organizationId');
        $this->userId = (integer)$this->getDataProperty('userId');
        $this->subgroupsCount = (integer)$this->getDataProperty('subgroupsCount');
        $this->projectsCount = (integer)$this->getDataProperty('projectsCount');
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
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getParentId(): int
    {
        return $this->parentId;
    }

    /**
     * @param int $parentId
     */
    public function setParentId(int $parentId): void
    {
        $this->parentId = $parentId;
    }

    /**
     * @return int
     */
    public function getOrganizationId(): int
    {
        return $this->organizationId;
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
    public function getSubgroupsCount(): int
    {
        return $this->subgroupsCount;
    }

    /**
     * @return int
     */
    public function getProjectsCount(): int
    {
        return $this->projectsCount;
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
