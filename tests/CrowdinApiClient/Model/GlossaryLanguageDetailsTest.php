<?php

namespace CrowdinApiClient\Model;

use PHPUnit\Framework\TestCase;

class GlossaryLanguageDetailsTest extends TestCase
{
    /**
     * @var GlossaryLanguageDetails
     */
    public $glossaryLanguageDetails;

    /**
     * @var array
     */
    public $data = [
        'languageId' => 'en',
        'userId' => 2,
        'definition' => 'Definition',
        'note' => 'Note',
        'createdAt' => '2019-09-16T13:42:04+00:00',
        'updatedAt' => '2025-09-27T18:21:58+00:00',
    ];

    public function testLoadData(): void
    {
        $this->glossaryLanguageDetails = new GlossaryLanguageDetails($this->data);
        $this->checkData();
    }

    public function testSetData(): void
    {
        $this->glossaryLanguageDetails = new GlossaryLanguageDetails([]);
        $this->glossaryLanguageDetails->setLanguageId($this->data['languageId']);
        $this->glossaryLanguageDetails->setDefinition($this->data['definition']);
        $this->glossaryLanguageDetails->setNote($this->data['note']);

        $this->assertEquals($this->data['languageId'], $this->glossaryLanguageDetails->getLanguageId());
        $this->assertEquals($this->data['definition'], $this->glossaryLanguageDetails->getDefinition());
        $this->assertEquals($this->data['note'], $this->glossaryLanguageDetails->getNote());
    }

    public function checkData(): void
    {
        $this->assertEquals($this->data['languageId'], $this->glossaryLanguageDetails->getLanguageId());
        $this->assertEquals($this->data['userId'], $this->glossaryLanguageDetails->getUserId());
        $this->assertEquals($this->data['definition'], $this->glossaryLanguageDetails->getDefinition());
        $this->assertEquals($this->data['note'], $this->glossaryLanguageDetails->getNote());
        $this->assertEquals($this->data['createdAt'], $this->glossaryLanguageDetails->getCreatedAt());
        $this->assertEquals($this->data['updatedAt'], $this->glossaryLanguageDetails->getUpdatedAt());
    }
}
