<?php

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class Vote extends BaseModel
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var array
     */
    protected $user;

    /**
     * @var integer
     */
    protected $translationId;

    /**
     * @var string
     */
    protected $votedAt;

    /**
     * @var string
     */
    protected $mark;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = $this->getDataProperty('id');
        $this->user = $this->getDataProperty('user');
        $this->translationId = $this->getDataProperty('translationId');
        $this->votedAt = $this->getDataProperty('votedAt');
        $this->mark = $this->getDataProperty('mark');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getUser(): array
    {
        return $this->user;
    }

    public function setUser(array $user): void
    {
        $this->user = $user;
    }

    public function getTranslationId(): int
    {
        return $this->translationId;
    }

    public function setTranslationId(int $translationId): void
    {
        $this->translationId = $translationId;
    }

    public function getVotedAt(): string
    {
        return $this->votedAt;
    }

    public function setVotedAt(string $votedAt): void
    {
        $this->votedAt = $votedAt;
    }

    public function getMark(): string
    {
        return $this->mark;
    }

    public function setMark(string $mark): void
    {
        $this->mark = $mark;
    }
}
