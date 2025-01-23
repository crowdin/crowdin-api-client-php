<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\NetRate;
use PHPUnit\Framework\TestCase;

class NetRateTest extends TestCase
{
    public $data = [
        'matchType' => 'perfect',
        'price' => 0.1,
    ];

    /**
     * @var NetRate
     */
    public $netRate;

    public function testLoadData(): void
    {
        $this->netRate = new NetRate($this->data);
        $this->checkData();
    }

    /**
     * @depends testLoadData
     */
    public function testSetData(): void
    {
        $this->netRate = new NetRate();
        $this->netRate->setMatchType($this->data['matchType']);
        $this->netRate->setPrice($this->data['price']);

        $this->assertEquals($this->data['matchType'], $this->netRate->getMatchType());
        $this->assertEquals($this->data['price'], $this->netRate->getPrice());
    }

    public function checkData(): void
    {
        $this->assertEquals($this->data['matchType'], $this->netRate->getMatchType());
        $this->assertEquals($this->data['price'], $this->netRate->getPrice());
    }

    public function testToArray(): void
    {
        $this->assertSame($this->data, (new NetRate($this->data))->toArray());
    }
}
