<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class GlossaryConcept extends BaseModel
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var int
     */
    protected $userId;

    /**
     * @var int
     */
    protected $glossaryId;

    /**
     * @var string
     */
    protected $subject;

    /**
     * @var string
     */
    protected $definition;

    /**
     * @var bool
     */
    protected $translatable;

    /**
     * @var string
     */
    protected $note;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $figure;

    /**
     * @var GlossaryLanguageDetails[]
     */
    protected $languagesDetails;

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

        $this->id = (int)$this->getDataProperty('id');
        $this->userId = (int)$this->getDataProperty('userId');
        $this->glossaryId = (int)$this->getDataProperty('glossaryId');
        $this->subject = (string)$this->getDataProperty('subject');
        $this->definition = (string)$this->getDataProperty('definition');
        $this->translatable = (bool)$this->getDataProperty('translatable');
        $this->note = (string)$this->getDataProperty('note');
        $this->url = (string)$this->getDataProperty('url');
        $this->figure = (string)$this->getDataProperty('figure');
        $this->languagesDetails = array_map(
            static function (array $languageDetails): GlossaryLanguageDetails {
                return new GlossaryLanguageDetails($languageDetails);
            },
            (array)$this->getDataProperty('languagesDetails')
        );
        $this->createdAt = (string)$this->getDataProperty('createdAt');
        $this->updatedAt = (string)$this->getDataProperty('updatedAt');

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

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): void
    {
        $this->subject = $subject;
    }

    public function getDefinition(): string
    {
        return $this->definition;
    }

    public function setDefinition(string $definition): void
    {
        $this->definition = $definition;
    }

    public function getTranslatable(): bool
    {
        return $this->translatable;
    }

    public function setTranslatable(bool $translatable): void
    {
        $this->translatable = $translatable;
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

    public function getFigure(): string
    {
        return $this->figure;
    }

    public function setFigure(string $figure): void
    {
        $this->figure = $figure;
    }

    /**
     * @return GlossaryLanguageDetails[]
     */
    public function getLanguagesDetails(): array
    {
        return $this->languagesDetails;
    }

    /**
     * @param GlossaryLanguageDetails[] $languagesDetails
     */
    public function setLanguagesDetails(array $languagesDetails): void
    {
        $this->languagesDetails = $languagesDetails;
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
