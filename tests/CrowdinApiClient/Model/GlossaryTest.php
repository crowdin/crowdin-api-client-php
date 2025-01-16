<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\Glossary;
use PHPUnit\Framework\TestCase;

class GlossaryTest extends TestCase
{
    /**
     * @var Glossary
     */
    public $glossary;

    /**
     * @var array
     */
    public $data = [
        'id' => 2,
        'name' => 'Be My Eyes iOS\'s Glossary',
        'groupId' => 2,
        'userId' => 2,
        'terms' => 25,
        'languageId' => 'fr',
        'languageIds' => ['ro'],
        'defaultProjectIds' => [2],
        'projectIds' => [6],
        'webUrl' => 'https://crowdin.com/profile/username/resources/glossaries/1',
        'createdAt' => '2019-09-16T13:42:04+00:00',
    ];

    public function testLoadData(): void
    {
        $this->glossary = new Glossary($this->data);
        $this->checkData();
    }

    public function testSetData(): void
    {
        $this->glossary = new Glossary();
        $this->glossary->setName($this->data['name']);

        $this->assertEquals($this->data['name'], $this->glossary->getName());
    }

    public function checkData(): void
    {
        $this->assertEquals($this->data['id'], $this->glossary->getId());
        $this->assertEquals($this->data['name'], $this->glossary->getName());
        $this->assertEquals($this->data['groupId'], $this->glossary->getGroupId());
        $this->assertEquals($this->data['userId'], $this->glossary->getUserId());
        $this->assertEquals($this->data['terms'], $this->glossary->getTerms());
        $this->assertEquals($this->data['languageId'], $this->glossary->getLanguageId());
        $this->assertEquals($this->data['languageIds'], $this->glossary->getLanguageIds());
        $this->assertEquals($this->data['defaultProjectIds'], $this->glossary->getDefaultProjectIds());
        $this->assertEquals($this->data['projectIds'], $this->glossary->getProjectIds());
        $this->assertEquals($this->data['webUrl'], $this->glossary->getWebUrl());
        $this->assertEquals($this->data['createdAt'], $this->glossary->getCreatedAt());
    }
}
