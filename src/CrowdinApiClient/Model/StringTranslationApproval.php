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

    /**
     * @var int
     */
    protected $fileId;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (int)$this->getDataProperty('id');
        $this->user = (array)$this->getDataProperty('user');
        $this->translationId = (int)$this->getDataProperty('translationId');
        $this->stringId = (int)$this->getDataProperty('stringId');
        $this->languageId = (string)$this->getDataProperty('languageId');
        $this->workflowStepId = (int)$this->getDataProperty('workflowStepId');
        $this->createdAt = (string)$this->getDataProperty('createdAt');
        $this->fileId = (int)$this->getDataProperty('fileId');
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

    public function getStringId(): int
    {
        return $this->stringId;
    }

    public function setStringId(int $stringId): void
    {
        $this->stringId = $stringId;
    }

    public function getLanguageId(): string
    {
        return $this->languageId;
    }

    public function setLanguageId(string $languageId): void
    {
        $this->languageId = $languageId;
    }

    public function getWorkflowStepId(): int
    {
        return $this->workflowStepId;
    }

    public function setWorkflowStepId(int $workflowStepId): void
    {
        $this->workflowStepId = $workflowStepId;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getFileId(): int
    {
        return $this->fileId;
    }
}
