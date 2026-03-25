<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\HourlyBaseRates;
use CrowdinApiClient\Model\HourlyIndividualRates;
use CrowdinApiClient\Model\HourlyReportSettingsTemplateConfig;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class HourlyReportSettingsTemplateConfigTest extends TestCase
{
    public $data = [
        'baseRates' => [
            'hourly' => 0.1,
        ],
        'individualRates' => [
            [
                'languageIds' => ['uk'],
                'userIds' => [8],
                'hourly' => 0.1,
            ],
        ],
    ];

    public function testLoadData(): void
    {
        $reportSettingsTemplateConfig = new HourlyReportSettingsTemplateConfig($this->data);

        $this->assertEquals(
            $this->data['baseRates'],
            $reportSettingsTemplateConfig->getBaseRates()->toArray()
        );
        $this->assertEquals(
            $this->data['individualRates'],
            array_map(static function (HourlyIndividualRates $individualRates): array {
                return $individualRates->toArray();
            }, $reportSettingsTemplateConfig->getIndividualRates())
        );
    }

    public function testSetData(): void
    {
        $baseRates = new HourlyBaseRates(['hourly' => 0.2]);
        $individualRates = [
            new HourlyIndividualRates([
                'languageIds' => ['uk', 'en', 'jp'],
                'userIds' => [8],
                'hourly' => 0.3,
            ]),
        ];

        $reportSettingsTemplateConfig = new HourlyReportSettingsTemplateConfig($this->data);
        $reportSettingsTemplateConfig->setBaseRates($baseRates);
        $reportSettingsTemplateConfig->setIndividualRates($individualRates);

        $this->assertEquals(
            $baseRates->toArray(),
            $reportSettingsTemplateConfig->getBaseRates()->toArray()
        );
        $this->assertEquals(
            array_map(static function (HourlyIndividualRates $individualRates): array {
                return $individualRates->toArray();
            }, $individualRates),
            array_map(static function (HourlyIndividualRates $individualRates): array {
                return $individualRates->toArray();
            }, $reportSettingsTemplateConfig->getIndividualRates())
        );
    }

    public function individualRatesExceptionDataProvider(): array
    {
        return [
            'empty' => [
                'individualRates' => [],
                'exceptionMessage' => 'Argument "individualRates" cannot be empty',
            ],
            'invalidType' => [
                'individualRates' => [
                    [],
                ],
                'exceptionMessage' => 'Argument "individualRates" must contain only HourlyIndividualRates objects',
            ],
        ];
    }

    /**
     * @dataProvider individualRatesExceptionDataProvider
     */
    public function testSetIndividualRatesException(array $individualRates, string $exceptionMessage): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage($exceptionMessage);

        (new HourlyReportSettingsTemplateConfig($this->data))->setIndividualRates($individualRates);
    }

    public function testToArray(): void
    {
        $this->assertSame($this->data, (new HourlyReportSettingsTemplateConfig($this->data))->toArray());
    }
}
