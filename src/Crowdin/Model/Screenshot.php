<?php


namespace Crowdin\Model;


class Screenshot extends BaseModel
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var integer
     */
    protected $userId;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var array
     */
    protected $size;

    /**
     * @var integer
     */
    protected $tagsCount;

    /**
     * @var array
     */
    protected $tags = [];

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
        $this->userId = $this->getDataProperty('userId');
        $this->url = $this->getDataProperty('url');
        $this->name = $this->getDataProperty('name');
        $this->size = $this->getDataProperty('size');
        $this->tagsCount = $this->getDataProperty('tagsCount');
        $this->tags = $this->getDataProperty('tags');
        $this->createdAt = $this->getDataProperty('createdAt');
        $this->updatedAt = $this->getDataProperty('updatedAt');
    }
}
