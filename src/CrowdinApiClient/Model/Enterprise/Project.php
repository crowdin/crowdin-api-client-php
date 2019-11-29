<?php

namespace CrowdinApiClient\Model\Enterprise;

use CrowdinApiClient\Model\BaseModel;

/**
 * Class Project
 * @package Crowdin\Model\Enterprise
 */
class Project extends BaseModel
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
     * @var integer
     */
    protected $userId;

    /**
     * @var string
     */
    protected $sourceLanguageId;

    /**
     * @var array
     */
    protected $targetLanguageIds = [];

    /**
     * @var string
     */
    protected $joinPolicy;

    /**
     * @var string
     */
    protected $languageAccessPolicy;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $cname;

    /**
     * @var string
     */
    protected $identifier;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $visibility;

    /**
     * @var string
     */
    protected $logo;

    /**
     * @var string
     */
    protected $background;

    /**
     * @var bool
     */
    protected $isExternal;

    /**
     * @var string
     */
    protected $externalType;

    /**
     * @var integer
     */
    protected $advancedWorkflowId;

    /**
     * @var bool
     */
    protected $hasCrowdsourcing;

    /**
     * @var string
     */
    protected $createdAt;

    /**
     * @var string
     */
    protected $updatedAt;

    /**
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (integer)$this->getDataProperty('id');
        $this->groupId = (integer)$this->getDataProperty('groupId');
        $this->userId = (integer)$this->getDataProperty('userId');
        $this->sourceLanguageId = (string)$this->getDataProperty('sourceLanguageId');
        $this->targetLanguageIds = (array)$this->getDataProperty('targetLanguageIds');
        $this->joinPolicy = (string)$this->getDataProperty('joinPolicy');
        $this->languageAccessPolicy = (string)$this->getDataProperty('languageAccessPolicy');
        $this->name = (string)$this->getDataProperty('name');
        $this->cname = (string)$this->getDataProperty('cname');
        $this->identifier = (string)$this->getDataProperty('identifier');
        $this->description = (string)$this->getDataProperty('description');
        $this->visibility = (string)$this->getDataProperty('visibility');
        $this->logo = (string)$this->getDataProperty('logo');
        $this->background = (string)$this->getDataProperty('background');
        $this->isExternal = (bool)$this->getDataProperty('isExternal');
        $this->externalType = (string)$this->getDataProperty('externalType');
        $this->advancedWorkflowId = (integer)$this->getDataProperty('advancedWorkflowId');
        $this->hasCrowdsourcing = (bool)$this->getDataProperty('hasCrowdsourcing');
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
     * @return string
     */
    public function getSourceLanguageId(): string
    {
        return $this->sourceLanguageId;
    }

    /**
     * @return array
     */
    public function getTargetLanguageIds(): array
    {
        return $this->targetLanguageIds;
    }

    /**
     * @return string
     */
    public function getJoinPolicy(): string
    {
        return $this->joinPolicy;
    }

    /**
     * @param string $joinPolicy
     */
    public function setJoinPolicy(string $joinPolicy): void
    {
        $this->joinPolicy = $joinPolicy;
    }

    /**
     * @return string
     */
    public function getLanguageAccessPolicy(): string
    {
        return $this->languageAccessPolicy;
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
    public function getCname(): string
    {
        return $this->cname;
    }

    /**
     * @param string $cname
     */
    public function setCname(string $cname): void
    {
        $this->cname = $cname;
    }

    /**
     * @return string
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
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
     * @return string
     */
    public function getVisibility(): string
    {
        return $this->visibility;
    }

    /**
     * @return string
     */
    public function getLogo(): string
    {
        return $this->logo;
    }

    /**
     * @return string
     */
    public function getBackground(): string
    {
        return $this->background;
    }

    /**
     * @return bool
     */
    public function isExternal(): bool
    {
        return $this->isExternal;
    }

    /**
     * @return string
     */
    public function getExternalType(): string
    {
        return $this->externalType;
    }

    /**
     * @return int
     */
    public function getAdvancedWorkflowId(): int
    {
        return $this->advancedWorkflowId;
    }

    /**
     * @return bool
     */
    public function isHasCrowdsourcing(): bool
    {
        return $this->hasCrowdsourcing;
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
