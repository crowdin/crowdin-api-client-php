<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\HourlyBaseRates;
use CrowdinApiClient\Model\HourlyReportSettingsTemplateConfig;
use CrowdinApiClient\Model\HourlyUserReportSettingsTemplate;
use CrowdinApiClient\Model\Report;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class HourlyUserReportSettingsTemplateTest extends TestCase
{
    public $data = [
        'id' => 12,
        'name' => 'Hourly template',
        'currency' => 'USD',
        'unit' => 'hours',
        'config' => [
            'baseRates' => [
                'hourly' => 50.0,
            ],
            'individualRates' => [
                [
                    'languageIds' => ['uk'],
                    'userIds' => [8],
                    'hourly' => 75.0,
                ],
            ],
        ],
        'createdAt' => '2025-01-23T15:23:11+00:00',
        'updatedAt' => '2025-01-23T15:35:49+00:00',
    ];

    public function testLoadData(): void
    {
        $template = new HourlyUserReportSettingsTemplate($this->data);

        $this->assertEquals($this->data['id'], $template->getId());
        $this->assertEquals($this->data['name'], $template->getName());
        $this->assertEquals($this->data['currency'], $template->getCurrency());
        $this->assertEquals($this->data['unit'], $template->getUnit());
        $this->assertInstanceOf(HourlyReportSettingsTemplateConfig::class, $template->getConfig());
        $this->assertEquals(
            $this->data['config']['baseRates']['hourly'],
            $template->getConfig()->getBaseRates()->getHourly()
        );
        $this->assertEquals($this->data['createdAt'], $template->getCreatedAt());
        $this->assertEquals($this->data['updatedAt'], $template->getUpdatedAt());
    }

    public function testSetData(): void
    {
        $template = new HourlyUserReportSettingsTemplate($this->data);

        $name = 'New name';
        $currency = 'UAH';
        $unit = 'hours';
        $hourly = 100.0;

        $config = $template->getConfig();
        $config->setBaseRates(new HourlyBaseRates(['hourly' => $hourly]));

        $template->setName($name);
        $template->setCurrency($currency);
        $template->setUnit($unit);
        $template->setConfig($config);

        $this->assertEquals($name, $template->getName());
        $this->assertEquals($currency, $template->getCurrency());
        $this->assertEquals($unit, $template->getUnit());
        $this->assertEquals($hourly, $template->getConfig()->getBaseRates()->getHourly());
    }

    public function testSetInvalidCurrency(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $template = new HourlyUserReportSettingsTemplate($this->data);
        $template->setCurrency('INVALID');
    }

    public function testSetInvalidUnit(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $template = new HourlyUserReportSettingsTemplate($this->data);
        $template->setUnit(Report::UNIT_WORDS);
    }

    public function testToArray(): void
    {
        $this->assertEquals($this->data, (new HourlyUserReportSettingsTemplate($this->data))->toArray());
    }
}
