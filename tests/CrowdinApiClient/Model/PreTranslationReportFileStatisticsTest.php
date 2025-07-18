<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\PreTranslationReportFileStatistics;
use PHPUnit\Framework\TestCase;

class PreTranslationReportFileStatisticsTest extends TestCase
{
    public $data = [
        'phrases' => 6,
        'words' => 13,
    ];

    public function testLoadData(): void
    {
        $preTranslationReportFileStatistics = new PreTranslationReportFileStatistics($this->data);

        $this->assertEquals(
            $this->data['phrases'],
            $preTranslationReportFileStatistics->getPhrases()
        );
        $this->assertEquals(
            $this->data['words'],
            $preTranslationReportFileStatistics->getWords()
        );
    }
}
