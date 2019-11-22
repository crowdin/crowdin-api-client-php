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
     * @var int
     */
    protected $organizationId;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $dialectOf;

    /**
     * @var string
     */
    protected $textDirection;

    /**
     * @var string
     */
    protected $internalCode;

    /**
     * @var string
     */
    protected $editorCode;

    /**
     * @var string
     */
    protected $crowdinCode;

    /**
     * @var string
     */
    protected $code;

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
     * @var string
     */
    protected $iso6391;

    /**
     * @var string
     */
    protected $twoLettersCode;

    /**
     * @var string
     */
    protected $iso6393;

    /**
     * @var string
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

    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->id = (string)$this->getDataProperty('id');
        $this->organizationId = (integer)$this->getDataProperty('organizationId');
        $this->name = (string)$this->getDataProperty('name');
        $this->dialectOf = (string)$this->getDataProperty('dialectOf');
        $this->textDirection = (string)$this->getDataProperty('textDirection');
        $this->internalCode = (string)$this->getDataProperty('internalCode');
        $this->editorCode = (string)$this->getDataProperty('editorCode');
        $this->crowdinCode = (string)$this->getDataProperty('crowdinCode');
        $this->code = (string)$this->getDataProperty('code');
        $this->pluralCategoryNames = (array)$this->getDataProperty('pluralCategoryNames');
        $this->pluralRules = (string)$this->getDataProperty('pluralRules');
        $this->pluralExamples = (array)$this->getDataProperty('pluralExamples');
        $this->iso6391 = (string)$this->getDataProperty('iso6391');
        $this->twoLettersCode = (string)$this->getDataProperty('twoLettersCode');
        $this->iso6393 = (string)$this->getDataProperty('iso6393');
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
     * @return int
     */
    public function getOrganizationId(): int
    {
        return $this->organizationId;
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
     * @return string
     */
    public function getDialectOf(): string
    {
        return $this->dialectOf;
    }

    /**
     * @param string $dialectOf
     */
    public function setDialectOf(string $dialectOf): void
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
    public function getInternalCode(): string
    {
        return $this->internalCode;
    }

    /**
     * @return string
     */
    public function getEditorCode(): string
    {
        return $this->editorCode;
    }

    /**
     * @return string
     */
    public function getCrowdinCode(): string
    {
        return $this->crowdinCode;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
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
    public function getIso6391(): string
    {
        return $this->iso6391;
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
    public function getIso6393(): string
    {
        return $this->iso6393;
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
