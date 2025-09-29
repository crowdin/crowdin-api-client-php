<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\TranslationAlignment;
use CrowdinApiClient\Model\WordAlignment;
use PHPUnit\Framework\TestCase;

class TranslationAlignmentTest extends TestCase
{
    /**
     * @var TranslationAlignment
     */
    public $translationAlignment;

    /**
     * @var array
     */
    public $data = [
        'words' => [
            [
                'text' => 'password',
                'alignments' => [
                    [
                        'sourceWord' => 'Password',
                        'sourceLemma' => 'password',
                        'targetWord' => 'Пароль',
                        'targetLemma' => 'пароль',
                        'match' => 2,
                        'probability' => 2.0,
                    ],
                ],
            ],
        ],
    ];

    public function testLoadData(): void
    {
        $this->translationAlignment = new TranslationAlignment($this->data);
        $this->checkData();
    }

    public function checkData(): void
    {
        $this->assertIsArray($this->translationAlignment->getWords());
        $this->assertCount(count($this->data['words']), $this->translationAlignment->getWords());
        $this->assertContainsOnlyInstancesOf(
            WordAlignment::class,
            $this->translationAlignment->getWords()
        );
    }
}
