<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\Term;
use PHPUnit\Framework\TestCase;

/**
 * @package Crowdin\Tests\Model
 */
class TermTest extends TestCase
{
    /**
     * @var Term
     */
    public $term;

    /**
     * @var array
     */
    public $data = [
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
    ];

    public function testLoadData(): void
    {
        $this->term = new Term($this->data);
        $this->checkData();
    }

    public function testSetData(): void
    {
        $this->term = new Term();
        $this->term->setText($this->data['text']);
        $this->term->setDescription($this->data['description']);
        $this->term->setPartOfSpeech($this->data['partOfSpeech']);
        $this->term->setStatus($this->data['status']);
        $this->term->setType($this->data['type']);
        $this->term->setGender($this->data['gender']);
        $this->term->setNote($this->data['note']);
        $this->term->setUrl($this->data['url']);

        $this->assertEquals($this->data['text'], $this->term->getText());
        $this->assertEquals($this->data['description'], $this->term->getDescription());
        $this->assertEquals($this->data['partOfSpeech'], $this->term->getPartOfSpeech());
        $this->assertEquals($this->data['status'], $this->term->getStatus());
        $this->assertEquals($this->data['type'], $this->term->getType());
        $this->assertEquals($this->data['gender'], $this->term->getGender());
        $this->assertEquals($this->data['note'], $this->term->getNote());
        $this->assertEquals($this->data['url'], $this->term->getUrl());
    }

    public function checkData(): void
    {
        $this->assertEquals($this->data['id'], $this->term->getId());
        $this->assertEquals($this->data['userId'], $this->term->getUserId());
        $this->assertEquals($this->data['glossaryId'], $this->term->getGlossaryId());
        $this->assertEquals($this->data['languageId'], $this->term->getLanguageId());
        $this->assertEquals($this->data['text'], $this->term->getText());
        $this->assertEquals($this->data['description'], $this->term->getDescription());
        $this->assertEquals($this->data['partOfSpeech'], $this->term->getPartOfSpeech());
        $this->assertEquals($this->data['status'], $this->term->getStatus());
        $this->assertEquals($this->data['type'], $this->term->getType());
        $this->assertEquals($this->data['gender'], $this->term->getGender());
        $this->assertEquals($this->data['note'], $this->term->getNote());
        $this->assertEquals($this->data['url'], $this->term->getUrl());
        $this->assertEquals($this->data['conceptId'], $this->term->getConceptId());
        $this->assertEquals($this->data['lemma'], $this->term->getLemma());
        $this->assertEquals($this->data['createdAt'], $this->term->getCreatedAt());
        $this->assertEquals($this->data['updatedAt'], $this->term->getUpdatedAt());
    }
}
