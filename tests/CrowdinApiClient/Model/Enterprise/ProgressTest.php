<?php

namespace CrowdinApiClient\Tests\Model\Enterprise;

use CrowdinApiClient\Model\Enterprise\Progress;
use PHPUnit\Framework\TestCase;

/**
 * Class ProgressTest
 * @package Crowdin\Tests\Model
 */
class ProgressTest extends TestCase
{
    public $progress;

    public $data = [
        'languageId' => 'af',
        'phrasesCount' => 3041,
        'phrasesTranslatedCount' => 2631,
        'phrasesApprovedCount' => 2622,
        'phrasesTranslatedProgress' => 86,
        'phrasesApprovedProgress' => 86,
    ];

    public function testLoadData()
    {
        $this->progress = new Progress($this->data);
        $this->checkData();
    }

    public function testSetData()
    {
        $this->progress = new Progress();
        $this->progress->setLanguageId($this->data['languageId']);
        $this->progress->setPhrasesCount($this->data['phrasesCount']);
        $this->progress->setPhrasesApprovedCount($this->data['phrasesApprovedCount']);
        $this->progress->setPhrasesTranslatedCount($this->data['phrasesTranslatedCount']);
        $this->progress->setPhrasesTranslatedProgress($this->data['phrasesTranslatedProgress']);
        $this->progress->setPhrasesApprovedProgress($this->data['phrasesApprovedProgress']);
        $this->checkData();
    }

    public function checkData()
    {
        $this->assertEquals($this->data['languageId'], $this->progress->getLanguageId());
        $this->assertEquals($this->data['phrasesCount'], $this->progress->getPhrasesCount());
        $this->assertEquals($this->data['phrasesTranslatedCount'], $this->progress->getPhrasesTranslatedCount());
        $this->assertEquals($this->data['phrasesApprovedCount'], $this->progress->getPhrasesApprovedCount());
        $this->assertEquals($this->data['phrasesTranslatedProgress'], $this->progress->getPhrasesTranslatedProgress());
        $this->assertEquals($this->data['phrasesApprovedProgress'], $this->progress->getPhrasesApprovedProgress());
    }
}
