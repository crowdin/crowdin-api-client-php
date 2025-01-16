<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\ProgressFile;
use PHPUnit\Framework\TestCase;

class ProgressFileTest extends TestCase
{
    /**
     * @var ProgressFile
     */
    public $progress;

    public $data = [
        'languageId' => 'es',
        'language' => [
            'id' => 'es',
            'name' => 'Spanish',
            'editorCode' => 'es',
            'twoLettersCode' => 'es',
            'threeLettersCode' => 'spa',
            'locale' => 'es-ES',
            'androidCode' => 'es-rES',
            'osxCode' => 'es.lproj',
            'osxLocale' => 'es',
            'pluralCategoryNames' => ['one'],
            'pluralRules' => '(n != 1)',
            'pluralExamples' => ['0, 2-999; 1.2, 2.07...'],
            'textDirection' => 'ltr',
            'dialectOf' => 'es',
        ],
        'words' => [
            'total' => 7249,
            'translated' => 3651,
            'approved' => 3637,
        ],
        'phrases' => [
            'total' => 3041,
            'translated' => 2631,
            'approved' => 2622,
        ],
        'translationProgress' => 86,
        'approvalProgress' => 86,
        'eTag' => 'fd0ea167420ef1687fd16635b9fb67a3',
    ];

    public function testLoadData(): void
    {
        $this->progress = new ProgressFile($this->data);
        $this->checkData();
    }

    public function checkData(): void
    {
        $this->assertEquals($this->data['languageId'], $this->progress->getLanguageId());
        $this->assertEquals($this->data['language']['id'], $this->progress->getLanguage()->getId());
        $this->assertEquals($this->data['words'], $this->progress->getWords());
        $this->assertEquals($this->data['phrases'], $this->progress->getPhrases());
        $this->assertEquals($this->data['translationProgress'], $this->progress->getTranslationProgress());
        $this->assertEquals($this->data['approvalProgress'], $this->progress->getApprovalProgress());
        $this->assertEquals($this->data['eTag'], $this->progress->getEtag());
    }
}
