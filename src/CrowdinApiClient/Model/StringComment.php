<?php

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
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
     * @var string|null
     */
    protected $issueType;

    /**
     * @var string|null
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

    /**
     * @var array
     */
    protected $attachments;

    /**
     * @var array|null
     */
    protected $file;

    /**
     * @var int|null
     */
    protected $fileId;

    /**
     * @var bool|null
     */
    protected $isShared;

    /**
     * @var int
     */
    protected $projectId;

    /**
     * @var array|null
     */
    protected $resolverOrganization;

    /**
     * @var array|null
     */
    protected $senderOrganization;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (int)$this->getDataProperty('id');
        $this->text = (string)$this->getDataProperty('text');
        $this->userId = (int)$this->getDataProperty('userId');
        $this->stringId = (int)$this->getDataProperty('stringId');
        $this->user = (array)$this->getDataProperty('user');
        $this->string = (array)$this->getDataProperty('string');
        $this->languageId = (string)$this->getDataProperty('languageId');
        $this->type = (string)$this->getDataProperty('type');
        $this->issueType = (string)$this->getDataProperty('issueType');
        $this->issueStatus = (string)$this->getDataProperty('issueStatus');
        $this->resolverId = (int)$this->getDataProperty('resolverId');
        $this->resolver = (array)$this->getDataProperty('resolver');
        $this->resolvedAt = (string)$this->getDataProperty('resolvedAt');
        $this->createdAt = (string)$this->getDataProperty('createdAt');
        $this->attachments = (array)$this->getDataProperty('attachments');
        $this->file = $this->nullableArray('file');
        $this->fileId = $this->nullableInt('fileId');
        $this->isShared = $this->nullableBool('isShared');
        $this->projectId = (int)$this->getDataProperty('projectId');
        $this->resolverOrganization = $this->nullableArray('resolverOrganization');
        $this->senderOrganization = $this->nullableArray('senderOrganization');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getStringId(): int
    {
        return $this->stringId;
    }

    public function setStringId(int $stringId): void
    {
        $this->stringId = $stringId;
    }

    public function getUser(): array
    {
        return $this->user;
    }

    public function setUser(array $user): void
    {
        $this->user = $user;
    }

    public function getString(): array
    {
        return $this->string;
    }

    public function setString(array $string): void
    {
        $this->string = $string;
    }

    public function getLanguageId(): string
    {
        return $this->languageId;
    }

    public function setLanguageId(string $languageId): void
    {
        $this->languageId = $languageId;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getIssueType(): ?string
    {
        return $this->issueType;
    }

    public function setIssueType(?string $issueType): void
    {
        $this->issueType = $issueType;
    }

    public function getIssueStatus(): ?string
    {
        return $this->issueStatus;
    }

    public function setIssueStatus(?string $issueStatus): void
    {
        $this->issueStatus = $issueStatus;
    }

    public function getResolverId(): int
    {
        return $this->resolverId;
    }

    public function setResolverId(int $resolverId): void
    {
        $this->resolverId = $resolverId;
    }

    public function getResolver(): array
    {
        return $this->resolver;
    }

    public function setResolver(array $resolver): void
    {
        $this->resolver = $resolver;
    }

    public function getResolvedAt(): string
    {
        return $this->resolvedAt;
    }

    public function setResolvedAt(string $resolvedAt): void
    {
        $this->resolvedAt = $resolvedAt;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getAttachments(): array
    {
        return $this->attachments;
    }

    public function setAttachments(array $attachments): void
    {
        $this->attachments = $attachments;
    }

    public function getFile(): ?array
    {
        return $this->file;
    }

    public function getFileId(): ?int
    {
        return $this->fileId;
    }

    public function isShared(): ?bool
    {
        return $this->isShared;
    }

    public function getProjectId(): int
    {
        return $this->projectId;
    }

    public function getResolverOrganization(): ?array
    {
        return $this->resolverOrganization;
    }

    public function getSenderOrganization(): ?array
    {
        return $this->senderOrganization;
    }
}
