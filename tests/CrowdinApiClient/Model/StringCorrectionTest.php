<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\StringCorrection;
use PHPUnit\Framework\TestCase;

class StringCorrectionTest extends TestCase
{
    /**
     * @var StringCorrection
     */
    public $stringCorrection;

    public $data = [
        'id' => 190695,
        'text' => 'This string has been corrected',
        'pluralCategoryName' => 'few',
        'user' => [
            'id' => 19,
            'username' => 'john_doe',
            'fullName' => 'John Smith',
            'avatarUrl' => ''
        ],
        'createdAt' => '2019-09-23T11:26:54+00:00'
    ];

    public function testLoadData()
    {
        $this->stringCorrection = new StringCorrection($this->data);
        $this->checkData();
    }

    public function testSetData()
    {
        $this->stringCorrection = new StringCorrection();
        $this->stringCorrection->setText($this->data['text']);
        $this->stringCorrection->setPluralCategoryName($this->data['pluralCategoryName']);
        $this->stringCorrection->setUser($this->data['user']);

        $this->assertEquals($this->data['text'], $this->stringCorrection->getText());
        $this->assertEquals($this->data['pluralCategoryName'], $this->stringCorrection->getPluralCategoryName());
        $this->assertEquals($this->data['user'], $this->stringCorrection->getUser());
    }

    public function checkData()
    {
        $this->assertEquals($this->data['id'], $this->stringCorrection->getId());
        $this->assertEquals($this->data['text'], $this->stringCorrection->getText());
        $this->assertEquals($this->data['pluralCategoryName'], $this->stringCorrection->getPluralCategoryName());
        $this->assertEquals($this->data['createdAt'], $this->stringCorrection->getCreatedAt());

        $this->assertEquals($this->data['user'], $this->stringCorrection->getUser());
        $this->assertEquals($this->data['user']['id'], $this->stringCorrection->getUser()['id']);
        $this->assertEquals($this->data['user']['username'], $this->stringCorrection->getUser()['username']);
        $this->assertEquals($this->data['user']['fullName'], $this->stringCorrection->getUser()['fullName']);
        $this->assertEquals($this->data['user']['avatarUrl'], $this->stringCorrection->getUser()['avatarUrl']);
    }
}
