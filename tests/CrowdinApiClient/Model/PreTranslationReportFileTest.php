<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\PreTranslationReportFile;
use PHPUnit\Framework\TestCase;

class PreTranslationReportFileTest extends TestCase
{
    public $data = [
        'id' => '10191',
        'statistics' => [
            'phrases' => 6,
            'words' => 13,
        ],
    ];

    public function testLoadData(): void
    {
        $preTranslationReportFile = new PreTranslationReportFile($this->data);

        $this->assertEquals(
            $this->data['id'],
            $preTranslationReportFile->getId()
        );
        $this->assertEquals(
            $this->data['statistics']['phrases'],
            $preTranslationReportFile->getStatistics()->getPhrases()
        );
        $this->assertEquals(
            $this->data['statistics']['words'],
            $preTranslationReportFile->getStatistics()->getWords()
        );
    }
}
