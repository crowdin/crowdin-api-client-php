<?php

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
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

    /**
     * @var array
     */
    protected $labelIds = [];

    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->id = (int)$this->getDataProperty('id');
        $this->userId = (int)$this->getDataProperty('userId');
        $this->url = (string)$this->getDataProperty('url');
        $this->name = (string)$this->getDataProperty('name');
        $this->size = (array)$this->getDataProperty('size');
        $this->tagsCount = (int)$this->getDataProperty('tagsCount');
        $this->tags = (array)$this->getDataProperty('tags');
        $this->createdAt = (string)$this->getDataProperty('createdAt');
        $this->updatedAt = (string)$this->getDataProperty('updatedAt');
        $this->labelIds = (array)$this->getDataProperty('labelIds');
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
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
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
     * @return array
     */
    public function getSize(): array
    {
        return $this->size;
    }

    /**
     * @return int
     */
    public function getTagsCount(): int
    {
        return $this->tagsCount;
    }

    /**
     * @return array
     */
    public function getTags(): array
    {
        return $this->tags;
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
     * @return array
     */
    public function getLabelIds(): array
    {
        return $this->labelIds;
    }
}
