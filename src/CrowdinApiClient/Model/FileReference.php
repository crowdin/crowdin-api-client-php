<?php

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class FileReference extends BaseModel
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
    protected $url;

    /**
     * @var array
     */
    protected $user = [];

    /**
     * @var string
     */
    protected $createdAt;

    /**
     * @var string
     */
    protected $mimeType;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (int)$this->getDataProperty('id');
        $this->name = (string)$this->getDataProperty('name');
        $this->url = (string)$this->getDataProperty('url');
        $this->user = (array)$this->getDataProperty('user');
        $this->createdAt = (string)$this->getDataProperty('createdAt');
        $this->mimeType = (string)$this->getDataProperty('mimeType');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getUser(): array
    {
        return $this->user;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getMimeType(): string
    {
        return $this->mimeType;
    }
}
