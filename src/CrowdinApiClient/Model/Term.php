<?php

namespace CrowdinApiClient\Model;

/**
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
    protected $status;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $gender;

    /**
     * @var string
     */
    protected $note;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var int
     */
    protected $conceptId;

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
     * @var array|null
     */
    protected $fields;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (int)$this->getDataProperty('id');
        $this->userId = (int)$this->getDataProperty('userId');
        $this->glossaryId = (int)$this->getDataProperty('glossaryId');
        $this->languageId = (string)$this->getDataProperty('languageId');
        $this->text = (string)$this->getDataProperty('text');
        $this->description = (string)$this->getDataProperty('description');
        $this->partOfSpeech = (string)$this->getDataProperty('partOfSpeech');
        $this->status = (string)$this->getDataProperty('status');
        $this->type = (string)$this->getDataProperty('type');
        $this->gender = (string)$this->getDataProperty('gender');
        $this->note = (string)$this->getDataProperty('note');
        $this->url = (string)$this->getDataProperty('url');
        $this->conceptId = (int)$this->getDataProperty('conceptId');
        $this->lemma = (string)$this->getDataProperty('lemma');
        $this->createdAt = (string)$this->getDataProperty('createdAt');
        $this->updatedAt = (string)$this->getDataProperty('updatedAt');
        $this->fields = $this->nullableArray('fields');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getGlossaryId(): int
    {
        return $this->glossaryId;
    }

    public function getLanguageId(): string
    {
        return $this->languageId;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getPartOfSpeech(): string
    {
        return $this->partOfSpeech;
    }

    public function setPartOfSpeech(string $partOfSpeech): void
    {
        $this->partOfSpeech = $partOfSpeech;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function setGender(string $gender): void
    {
        $this->gender = $gender;
    }

    public function getNote(): string
    {
        return $this->note;
    }

    public function setNote(string $note): void
    {
        $this->note = $note;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function getConceptId(): int
    {
        return $this->conceptId;
    }

    public function getLemma(): string
    {
        return $this->lemma;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function getFields(): ?array
    {
        return $this->fields;
    }

    public function setFields(array $fields): void
    {
        $this->fields = $fields;
    }
}
