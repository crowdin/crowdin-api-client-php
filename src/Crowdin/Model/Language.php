<?php

namespace Crowdin\Model;

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
     * @var integer
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
        $this->dialectOf = (integer)$this->getDataProperty('dialectOf');
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
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getOrganizationId(): int
    {
        return $this->organizationId;
    }

    /**
     * @param int $organizationId
     */
    public function setOrganizationId(int $organizationId): void
    {
        $this->organizationId = $organizationId;
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
     * @return int
     */
    public function getDialectOf(): int
    {
        return $this->dialectOf;
    }

    /**
     * @param int $dialectOf
     */
    public function setDialectOf(int $dialectOf): void
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
     * @param string $internalCode
     */
    public function setInternalCode(string $internalCode): void
    {
        $this->internalCode = $internalCode;
    }

    /**
     * @return string
     */
    public function getEditorCode(): string
    {
        return $this->editorCode;
    }

    /**
     * @param string $editorCode
     */
    public function setEditorCode(string $editorCode): void
    {
        $this->editorCode = $editorCode;
    }

    /**
     * @return string
     */
    public function getCrowdinCode(): string
    {
        return $this->crowdinCode;
    }

    /**
     * @param string $crowdinCode
     */
    public function setCrowdinCode(string $crowdinCode): void
    {
        $this->crowdinCode = $crowdinCode;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
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
     * @param string $pluralRules
     */
    public function setPluralRules(string $pluralRules): void
    {
        $this->pluralRules = $pluralRules;
    }

    /**
     * @return array
     */
    public function getPluralExamples(): array
    {
        return $this->pluralExamples;
    }

    /**
     * @param array $pluralExamples
     */
    public function setPluralExamples(array $pluralExamples): void
    {
        $this->pluralExamples = $pluralExamples;
    }

    /**
     * @return string
     */
    public function getIso6391(): string
    {
        return $this->iso6391;
    }

    /**
     * @param string $iso6391
     */
    public function setIso6391(string $iso6391): void
    {
        $this->iso6391 = $iso6391;
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
     * @param string $iso6393
     */
    public function setIso6393(string $iso6393): void
    {
        $this->iso6393 = $iso6393;
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
     * @param string $locale
     */
    public function setLocale(string $locale): void
    {
        $this->locale = $locale;
    }

    /**
     * @return string
     */
    public function getAndroidCode(): string
    {
        return $this->androidCode;
    }

    /**
     * @param string $androidCode
     */
    public function setAndroidCode(string $androidCode): void
    {
        $this->androidCode = $androidCode;
    }

    /**
     * @return string
     */
    public function getOsxCode(): string
    {
        return $this->osxCode;
    }

    /**
     * @param string $osxCode
     */
    public function setOsxCode(string $osxCode): void
    {
        $this->osxCode = $osxCode;
    }

    /**
     * @return string
     */
    public function getOsxLocale(): string
    {
        return $this->osxLocale;
    }

    /**
     * @param string $osxLocale
     */
    public function setOsxLocale(string $osxLocale): void
    {
        $this->osxLocale = $osxLocale;
    }
}
