<?php

namespace Crowdin\Tests\Model;

use Crowdin\Model\Progress;
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

    public function setUp()
    {
        parent::setUp();
        $this->progress = new Progress($this->data);
    }

    public function testLoadData()
    {
        $this->assertEquals($this->data['languageId'], $this->progress->getLanguageId());
        $this->assertEquals($this->data['phrasesCount'], $this->progress->getPhrasesCount());
        $this->assertEquals($this->data['phrasesTranslatedCount'], $this->progress->getPhrasesTranslatedCount());
        $this->assertEquals($this->data['phrasesApprovedCount'], $this->progress->getPhrasesApprovedCount());
        $this->assertEquals($this->data['phrasesTranslatedProgress'], $this->progress->getPhrasesTranslatedProgress());
        $this->assertEquals($this->data['phrasesApprovedProgress'], $this->progress->getPhrasesApprovedProgress());
    }
}
