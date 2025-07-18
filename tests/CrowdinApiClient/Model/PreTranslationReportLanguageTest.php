<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\PreTranslationReportLanguage;
use PHPUnit\Framework\TestCase;

class PreTranslationReportLanguageTest extends TestCase
{
    public $data = [
        'id' => 'es',
        'files' => [
            [
                'id' => '10191',
                'statistics' => [
                    'phrases' => 6,
                    'words' => 13,
                ],
            ],
        ],
        'skipped' => [
            'translation_eq_source' => 2,
            'qa_check' => 1,
            'hidden_strings' => 0,
            'ai_error' => 6,
        ],
        'skippedQaCheckCategories' => [
            'duplicate' => 1,
            'spellcheck' => 1,
        ],
    ];

    public function testLoadData(): void
    {
        $preTranslationReportLanguage = new PreTranslationReportLanguage($this->data);

        $this->assertEquals($this->data['id'], $preTranslationReportLanguage->getId());
        $this->assertEquals(
            $this->data['files'][0]['id'],
            $preTranslationReportLanguage->getFiles()[0]->getId()
        );
        $this->assertEquals(
            $this->data['files'][0]['statistics']['phrases'],
            $preTranslationReportLanguage->getFiles()[0]->getStatistics()->getPhrases()
        );
        $this->assertEquals(
            $this->data['files'][0]['statistics']['words'],
            $preTranslationReportLanguage->getFiles()[0]->getStatistics()->getWords()
        );
        $this->assertEquals(
            $this->data['skipped']['translation_eq_source'],
            $preTranslationReportLanguage->getSkippedInfo()['translation_eq_source']
        );
        $this->assertEquals(
            $this->data['skipped']['qa_check'],
            $preTranslationReportLanguage->getSkippedInfo()['qa_check']
        );
        $this->assertEquals(
            $this->data['skipped']['hidden_strings'],
            $preTranslationReportLanguage->getSkippedInfo()['hidden_strings']
        );
        $this->assertEquals(
            $this->data['skipped']['ai_error'],
            $preTranslationReportLanguage->getSkippedInfo()['ai_error']
        );
        $this->assertEquals(
            $this->data['skippedQaCheckCategories'],
            $preTranslationReportLanguage->getSkippedQaCheckCategories()
        );
    }
}
