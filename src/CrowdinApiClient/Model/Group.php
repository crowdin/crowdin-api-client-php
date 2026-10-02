<?php

namespace CrowdinApiClient\Model;

/**
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

        $this->id = (int)$this->getDataProperty('id');
        $this->name = (string)$this->getDataProperty('name');
        $this->description = (string)$this->getDataProperty('description');
        $this->parentId = (int)$this->getDataProperty('parentId');
        $this->organizationId = (int)$this->getDataProperty('organizationId');
        $this->userId = (int)$this->getDataProperty('userId');
        $this->subgroupsCount = (int)$this->getDataProperty('subgroupsCount');
        $this->projectsCount = (int)$this->getDataProperty('projectsCount');
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

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getParentId(): int
    {
        return $this->parentId;
    }

    public function setParentId(int $parentId): void
    {
        $this->parentId = $parentId;
    }

    public function getOrganizationId(): int
    {
        return $this->organizationId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getSubgroupsCount(): int
    {
        return $this->subgroupsCount;
    }

    public function getProjectsCount(): int
    {
        return $this->projectsCount;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }
}
