<?php

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class StringTranslation extends BaseModel
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var integer|null
     */
    protected $projectId;

    /**
     * @var integer|null
     */
    protected $stringId;

    /**
     * @var string|null
     */
    protected $languageId;

    /**
     * @var string
     */
    protected $text;

    /**
     * @var string
     */
    protected $pluralCategoryName;

    /**
     * @var array
     */
    protected $user;

    /**
     * @var integer
     */
    protected $rating;

    /**
     * @var string
     */
    protected $createdAt;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (int)$this->getDataProperty('id');
        $this->projectId = $this->getDataProperty('projectId') !== null
            ? (int)$this->getDataProperty('projectId')
            : null;
        $this->stringId = $this->getDataProperty('stringId') !== null
            ? (int)$this->getDataProperty('stringId')
            : null;
        $this->languageId = $this->getDataProperty('languageId') !== null
            ? (string)$this->getDataProperty('languageId')
            : null;
        $this->text = (string)$this->getDataProperty('text');
        $this->pluralCategoryName = (string)$this->getDataProperty('pluralCategoryName');
        $this->user = (array)$this->getDataProperty('user');
        $this->rating = (int)$this->getDataProperty('rating');
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
     * @return int|null
     */
    public function getProjectId(): ?int
    {
        return $this->projectId;
    }

    /**
     * @return int|null
     */
    public function getStringId(): ?int
    {
        return $this->stringId;
    }

    /**
     * @return string|null
     */
    public function getLanguageId(): ?string
    {
        return $this->languageId;
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
    public function getPluralCategoryName(): string
    {
        return $this->pluralCategoryName;
    }

    /**
     * @param string $pluralCategoryName
     */
    public function setPluralCategoryName(string $pluralCategoryName): void
    {
        $this->pluralCategoryName = $pluralCategoryName;
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
    public function getRating(): int
    {
        return $this->rating;
    }

    /**
     * @param int $rating
     */
    public function setRating(int $rating): void
    {
        $this->rating = $rating;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }
}
