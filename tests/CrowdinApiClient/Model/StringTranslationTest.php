<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\StringTranslation;
use PHPUnit\Framework\TestCase;

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
        'createdAt' => '2019-09-19T12:42:12+00:00'
    ];

    public function testLoadData()
    {
        $this->stringTranslation = new StringTranslation($this->data);
        $this->stringTranslation->setId($this->data['id']);
        $this->stringTranslation->setText($this->data['text']);
        $this->stringTranslation->setPluralCategoryName($this->data['pluralCategoryName']);
        $this->stringTranslation->setUser($this->data['user']);
        $this->stringTranslation->setRating($this->data['rating']);
        $this->stringTranslation->setCreatedAt($this->data['createdAt']);
        $this->checkData();
    }

    public function checkData()
    {
        $this->assertEquals($this->data['id'], $this->stringTranslation->getId());
        $this->assertEquals($this->data['text'], $this->stringTranslation->getText());
        $this->assertEquals($this->data['pluralCategoryName'], $this->stringTranslation->getPluralCategoryName());
        $this->assertEquals($this->data['user'], $this->stringTranslation->getUser());
        $this->assertEquals($this->data['rating'], $this->stringTranslation->getRating());
        $this->assertEquals($this->data['createdAt'], $this->stringTranslation->getCreatedAt());
    }
}
