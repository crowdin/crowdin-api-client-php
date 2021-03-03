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
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return int
     */
    public function getStringId(): int
    {
        return $this->stringId;
    }

    /**
     * @return array
     */
    public function getUser(): array
    {
        return $this->user;
    }

    /**
     * @return array
     */
    public function getString(): array
    {
        return $this->string;
    }

    /**
     * @return string
     */
    public function getLanguageId(): string
    {
        return $this->languageId;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string|null
     */
    public function getIssueType(): ?string
    {
        return $this->issueType;
    }

    /**
     * @return string|null
     */
    public function getIssueStatus(): ?string
    {
        return $this->issueStatus;
    }

    /**
     * @return int
     */
    public function getResolverId(): int
    {
        return $this->resolverId;
    }

    /**
     * @return array
     */
    public function getResolver(): array
    {
        return $this->resolver;
    }

    /**
     * @return string
     */
    public function getResolvedAt(): string
    {
        return $this->resolvedAt;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
}
