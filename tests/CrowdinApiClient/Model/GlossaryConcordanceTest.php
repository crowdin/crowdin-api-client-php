<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\GlossaryConcordance;
use CrowdinApiClient\Model\Term;
use PHPUnit\Framework\TestCase;

class GlossaryConcordanceTest extends TestCase
{
    /**
     * @var GlossaryConcordance
     */
    public $glossaryConcordance;

    /**
     * @var array
     */
    public $data = [
        'glossary' => [
            'id' => 2,
            'name' => 'Glossary name',
        ],
        'concept' => [
            'id' => 3,
            'subject' => 'general',
            'definition' => 'Definition',
            'translatable' => true,
            'note' => 'Note',
            'url' => 'URL',
            'figure' => 'Figure',
        ],
        'sourceTerms' => [
            [
                'id' => 1,
                'userId' => 5,
                'glossaryId' => 5,
                'languageId' => 'en',
                'text' => 'See',
                'description' => 'use for pages only (check screenshots)',
                'partOfSpeech' => 'VERB',
                'status' => 'preferred',
                'type' => 'abbreviation',
                'gender' => 'masculine',
                'note' => 'Any kind of note, such as a usage note, explanation, or instruction',
                'url' => 'URL',
                'conceptId' => 8,
                'lemma' => 'see',
                'createdAt' => '2019-09-23T07:19:47+00:00',
                'updatedAt' => '2019-09-23T07:19:47+00:00',
            ]
        ],
        'targetTerms' => [
            [
                'id' => 2,
                'userId' => 6,
                'glossaryId' => 6,
                'languageId' => 'fr',
                'text' => 'Voir',
                'description' => 'use for pages only (check screenshots)',
                'partOfSpeech' => 'VERB',
                'status' => 'preferred',
                'type' => 'abbreviation',
                'gender' => 'masculine',
                'note' => 'Any kind of note, such as a usage note, explanation, or instruction',
                'url' => 'URL',
                'conceptId' => 8,
                'lemma' => 'voir',
                'createdAt' => '2019-09-23T07:19:47+00:00',
                'updatedAt' => '2019-09-23T07:19:47+00:00',
            ]
        ],
    ];

    public function testLoadData(): void
    {
        $this->glossaryConcordance = new GlossaryConcordance($this->data);
        $this->checkData();
    }

    public function checkData(): void
    {
        $this->assertEquals($this->data['glossary'], $this->glossaryConcordance->getGlossary());
        $this->assertEquals($this->data['concept'], $this->glossaryConcordance->getConcept());

        $this->assertIsArray($this->glossaryConcordance->getSourceTerms());
        $this->assertCount(count($this->data['sourceTerms']), $this->glossaryConcordance->getSourceTerms());
        $this->assertContainsOnlyInstancesOf(Term::class, $this->glossaryConcordance->getSourceTerms());

        $this->assertIsArray($this->glossaryConcordance->getTargetTerms());
        $this->assertCount(count($this->data['targetTerms']), $this->glossaryConcordance->getTargetTerms());
        $this->assertContainsOnlyInstancesOf(Term::class, $this->glossaryConcordance->getTargetTerms());
    }
}
