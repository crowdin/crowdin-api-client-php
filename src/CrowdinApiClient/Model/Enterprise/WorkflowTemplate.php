<?php

namespace CrowdinApiClient\Model\Enterprise;

use CrowdinApiClient\Model\BaseModel;

/**
 * @package Crowdin\Model\Enterprise
 */
class WorkflowTemplate extends BaseModel
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var integer
     */
    protected $groupId;

    /**
     * @var bool
     */
    protected $isDefault;

    /**
     * @var array
     */
    protected $steps;

    /**
     * @var string
     */
    protected $webUrl;

    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->id = (int)$this->getDataProperty('id');
        $this->title = (string)$this->getDataProperty('title');
        $this->description = (string)$this->getDataProperty('description');
        $this->groupId = (int)$this->getDataProperty('groupId');
        $this->isDefault = (bool)$this->getDataProperty('isDefault');
        $this->steps = (array)$this->getDataProperty('steps');
        $this->webUrl = (string)$this->getDataProperty('webUrl');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getGroupId(): int
    {
        return $this->groupId;
    }

    public function isDefault(): bool
    {
        return $this->isDefault;
    }

    public function getSteps(): array
    {
        return $this->steps;
    }

    public function getWebUrl(): string
    {
        return $this->webUrl;
    }
}
