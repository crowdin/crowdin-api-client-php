<?php


namespace Crowdin\Model;


class File extends BaseModel
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
     * @var integer
     */
    protected $branchId;

    /**
     * @var integer
     */
    protected $directoryId;

    /**
     * @var string
     */
    protected $languageId;

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
    protected $type;

    /**
     * @var integer
     */
    protected $revision;

    /**
     * @var integer
     */
    protected $status;

    /**
     * @var integer
     */
    protected $priority;

    /**
     * @var array
     */
    protected $attributes = [];

    /**
     * @var string
     */
    protected $exportPattern;

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

        $this->id = $this->getDataProperty('id');
        $this->projectId = $this->getDataProperty('projectId');
        $this->branchId = $this->getDataProperty('branchId');
        $this->directoryId = $this->getDataProperty('directoryId');
        $this->languageId = $this->getDataProperty('languageId');
        $this->name = $this->getDataProperty('name');
        $this->title = $this->getDataProperty('title');
        $this->type = $this->getDataProperty('type');
        $this->revision = $this->getDataProperty('revision');
        $this->status = $this->getDataProperty('status');
        $this->priority = $this->getDataProperty('priority');
        $this->attributes = $this->getDataProperty('attributes');
        $this->exportPattern = $this->getDataProperty('exportPattern');
        $this->createdAt = $this->getDataProperty('createdAt');
        $this->updatedAt = $this->getDataProperty('updatedAt');
    }
}
