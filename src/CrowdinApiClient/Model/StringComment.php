<?php

namespace CrowdinApiClient\Model;

class StringComment extends BaseModel
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $text;

    /**
     * @var integer
     */
    protected $userId;

    /**
     * @var integer
     */
    protected $stringId;

    /**
     * @var array
     */
    protected $user;

    /**
     * @var array
     */
    protected $string;

    /**
     * @var string
     */
    protected $languageId;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var ?string
     */
    protected $issueType;

    /**
     * @var ?string
     */
    protected $issueStatus;

    /**
     * @var integer
     */
    protected $resolverId;

    /**
     * @var array
     */
    protected $resolver;

    /**
     * @var string
     */
    protected $resolvedAt;

    /**
     * @var string
     */
    protected $createdAt;

    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->id = (integer)$this->getDataProperty('id');
        $this->text = (string)$this->getDataProperty('text');
        $this->userId = (integer)$this->getDataProperty('userId');
        $this->stringId = (integer)$this->getDataProperty('stringId');
        $this->user = (array)$this->getDataProperty('user');
        $this->string = (array)$this->getDataProperty('string');
        $this->languageId = (string)$this->getDataProperty('languageId');
        $this->type = (string)$this->getDataProperty('type');
        $this->issueType = (string)$this->getDataProperty('issueType');
        $this->issueStatus = (string)$this->getDataProperty('issueStatus');
        $this->resolverId = (integer)$this->getDataProperty('resolverId');
        $this->resolver = (array)$this->getDataProperty('resolver');
        $this->resolvedAt = (string)$this->getDataProperty('resolvedAt');
        $this->createdAt = (string)$this->getDataProperty('createdAt');
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
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
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
     * @return int
     */
    public function getStringId(): int
    {
        return $this->stringId;
    }

    /**
     * @param int $stringId
     */
    public function setStringId(int $stringId): void
    {
        $this->stringId = $stringId;
    }

    /**
     * @return array
     */
    public function getUser(): array
    {
        return $this->user;
    }

    /**
     * @param array $user
     */
    public function setUser(array $user): void
    {
        $this->user = $user;
    }

    /**
     * @return array
     */
    public function getString(): array
    {
        return $this->string;
    }

    /**
     * @param array $string
     */
    public function setString(array $string): void
    {
        $this->string = $string;
    }

    /**
     * @return string
     */
    public function getLanguageId(): string
    {
        return $this->languageId;
    }

    /**
     * @param string $languageId
     */
    public function setLanguageId(string $languageId): void
    {
        $this->languageId = $languageId;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string|null
     */
    public function getIssueType(): ?string
    {
        return $this->issueType;
    }

    /**
     * @param string|null $issueType
     */
    public function setIssueType(?string $issueType): void
    {
        $this->issueType = $issueType;
    }

    /**
     * @return string|null
     */
    public function getIssueStatus(): ?string
    {
        return $this->issueStatus;
    }

    /**
     * @param string|null $issueStatus
     */
    public function setIssueStatus(?string $issueStatus): void
    {
        $this->issueStatus = $issueStatus;
    }

    /**
     * @return int
     */
    public function getResolverId(): int
    {
        return $this->resolverId;
    }

    /**
     * @param int $resolverId
     */
    public function setResolverId(int $resolverId): void
    {
        $this->resolverId = $resolverId;
    }

    /**
     * @return array
     */
    public function getResolver(): array
    {
        return $this->resolver;
    }

    /**
     * @param array $resolver
     */
    public function setResolver(array $resolver): void
    {
        $this->resolver = $resolver;
    }

    /**
     * @return string
     */
    public function getResolvedAt(): string
    {
        return $this->resolvedAt;
    }

    /**
     * @param string $resolvedAt
     */
    public function setResolvedAt(string $resolvedAt): void
    {
        $this->resolvedAt = $resolvedAt;
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
}
