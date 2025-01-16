<?php

declare(strict_types=1);

namespace CrowdinApiClient\Model;

use PHPUnit\Framework\TestCase;

class GlossaryConceptTest extends TestCase
{
    /**
     * @var GlossaryConcept
     */
    public $glossaryConcept;

    /**
     * @var array
     */
    public $data = [
        'id' => 1,
        'userId' => 2,
        'glossaryId' => 3,
        'subject' => 'Subject',
        'definition' => 'Definition',
        'translatable' => true,
        'note' => 'Note',
        'url' => 'URL',
        'figure' => 'Figure',
        'languagesDetails' => [
            [
                'languageId' => 'en',
                'userId' => 12,
                'definition' => 'Language definition',
                'note' => 'Language note',
                'createdAt' => '2019-09-19T14:14:00+00:00',
                'updatedAt' => '2019-09-19T14:14:00+00:00',
            ],
        ],
        'createdAt' => '2019-09-16T13:42:04+00:00',
        'updatedAt' => '2019-09-16T13:42:04+00:00',
    ];

    public function testLoadData(): void
    {
        $this->glossaryConcept = new GlossaryConcept($this->data);
        $this->checkData();
    }

    public function testSetData(): void
    {
        $this->glossaryConcept = new GlossaryConcept([]);
        $this->glossaryConcept->setSubject($this->data['subject']);
        $this->glossaryConcept->setDefinition($this->data['definition']);
        $this->glossaryConcept->setTranslatable($this->data['translatable']);
        $this->glossaryConcept->setNote($this->data['note']);
        $this->glossaryConcept->setUrl($this->data['url']);
        $this->glossaryConcept->setFigure($this->data['figure']);
        $this->glossaryConcept->setLanguagesDetails([new GlossaryLanguageDetails($this->data['languagesDetails'])]);

        $this->assertEquals($this->data['subject'], $this->glossaryConcept->getSubject());
        $this->assertEquals($this->data['definition'], $this->glossaryConcept->getDefinition());
        $this->assertEquals($this->data['translatable'], $this->glossaryConcept->getTranslatable());
        $this->assertEquals($this->data['note'], $this->glossaryConcept->getNote());
        $this->assertEquals($this->data['url'], $this->glossaryConcept->getUrl());
        $this->assertEquals($this->data['figure'], $this->glossaryConcept->getFigure());

        $this->assertIsArray($this->glossaryConcept->getLanguagesDetails());
        $this->assertCount(count($this->data['languagesDetails']), $this->glossaryConcept->getLanguagesDetails());
        $this->assertContainsOnlyInstancesOf(
            GlossaryLanguageDetails::class,
            $this->glossaryConcept->getLanguagesDetails()
        );
    }

    public function checkData(): void
    {
        $this->assertEquals($this->data['id'], $this->glossaryConcept->getId());
        $this->assertEquals($this->data['userId'], $this->glossaryConcept->getUserId());
        $this->assertEquals($this->data['glossaryId'], $this->glossaryConcept->getGlossaryId());
        $this->assertEquals($this->data['subject'], $this->glossaryConcept->getSubject());
        $this->assertEquals($this->data['definition'], $this->glossaryConcept->getDefinition());
        $this->assertEquals($this->data['translatable'], $this->glossaryConcept->getTranslatable());
        $this->assertEquals($this->data['note'], $this->glossaryConcept->getNote());
        $this->assertEquals($this->data['url'], $this->glossaryConcept->getUrl());
        $this->assertEquals($this->data['figure'], $this->glossaryConcept->getFigure());
        $this->assertIsArray($this->glossaryConcept->getLanguagesDetails());
        $this->assertCount(count($this->data['languagesDetails']), $this->glossaryConcept->getLanguagesDetails());
        $this->assertContainsOnlyInstancesOf(
            GlossaryLanguageDetails::class,
            $this->glossaryConcept->getLanguagesDetails()
        );
        $this->assertEquals($this->data['createdAt'], $this->glossaryConcept->getCreatedAt());
        $this->assertEquals($this->data['updatedAt'], $this->glossaryConcept->getUpdatedAt());
    }
}
