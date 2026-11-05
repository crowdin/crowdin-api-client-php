<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class Discussion extends BaseModel
{
    /** @var int */
    protected $id;

    /** @var int */
    protected $projectId;

    /** @var string */
    protected $title;

    /** @var string */
    protected $status;

    /** @var string|null */
    protected $languageId;

    /** @var int */
    protected $userId;

    /** @var array */
    protected $user;

    /** @var int */
    protected $repliesCount;

    /** @var bool */
    protected $isMuted;

    /** @var string */
    protected $createdAt;

    /** @var string */
    protected $updatedAt;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (int)$this->getDataProperty('id');
        $this->projectId = (int)$this->getDataProperty('projectId');
        $this->title = (string)$this->getDataProperty('title');
        $this->status = (string)$this->getDataProperty('status');
        $this->languageId = $this->nullableString('languageId');
        $this->userId = (int)$this->getDataProperty('userId');
        $this->user = (array)$this->getDataProperty('user');
        $this->repliesCount = (int)$this->getDataProperty('repliesCount');
        $this->isMuted = (bool)$this->getDataProperty('isMuted');
        $this->createdAt = (string)$this->getDataProperty('createdAt');
        $this->updatedAt = (string)$this->getDataProperty('updatedAt');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getProjectId(): int
    {
        return $this->projectId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string open or closed
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status open or closed
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string|null Null when the discussion is about all languages
     */
    public function getLanguageId(): ?string
    {
        return $this->languageId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return array id, username, fullName, avatarUrl
     */
    public function getUser(): array
    {
        return $this->user;
    }

    /**
     * @return int System replies included, the description not counted
     */
    public function getRepliesCount(): int
    {
        return $this->repliesCount;
    }

    /**
     * @return bool Whether the authenticated user muted the discussion
     */
    public function isMuted(): bool
    {
        return $this->isMuted;
    }

    /**
     * @param bool $isMuted Applies to the authenticated user only
     */
    public function setIsMuted(bool $isMuted): void
    {
        $this->isMuted = $isMuted;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }
}
