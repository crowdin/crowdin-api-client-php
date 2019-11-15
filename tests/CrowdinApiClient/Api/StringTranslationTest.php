<?php

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\StringTranslation;
use PHPUnit\Framework\TestCase;

/**
 * Class StringTranslationTest
 * @package Crowdin\Tests\Api
 */
class StringTranslationTest extends TestCase
{
    /**
     * @var StringTranslation
     */
    public $stringTranslation;

    /**
     * @var array
     */
    public $data = [
        'id' => 190695,
        'text' => 'Цю стрічку перекладено',
        'pluralCategoryName' => 'few',
        'user' =>
            [
                'id' => 19,
                'login' => 'john_doe',
            ],
        'rating' => 10,
    ];

    public function setUp()
    {
        parent::setUp();
        $this->stringTranslation = new StringTranslation($this->data);
    }

    public function testLoadData()
    {
        $this->assertEquals($this->data['id'], $this->stringTranslation->getId());
        $this->assertEquals($this->data['text'], $this->stringTranslation->getText());
        $this->assertEquals($this->data['pluralCategoryName'], $this->stringTranslation->getPluralCategoryName());
        $this->assertEquals($this->data['user'], $this->stringTranslation->getUser());
        $this->assertEquals($this->data['rating'], $this->stringTranslation->getRating());
    }
}
