<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\PreTranslationReportLanguage;
use CrowdinApiClient\Model\TranslationImportReport;
use PHPUnit\Framework\TestCase;

class TranslationImportReportTest extends TestCase
{
    public $data = [
        'languages' => [
            [
                'id' => 'uk',
                'files' => [
                    [
                        'id' => '10191',
                        'statistics' => [
                            'phrases' => 6,
                            'words' => 45,
                        ],
                    ],
                ],
                'skipped' => [
                    'translationEqSource' => 0,
                    'hiddenStrings' => 0,
                    'qaCheck' => 647,
                ],
                'skippedQaCheckCategories' => [
                    'size' => 1,
                    'duplicate' => 648,
                ],
            ],
        ],
    ];

    public function testLoadData(): void
    {
        $report = new TranslationImportReport($this->data);

        $this->assertIsArray($report->getLanguages());
        $this->assertCount(1, $report->getLanguages());
        $this->assertInstanceOf(PreTranslationReportLanguage::class, $report->getLanguages()[0]);
        $this->assertEquals('uk', $report->getLanguages()[0]->getId());
    }
}
