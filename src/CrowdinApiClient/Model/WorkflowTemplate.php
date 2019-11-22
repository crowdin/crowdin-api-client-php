<?php

namespace CrowdinApiClient\Model;

/**
 * Class WorkflowTemplate
 * @package Crowdin\Model
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
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return int
     */
    public function getGroupId(): int
    {
        return $this->groupId;
    }

    /**
     * @return bool
     */
    public function isDefault(): bool
    {
        return $this->isDefault;
    }

    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->id = (integer)$this->getDataProperty('id');
        $this->title = (string)$this->getDataProperty('title');
        $this->description = (string)$this->getDataProperty('description');
        $this->groupId = (integer)$this->getDataProperty('groupId');
        $this->isDefault = (bool)$this->getDataProperty('isDefault');
    }
}
