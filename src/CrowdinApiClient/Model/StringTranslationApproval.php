<?php

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class StringTranslationApproval extends BaseModel
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
     * @var integer
     */
    protected $stringId;

    /**
     * @var string
     */
    protected $languageId;

    /**
     * @var integer
     */
    protected $workflowStepId;

    /**
     * @var string
     */
    protected $createdAt;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (integer)$this->getDataProperty('id');
        $this->user = (array)$this->getDataProperty('user');
        $this->translationId = (integer)$this->getDataProperty('translationId');
        $this->stringId = (integer)$this->getDataProperty('stringId');
        $this->languageId = (string)$this->getDataProperty('languageId');
        $this->workflowStepId = (integer)$this->getDataProperty('workflowStepId');
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
     * @return int
     */
    public function getWorkflowStepId(): int
    {
        return $this->workflowStepId;
    }

    /**
     * @param int $workflowStepId
     */
    public function setWorkflowStepId(int $workflowStepId): void
    {
        $this->workflowStepId = $workflowStepId;
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
