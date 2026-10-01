<?php

namespace CrowdinApiClient\Model;

/**
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

    /**
     * @var string
     */
    protected $bcp47Code;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->id = (string)$this->getDataProperty('id');
        $this->name = (string)$this->getDataProperty('name');
        $this->dialectOf = $this->nullableString('dialectOf');
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
        $this->bcp47Code = (string)$this->getDataProperty('bcp47Code');
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDialectOf(): ?string
    {
        return $this->dialectOf;
    }

    public function setDialectOf(?string $dialectOf): void
    {
        $this->dialectOf = $dialectOf;
    }

    public function getTextDirection(): string
    {
        return $this->textDirection;
    }

    public function setTextDirection(string $textDirection): void
    {
        $this->textDirection = $textDirection;
    }

    public function getEditorCode(): string
    {
        return $this->editorCode;
    }

    public function getPluralCategoryNames(): array
    {
        return $this->pluralCategoryNames;
    }

    public function setPluralCategoryNames(array $pluralCategoryNames): void
    {
        $this->pluralCategoryNames = $pluralCategoryNames;
    }

    public function getPluralRules(): string
    {
        return $this->pluralRules;
    }

    public function getPluralExamples(): array
    {
        return $this->pluralExamples;
    }

    public function getTwoLettersCode(): string
    {
        return $this->twoLettersCode;
    }

    public function setTwoLettersCode(string $twoLettersCode): void
    {
        $this->twoLettersCode = $twoLettersCode;
    }

    public function getThreeLettersCode(): string
    {
        return $this->threeLettersCode;
    }

    public function setThreeLettersCode(string $threeLettersCode): void
    {
        $this->threeLettersCode = $threeLettersCode;
    }

    public function getLocale(): string
    {
        return $this->locale;
    }

    public function getAndroidCode(): string
    {
        return $this->androidCode;
    }

    public function getOsxCode(): string
    {
        return $this->osxCode;
    }

    public function getOsxLocale(): string
    {
        return $this->osxLocale;
    }

    public function getBcp47Code(): string
    {
        return $this->bcp47Code;
    }
}
