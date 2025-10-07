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

        $this->id = (integer)$this->getDataProperty('id');
        $this->text = (string)$this->getDataProperty('text');
        $this->pluralCategoryName = (string)$this->getDataProperty('pluralCategoryName');
        $this->user = (array)$this->getDataProperty('user');
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
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
}
