<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\Alignment;
use CrowdinApiClient\Model\WordAlignment;
use PHPUnit\Framework\TestCase;

class WordAlignmentTest extends TestCase
{
    /**
     * @var WordAlignment
     */
    public $wordAlignment;

    /**
     * @var array
     */
    public $data = [
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
    ];

    public function testLoadData(): void
    {
        $this->wordAlignment = new WordAlignment($this->data);
        $this->checkData();
    }

    public function checkData(): void
    {
        $this->assertEquals($this->data['text'], $this->wordAlignment->getText());
        $this->assertIsArray($this->wordAlignment->getAlignments());
        $this->assertCount(count($this->data['alignments']), $this->wordAlignment->getAlignments());
        $this->assertContainsOnlyInstancesOf(
            Alignment::class,
            $this->wordAlignment->getAlignments()
        );
    }
}
