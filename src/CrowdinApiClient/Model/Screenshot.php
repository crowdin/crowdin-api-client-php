<?php

namespace CrowdinApiClient\Model;

/**
 * Class Screenshot
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

    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->id = (integer)$this->getDataProperty('id');
        $this->userId = (integer)$this->getDataProperty('userId');
        $this->url = (string)$this->getDataProperty('url');
        $this->name = (string)$this->getDataProperty('name');
        $this->size = (array)$this->getDataProperty('size');
        $this->tagsCount = (integer)$this->getDataProperty('tagsCount');
        $this->tags = (array)$this->getDataProperty('tags');
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
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
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
     * @param array $size
     */
    public function setSize(array $size): void
    {
        $this->size = $size;
    }

    /**
     * @return int
     */
    public function getTagsCount(): int
    {
        return $this->tagsCount;
    }

    /**
     * @param int $tagsCount
     */
    public function setTagsCount(int $tagsCount): void
    {
        $this->tagsCount = $tagsCount;
    }

    /**
     * @return array
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @param array $tags
     */
    public function setTags(array $tags): void
    {
        $this->tags = $tags;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @param string $createdAt
     */
    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    /**
     * @param string $updatedAt
     */
    public function setUpdatedAt(string $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}
