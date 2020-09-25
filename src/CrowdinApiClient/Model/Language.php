<?php

namespace CrowdinApiClient\Model;

/**
 * Class Language
 * @package Crowdin\Model
 */
class Language extends BaseModel
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string alias of internal code
     */
    protected $editorCode;

    /**
     * @var string alias of iso6391 code
     */
    protected $twoLettersCode;

    /**
     * @var string alias of iso6393 code
     */
    protected $threeLettersCode;

    /**
     * @var string
     */
    protected $locale;

    /**
     * @var string
     */
    protected $androidCode;

    /**
     * @var string
     */
    protected $osxCode;

    /**
     * @var string
     */
    protected $osxLocale;

    /**
     * @var array
     */
    protected $pluralCategoryNames = [];

    /**
     * @var string
     */
    protected $pluralRules;

    /**
     * @var array
     */
    protected $pluralExamples = [];

    /**
     * @var string Enum: "ltr" "rtl"
     */
    protected $textDirection;

    /**
     * @var string|null
     */
    protected $dialectOf;

    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->id = (string)$this->getDataProperty('id');
        $this->name = (string)$this->getDataProperty('name');
        $this->dialectOf = (string)$this->getDataProperty('dialectOf');
        $this->textDirection = (string)$this->getDataProperty('textDirection');
        $this->editorCode = (string)$this->getDataProperty('editorCode');
        $this->pluralCategoryNames = (array)$this->getDataProperty('pluralCategoryNames');
        $this->pluralRules = (string)$this->getDataProperty('pluralRules');
        $this->pluralExamples = (array)$this->getDataProperty('pluralExamples');
        $this->twoLettersCode = (string)$this->getDataProperty('twoLettersCode');
        $this->threeLettersCode = (string)$this->getDataProperty('threeLettersCode');
        $this->locale = (string)$this->getDataProperty('locale');
        $this->androidCode = (string)$this->getDataProperty('androidCode');
        $this->osxCode = (string)$this->getDataProperty('osxCode');
        $this->osxLocale = (string)$this->getDataProperty('osxLocale');
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getDialectOf(): ?string
    {
        return $this->dialectOf;
    }

    /**
     * @param string|null $dialectOf
     */
    public function setDialectOf(?string $dialectOf): void
    {
        $this->dialectOf = $dialectOf;
    }

    /**
     * @return string
     */
    public function getTextDirection(): string
    {
        return $this->textDirection;
    }

    /**
     * @param string $textDirection
     */
    public function setTextDirection(string $textDirection): void
    {
        $this->textDirection = $textDirection;
    }

    /**
     * @return string
     */
    public function getEditorCode(): string
    {
        return $this->editorCode;
    }

    /**
     * @return array
     */
    public function getPluralCategoryNames(): array
    {
        return $this->pluralCategoryNames;
    }

    /**
     * @param array $pluralCategoryNames
     */
    public function setPluralCategoryNames(array $pluralCategoryNames): void
    {
        $this->pluralCategoryNames = $pluralCategoryNames;
    }

    /**
     * @return string
     */
    public function getPluralRules(): string
    {
        return $this->pluralRules;
    }

    /**
     * @return array
     */
    public function getPluralExamples(): array
    {
        return $this->pluralExamples;
    }

    /**
     * @return string
     */
    public function getTwoLettersCode(): string
    {
        return $this->twoLettersCode;
    }

    /**
     * @param string $twoLettersCode
     */
    public function setTwoLettersCode(string $twoLettersCode): void
    {
        $this->twoLettersCode = $twoLettersCode;
    }

    /**
     * @return string
     */
    public function getThreeLettersCode(): string
    {
        return $this->threeLettersCode;
    }

    /**
     * @param string $threeLettersCode
     */
    public function setThreeLettersCode(string $threeLettersCode): void
    {
        $this->threeLettersCode = $threeLettersCode;
    }

    /**
     * @return string
     */
    public function getLocale(): string
    {
        return $this->locale;
    }

    /**
     * @return string
     */
    public function getAndroidCode(): string
    {
        return $this->androidCode;
    }

    /**
     * @return string
     */
    public function getOsxCode(): string
    {
        return $this->osxCode;
    }

    /**
     * @return string
     */
    public function getOsxLocale(): string
    {
        return $this->osxLocale;
    }
}
