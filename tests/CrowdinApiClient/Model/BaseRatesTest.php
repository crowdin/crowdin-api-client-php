<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\BaseRates;
use PHPUnit\Framework\TestCase;

class BaseRatesTest extends TestCase
{
    public $data = [
        'fullTranslation' => 34.0,
        'proofread' => 2.1,
    ];

    /**
     * @var BaseRates
     */
    public $baseRates;

    public function testLoadData(): void
    {
        $this->baseRates = new BaseRates($this->data);
        $this->checkData();
    }

    /**
     * @depends testLoadData
     */
    public function testSetData(): void
    {
        $this->baseRates = new BaseRates();
        $this->baseRates->setFullTranslation($this->data['fullTranslation']);
        $this->baseRates->setProofread($this->data['proofread']);

        $this->assertEquals($this->data['fullTranslation'], $this->baseRates->getFullTranslation());
        $this->assertEquals($this->data['proofread'], $this->baseRates->getProofread());
    }

    public function checkData(): void
    {
        $this->assertEquals($this->data['fullTranslation'], $this->baseRates->getFullTranslation());
        $this->assertEquals($this->data['proofread'], $this->baseRates->getProofread());
    }

    public function testToArray(): void
    {
        $this->assertSame($this->data, (new BaseRates($this->data))->toArray());
    }
}
