<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class GlossaryLanguageDetails extends BaseModel
{
    /**
     * @var string
     */
    protected $languageId;

    /**
     * @var int
     */
    protected $userId;

    /**
     * @var string
     */
    protected $definition;

    /**
     * @var string
     */
    protected $note;

    /**
     * @var string
     */
    protected $createdAt;

    /**
     * @var string
     */
    protected $updatedAt;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->languageId = (string)$this->getDataProperty('languageId');
        $this->userId = (int)$this->getDataProperty('userId');
        $this->definition = (string)$this->getDataProperty('definition');
        $this->note = (string)$this->getDataProperty('note');
        $this->createdAt = (string)$this->getDataProperty('createdAt');
        $this->updatedAt = (string)$this->getDataProperty('updatedAt');
    }

    public function getLanguageId(): string
    {
        return $this->languageId;
    }

    public function setLanguageId(string $languageId): void
    {
        $this->languageId = $languageId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getDefinition(): string
    {
        return $this->definition;
    }

    public function setDefinition(string $definition): void
    {
        $this->definition = $definition;
    }

    public function getNote(): string
    {
        return $this->note;
    }

    public function setNote(string $note): void
    {
        $this->note = $note;
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
