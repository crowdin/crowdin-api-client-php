<?php


namespace Crowdin\Model;

/**
 * Class Branche
 * @package Crowdin\Model
 *
 */
class Branch extends BaseModel
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

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (integer)$this->getDataProperty('id');
        $this->projectId = (integer)$this->getDataProperty('projectId');
        $this->name = (string)$this->getDataProperty('name');
        $this->title = (string)$this->getDataProperty('title');
        $this->exportPattern = (string)$this->getDataProperty('exportPattern');
        $this->status = (integer)$this->getDataProperty('status');
        $this->priority = (integer)$this->getDataProperty('priority');
        $this->createdAt = (string)$this->getDataProperty('createdAt');
        $this->updatedAt = (string)$this->getDataProperty('updatedAt');
    }
}
