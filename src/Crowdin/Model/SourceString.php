<?php

namespace Crowdin\Model;

/**
 * Class SourceString
 * @package Crowdin\Model
 */
class SourceString extends BaseModel
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var integer
     */
    protected $projectId;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $exportPattern;

    /**
     * @var integer
     */
    protected $status;

    /**
     * @var integer
     */
    protected $priority;

    /**
     * @var string
     */
    protected $createdAt;

    /**
     * @var string
     */
    protected $updatedAt;

    /**
     * SourceString constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = $this->getDataProperty('id');
        $this->projectId = $this->getDataProperty('projectId');
        $this->name = $this->getDataProperty('name');
        $this->title = $this->getDataProperty('title');
        $this->exportPattern = $this->getDataProperty('exportPattern');
        $this->status = $this->getDataProperty('status');
        $this->priority = $this->getDataProperty('priority');
        $this->createdAt = $this->getDataProperty('createdAt');
        $this->updatedAt = $this->getDataProperty('updatedAt');
    }
}
