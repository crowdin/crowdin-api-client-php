<?php

namespace CrowdinApiClient\Model\Enterprise;

use CrowdinApiClient\Model\BaseModel;

/**
 * @package Crowdin\Model\Enterprise
 */
class Group extends BaseModel
{
    /**
     * @var int
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
     * @var int
     */
    protected $parentId;

    /**
     * @var int
     */
    protected $organizationId;

    /**
     * @var int
     */
    protected $userId;

    /**
     * @var int
     */
    protected $subgroupsCount = 0;

    /**
     * @var int
     */
    protected $projectsCount = 0;

    /**
     * @var string
     */
    protected $webUrl;

    /**
     * @var int
     */
    protected $savingsReportSettingsTemplateId;

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
        $this->webUrl = (string)$this->getDataProperty('webUrl');
        $this->createdAt = (string)$this->getDataProperty('createdAt');
        $this->updatedAt = (string)$this->getDataProperty('updatedAt');

        // This information is available only for managers and admins
        $this->savingsReportSettingsTemplateId = (int)$this->getDataProperty('savingsReportSettingsTemplateId');
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

    /**
     * @return string
     */
    public function getWebUrl(): string
    {
        return $this->webUrl;
    }

    /**
     * @return int
     */
    public function getSavingsReportSettingsTemplateId(): int
    {
        return $this->savingsReportSettingsTemplateId;
    }
}
