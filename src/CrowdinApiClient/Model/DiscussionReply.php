<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class DiscussionReply extends BaseModel
{
    /** @var int */
    protected $id;

    /** @var int */
    protected $discussionId;

    /** @var string */
    protected $type;

    /** @var string */
    protected $text;

    /** @var int */
    protected $userId;

    /** @var array */
    protected $user;

    /** @var string */
    protected $createdAt;

    /** @var string */
    protected $updatedAt;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (int)$this->getDataProperty('id');
        $this->discussionId = (int)$this->getDataProperty('discussionId');
        $this->type = (string)$this->getDataProperty('type');
        $this->text = (string)$this->getDataProperty('text');
        $this->userId = (int)$this->getDataProperty('userId');
        $this->user = (array)$this->getDataProperty('user');
        $this->createdAt = (string)$this->getDataProperty('createdAt');
        $this->updatedAt = (string)$this->getDataProperty('updatedAt');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getDiscussionId(): int
    {
        return $this->discussionId;
    }

    /**
     * @return string description, reply or system
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string Markdown. For system replies, the new discussion status: open or closed
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text Markdown. System replies can't be edited
     */
    public function setText(string $text): void
    {
        $this->text = $text;
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

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }
}
