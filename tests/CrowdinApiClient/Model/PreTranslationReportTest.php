<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\PreTranslationReport;
use PHPUnit\Framework\TestCase;

class PreTranslationReportTest extends TestCase
{
    public $data = [
        'languages' => [
            [
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
            ],
        ],
        'preTranslateType' => 'ai',
    ];

    public function testLoadData(): void
    {
        $preTranslation = new PreTranslationReport($this->data);

        $this->assertEquals($this->data['preTranslateType'], $preTranslation->getPreTranslationType());
        $this->assertIsArray($preTranslation->getLanguages());
        $this->assertEquals($this->data['languages'][0]['id'], $preTranslation->getLanguages()[0]->getId());
        $this->assertEquals(
            $this->data['languages'][0]['files'][0]['id'],
            $preTranslation->getLanguages()[0]->getFiles()[0]->getId()
        );
        $this->assertEquals(
            $this->data['languages'][0]['files'][0]['statistics']['phrases'],
            $preTranslation->getLanguages()[0]->getFiles()[0]->getStatistics()->getPhrases()
        );
        $this->assertEquals(
            $this->data['languages'][0]['files'][0]['statistics']['words'],
            $preTranslation->getLanguages()[0]->getFiles()[0]->getStatistics()->getWords()
        );
        $this->assertEquals(
            $this->data['languages'][0]['skipped']['translation_eq_source'],
            $preTranslation->getLanguages()[0]->getSkippedInfo()['translation_eq_source']
        );
        $this->assertEquals(
            $this->data['languages'][0]['skipped']['qa_check'],
            $preTranslation->getLanguages()[0]->getSkippedInfo()['qa_check']
        );
        $this->assertEquals(
            $this->data['languages'][0]['skipped']['hidden_strings'],
            $preTranslation->getLanguages()[0]->getSkippedInfo()['hidden_strings']
        );
        $this->assertEquals(
            $this->data['languages'][0]['skipped']['ai_error'],
            $preTranslation->getLanguages()[0]->getSkippedInfo()['ai_error']
        );
        $this->assertEquals(
            $this->data['languages'][0]['skippedQaCheckCategories'],
            $preTranslation->getLanguages()[0]->getSkippedQaCheckCategories()
        );
    }
}
