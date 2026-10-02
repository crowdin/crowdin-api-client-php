<?php

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class Issue extends BaseModel
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
     * @var string
     */
    protected $status;

    /**
     * @var string
     */
    protected $createdAt;

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
        $this->status = (string)$this->getDataProperty('status');
        $this->createdAt = (string)$this->getDataProperty('createdAt');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getStringId(): int
    {
        return $this->stringId;
    }

    public function getUser(): array
    {
        return $this->user;
    }

    public function getString(): array
    {
        return $this->string;
    }

    public function getLanguageId(): string
    {
        return $this->languageId;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
}
