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

    /**
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = $this->getDataProperty('id');
        $this->user = $this->getDataProperty('user');
        $this->translationId = $this->getDataProperty('translationId');
        $this->votedAt = $this->getDataProperty('votedAt');
        $this->mark = $this->getDataProperty('mark');
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
     * @return int
     */
    public function getTranslationId(): int
    {
        return $this->translationId;
    }

    /**
     * @param int $translationId
     */
    public function setTranslationId(int $translationId): void
    {
        $this->translationId = $translationId;
    }

    /**
     * @return string
     */
    public function getVotedAt(): string
    {
        return $this->votedAt;
    }

    /**
     * @param string $votedAt
     */
    public function setVotedAt(string $votedAt): void
    {
        $this->votedAt = $votedAt;
    }

    /**
     * @return string
     */
    public function getMark(): string
    {
        return $this->mark;
    }

    /**
     * @param string $mark
     */
    public function setMark(string $mark): void
    {
        $this->mark = $mark;
    }
}
