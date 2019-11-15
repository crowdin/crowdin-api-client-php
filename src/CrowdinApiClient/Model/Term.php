<?php

namespace CrowdinApiClient\Model;

/**
 * Class Term
 * @package Crowdin\Model
 */
class Term extends BaseModel
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var integer
     */
    protected $userId;

    /**
     * @var integer
     */
    protected $glossaryId;

    /**
     * @var string
     */
    protected $languageId;

    /**
     * @var string
     */
    protected $text;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $partOfSpeech;

    /**
     * @var string
     */
    protected $lemma;

    /**
     * @var string
     */
    protected $createdAt;

    /**
     * @var string
     */
    protected $updatedAt;

    /**
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (integer)$this->getDataProperty('id');
        $this->userId = (integer)$this->getDataProperty('userId');
        $this->glossaryId = (integer)$this->getDataProperty('glossaryId');
        $this->languageId = (string)$this->getDataProperty('languageId');
        $this->text = (string)$this->getDataProperty('text');
        $this->description = (string)$this->getDataProperty('description');
        $this->partOfSpeech = (string)$this->getDataProperty('partOfSpeech');
        $this->lemma = (string)$this->getDataProperty('lemma');
        $this->createdAt = (string)$this->getDataProperty('createdAt');
        $this->updatedAt = (string)$this->getDataProperty('updatedAt');
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
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return int
     */
    public function getGlossaryId(): int
    {
        return $this->glossaryId;
    }

    /**
     * @param int $glossaryId
     */
    public function setGlossaryId(int $glossaryId): void
    {
        $this->glossaryId = $glossaryId;
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
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getPartOfSpeech(): string
    {
        return $this->partOfSpeech;
    }

    /**
     * @param string $partOfSpeech
     */
    public function setPartOfSpeech(string $partOfSpeech): void
    {
        $this->partOfSpeech = $partOfSpeech;
    }

    /**
     * @return string
     */
    public function getLemma(): string
    {
        return $this->lemma;
    }

    /**
     * @param string $lemma
     */
    public function setLemma(string $lemma): void
    {
        $this->lemma = $lemma;
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

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    /**
     * @param string $updatedAt
     */
    public function setUpdatedAt(string $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}
