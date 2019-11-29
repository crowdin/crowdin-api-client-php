<?php

namespace CrowdinApiClient\Tests\Model\Enterprise;

use CrowdinApiClient\Model\Enterprise\Language;
use PHPUnit\Framework\TestCase;

/**
 * Class LanguageTest
 * @package Crowdin\Tests\Model
 */
class LanguageTest extends TestCase
{
    /**
     * @var Language
     */
    public $language;

    /**
     * @var array
     */
    public $data = [
        'id' => 'es',
        'name' => 'Spanish',
        'editorCode' => 'es',
        'twoLettersCode' => 'es',
        'threeLettersCode' => 'spa',
        'locale' => 'es-ES',
        'androidCode' => 'es-rES',
        'osxCode' => 'es.lproj',
        'osxLocale' => 'es',
        'pluralCategoryNames' =>
            [
                0 => 'one',
            ],
        'pluralRules' => '(n != 1)',
        'pluralExamples' =>
            [
                0 => '0, 2-999; 1.2, 2.07...',
            ],
        'textDirection' => 'ltr',
        'dialectOf' => 'string',
    ];

    public function testLoadData()
    {
        $this->language = new Language($this->data);
        $this->checkData();
    }

    public function testSetData()
    {
        $this->language = new Language();
        $this->language->setName($this->data['name']);
        $this->language->setTwoLettersCode($this->data['twoLettersCode']);
        $this->language->setThreeLettersCode($this->data['threeLettersCode']);
        $this->language->setPluralCategoryNames($this->data['pluralCategoryNames']);
        $this->language->setTextDirection($this->data['textDirection']);
        $this->language->setDialectOf($this->data['dialectOf']);

        $this->assertEquals($this->data['name'], $this->language->getName());
        $this->assertEquals($this->data['twoLettersCode'], $this->language->getTwoLettersCode());
        $this->assertEquals($this->data['threeLettersCode'], $this->language->getThreeLettersCode());
        $this->assertEquals($this->data['textDirection'], $this->language->getTextDirection());
        $this->assertEquals($this->data['dialectOf'], $this->language->getDialectOf());
    }

    public function checkData()
    {
        $this->assertEquals($this->data['id'], $this->language->getId());
        $this->assertEquals($this->data['name'], $this->language->getName());
        $this->assertEquals($this->data['textDirection'], $this->language->getTextDirection());
        $this->assertEquals($this->data['editorCode'], $this->language->getEditorCode());
        $this->assertEquals($this->data['twoLettersCode'], $this->language->getTwoLettersCode());
        $this->assertEquals($this->data['threeLettersCode'], $this->language->getThreeLettersCode());
        $this->assertEquals($this->data['locale'], $this->language->getLocale());
        $this->assertEquals($this->data['androidCode'], $this->language->getAndroidCode());
        $this->assertEquals($this->data['osxCode'], $this->language->getOsxCode());
        $this->assertEquals($this->data['osxLocale'], $this->language->getOsxLocale());
        $this->assertEquals($this->data['pluralCategoryNames'], $this->language->getPluralCategoryNames());
        $this->assertEquals($this->data['pluralRules'], $this->language->getPluralRules());
        $this->assertEquals($this->data['pluralExamples'], $this->language->getPluralExamples());
        $this->assertEquals($this->data['textDirection'], $this->language->getTextDirection());
        $this->assertEquals($this->data['dialectOf'], $this->language->getDialectOf());
    }
}
