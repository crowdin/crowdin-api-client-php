<?php

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class StringCorrection extends BaseModel
{
    /**
     * @var integer
     */
    protected $id;

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
     * @var string
     */
    protected $createdAt;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (int)$this->getDataProperty('id');
        $this->text = (string)$this->getDataProperty('text');
        $this->pluralCategoryName = (string)$this->getDataProperty('pluralCategoryName');
        $this->user = (array)$this->getDataProperty('user');
        $this->createdAt = (string)$this->getDataProperty('createdAt');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function getPluralCategoryName(): string
    {
        return $this->pluralCategoryName;
    }

    public function setPluralCategoryName(string $pluralCategoryName): void
    {
        $this->pluralCategoryName = $pluralCategoryName;
    }

    public function getUser(): array
    {
        return $this->user;
    }

    public function setUser(array $user): void
    {
        $this->user = $user;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
}
