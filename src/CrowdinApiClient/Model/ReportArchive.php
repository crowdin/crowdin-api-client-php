<?php

namespace CrowdinApiClient\Model;

class ReportArchive extends BaseModel
{
    /**
     * @var integer
     */
    protected $id;
    /**
     * @var string
     */
    protected $scopeType;
    /**
     * @var integer
     */
    protected $scopeId;
    /**
     * @var integer
     */
    protected $userId;
    /**
     * @var string
     */
    protected $name;
    /**
     * @var string
     */
    protected $webUrl;
    /**
     * @var array
     */
    protected $scheme;
    /**
     * @var string
     */
    protected $createdAt;

    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->id = (int)$this->getDataProperty('id');
        $this->scopeType = (string)$this->getDataProperty('scopeType');
        $this->scopeId = (int)$this->getDataProperty('scopeId');
        $this->userId = (int)$this->getDataProperty('userId');
        $this->name = (string)$this->getDataProperty('name');
        $this->webUrl = (string)$this->getDataProperty('webUrl');
        $this->scheme = (array)$this->getDataProperty('scheme');
        $this->createdAt = (string)$this->getDataProperty('createdAt');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getScopeType(): string
    {
        return $this->scopeType;
    }

    public function setScopeType(string $scopeType): void
    {
        $this->scopeType = $scopeType;
    }

    public function getScopeId(): int
    {
        return $this->scopeId;
    }

    public function setScopeId(int $scopeId): void
    {
        $this->scopeId = $scopeId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getWebUrl(): string
    {
        return $this->webUrl;
    }

    public function setWebUrl(string $webUrl): void
    {
        $this->webUrl = $webUrl;
    }

    public function getScheme(): array
    {
        return $this->scheme;
    }

    public function setScheme(array $scheme): void
    {
        $this->scheme = $scheme;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }
}
