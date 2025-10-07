<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\TranslationMemory;
use CrowdinApiClient\Model\TranslationMemoryConcordance;
use PHPUnit\Framework\TestCase;

class TranslationMemoryConcordanceTest extends TestCase
{
    /**
     * @var TranslationMemoryConcordance
     */
    public $translationMemoryConcordance;

    /**
     * @var array
     */
    public $data = [
        'tm' => [
            'id' => 4,
            'name' => 'Knowledge Base TM',
        ],
        'recordId' => 34,
        'source' => 'Welcome!',
        'target' => 'Ласкаво просимо!',
        'relevant' => 100,
        'substituted' => '62→100',
        'updatedAt' => '2022-09-28T12:29:34+00:00',
    ];

    public function testLoadData(): void
    {
        $this->translationMemoryConcordance = new TranslationMemoryConcordance($this->data);
        $this->checkData();
    }

    public function checkData(): void
    {
        $this->assertInstanceOf(TranslationMemory::class, $this->translationMemoryConcordance->getTm());
        $this->assertEquals($this->data['tm']['id'], $this->translationMemoryConcordance->getTm()->getId());
        $this->assertEquals($this->data['tm']['name'], $this->translationMemoryConcordance->getTm()->getName());
        $this->assertEquals($this->data['recordId'], $this->translationMemoryConcordance->getRecordId());
        $this->assertEquals($this->data['source'], $this->translationMemoryConcordance->getSource());
        $this->assertEquals($this->data['target'], $this->translationMemoryConcordance->getTarget());
        $this->assertEquals($this->data['relevant'], $this->translationMemoryConcordance->getRelevant());
        $this->assertEquals($this->data['substituted'], $this->translationMemoryConcordance->getSubstituted());
        $this->assertEquals($this->data['updatedAt'], $this->translationMemoryConcordance->getUpdatedAt());
    }
}
