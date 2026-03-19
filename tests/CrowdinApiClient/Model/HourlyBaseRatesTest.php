<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\HourlyBaseRates;
use PHPUnit\Framework\TestCase;

class HourlyBaseRatesTest extends TestCase
{
    public $data = [
        'hourly' => 0.1,
    ];

    public function testLoadData(): void
    {
        $hourlyBaseRates = new HourlyBaseRates($this->data);
        $this->assertEquals($this->data['hourly'], $hourlyBaseRates->getHourly());
    }

    public function testSetData(): void
    {
        $hourlyBaseRates = new HourlyBaseRates($this->data);
        $hourlyBaseRates->setHourly(0.2);

        $this->assertEquals(0.2, $hourlyBaseRates->getHourly());
    }

    public function testToArray(): void
    {
        $hourlyBaseRates = new HourlyBaseRates($this->data);
        $this->assertEquals($this->data, $hourlyBaseRates->toArray());
    }
}
