<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\Alignment;
use PHPUnit\Framework\TestCase;

class AlignmentTest extends TestCase
{
    /**
     * @var Alignment
     */
    public $alignment;

    /**
     * @var array
     */
    public $data = [
        'sourceWord' => 'Password',
        'sourceLemma' => 'password',
        'targetWord' => 'Пароль',
        'targetLemma' => 'пароль',
        'match' => 2,
        'probability' => 2.0,
    ];

    public function testLoadData(): void
    {
        $this->alignment = new Alignment($this->data);
        $this->checkData();
    }

    public function checkData(): void
    {
        $this->assertEquals($this->data['sourceWord'], $this->alignment->getSourceWord());
        $this->assertEquals($this->data['sourceLemma'], $this->alignment->getSourceLemma());
        $this->assertEquals($this->data['targetWord'], $this->alignment->getTargetWord());
        $this->assertEquals($this->data['targetLemma'], $this->alignment->getTargetLemma());
        $this->assertEquals($this->data['match'], $this->alignment->getMatch());
        $this->assertEquals($this->data['probability'], $this->alignment->getProbability());
    }
}
