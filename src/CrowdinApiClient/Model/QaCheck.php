<?php

namespace CrowdinApiClient\Model;

/**
 * @package Crowdin\Model
 */
class QaCheck extends BaseModel
{
    /**
     * @var integer
     */
    protected $stringId;

    /**
     * @var string
     */
    protected $languageId;

    /**
     * @var string
     */
    protected $category;

    /**
     * @var string
     */
    protected $categoryDescription;

    /**
     * @var string
     */
    protected $validation;

    /**
     * @var string
     */
    protected $validationDescription;

    /**
     * @var integer
     */
    protected $pluralId;

    /**
     * @var string
     */
    protected $text;

    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->stringId = (int)$this->getDataProperty('stringId');
        $this->languageId = (string)$this->getDataProperty('languageId');
        $this->category = (string)$this->getDataProperty('category');
        $this->categoryDescription = (string)$this->getDataProperty('categoryDescription');
        $this->validation = (string)$this->getDataProperty('validation');
        $this->validationDescription = (string)$this->getDataProperty('validationDescription');
        $this->pluralId = (int)$this->getDataProperty('pluralId');
        $this->text = (string)$this->getDataProperty('text');
    }

    /**
     * @return int
     */
    public function getStringId(): int
    {
        return $this->stringId;
    }

    /**
     * @return string
     */
    public function getLanguageId(): string
    {
        return $this->languageId;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @return string
     */
    public function getCategoryDescription(): string
    {
        return $this->categoryDescription;
    }

    /**
     * @return string
     */
    public function getValidation(): string
    {
        return $this->validation;
    }

    /**
     * @return string
     */
    public function getValidationDescription(): string
    {
        return $this->validationDescription;
    }

    /**
     * @return int
     */
    public function getPluralId(): int
    {
        return $this->pluralId;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }
}
