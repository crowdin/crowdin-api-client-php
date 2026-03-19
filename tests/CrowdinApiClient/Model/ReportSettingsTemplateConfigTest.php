<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\BaseRates;
use CrowdinApiClient\Model\IndividualRates;
use CrowdinApiClient\Model\NetRateSchemes;
use CrowdinApiClient\Model\ReportSettingsTemplateConfig;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class ReportSettingsTemplateConfigTest extends TestCase
{
    public $data = [
        'baseRates' => [
            'fullTranslation' => 0.1,
            'proofread' => 0.12,
        ],
        'individualRates' => [
            [
                'languageIds' => ['uk'],
                'userIds' => [8],
                'fullTranslation' => 0.1,
                'proofread' => 0.12,
            ],
        ],
        'netRateSchemes' => [
            'tmMatch' => [
                [
                    'matchType' => 'perfect',
                    'price' => 0.1,
                ],
                [
                    'matchType' => '100',
                    'price' => 0.2,
                ],
            ],
            'mtMatch' => [
                [
                    'matchType' => '100',
                    'price' => 0.1,
                ],
            ],
            'aiMatch' => [
                [
                    'matchType' => '100',
                    'price' => 0.1,
                ],
            ],
            'suggestionMatch' => [
                [
                    'matchType' => '100',
                    'price' => 0.1,
                ],
            ],
        ],
        'calculateInternalMatches' => true,
        'includePreTranslatedStrings' => false,
        'excludeApprovalsForEditedTranslations' => true,
        'preTranslatedStringsCategorizationAdjustment' => false,
    ];

    public function testLoadData(): void
    {
        $reportSettingsTemplateConfig = new ReportSettingsTemplateConfig($this->data);
        $this->assertEquals(
            $this->data['baseRates'],
            $reportSettingsTemplateConfig->getBaseRates()->toArray()
        );
        $this->assertEquals(
            $this->data['individualRates'],
            array_map(static function (IndividualRates $individualRates): array {
                return $individualRates->toArray();
            }, $reportSettingsTemplateConfig->getIndividualRates())
        );
        $this->assertEquals(
            $this->data['netRateSchemes'],
            $reportSettingsTemplateConfig->getNetRateSchemes()->toArray()
        );
        $this->assertEquals(
            $this->data['calculateInternalMatches'],
            $reportSettingsTemplateConfig->getCalculateInternalMatches()
        );
        $this->assertEquals(
            $this->data['includePreTranslatedStrings'],
            $reportSettingsTemplateConfig->getIncludePreTranslatedStrings()
        );
        $this->assertEquals(
            $this->data['excludeApprovalsForEditedTranslations'],
            $reportSettingsTemplateConfig->getExcludeApprovalsForEditedTranslations()
        );
        $this->assertEquals(
            $this->data['preTranslatedStringsCategorizationAdjustment'],
            $reportSettingsTemplateConfig->getPreTranslatedStringsCategorizationAdjustment()
        );
    }

    /**
     * @depends testLoadData
     */
    public function testSetData(): void
    {
        $reportSettingsTemplateConfig = new ReportSettingsTemplateConfig();
        $reportSettingsTemplateConfig->setBaseRates(new BaseRates($this->data['baseRates']));
        $reportSettingsTemplateConfig->setIndividualRates(
            array_map(static function (array $individualRates): IndividualRates {
                return new IndividualRates($individualRates);
            }, $this->data['individualRates'])
        );
        $reportSettingsTemplateConfig->setNetRateSchemes(new NetRateSchemes($this->data['netRateSchemes']));
        $reportSettingsTemplateConfig->setCalculateInternalMatches($this->data['calculateInternalMatches']);
        $reportSettingsTemplateConfig->setIncludePreTranslatedStrings($this->data['includePreTranslatedStrings']);
        $reportSettingsTemplateConfig->setExcludeApprovalsForEditedTranslations(
            $this->data['excludeApprovalsForEditedTranslations']
        );
        $reportSettingsTemplateConfig->setPreTranslatedStringsCategorizationAdjustment(
            $this->data['preTranslatedStringsCategorizationAdjustment']
        );

        $this->assertEquals(
            $this->data['baseRates'],
            $reportSettingsTemplateConfig->getBaseRates()->toArray()
        );
        $this->assertEquals(
            $this->data['individualRates'],
            array_map(static function (IndividualRates $individualRates): array {
                return $individualRates->toArray();
            }, $reportSettingsTemplateConfig->getIndividualRates())
        );
        $this->assertEquals(
            $this->data['netRateSchemes'],
            $reportSettingsTemplateConfig->getNetRateSchemes()->toArray()
        );
        $this->assertEquals(
            $this->data['calculateInternalMatches'],
            $reportSettingsTemplateConfig->getCalculateInternalMatches()
        );
        $this->assertEquals(
            $this->data['includePreTranslatedStrings'],
            $reportSettingsTemplateConfig->getIncludePreTranslatedStrings()
        );
        $this->assertEquals(
            $this->data['excludeApprovalsForEditedTranslations'],
            $reportSettingsTemplateConfig->getExcludeApprovalsForEditedTranslations()
        );
        $this->assertEquals(
            $this->data['preTranslatedStringsCategorizationAdjustment'],
            $reportSettingsTemplateConfig->getPreTranslatedStringsCategorizationAdjustment()
        );
    }

    public function exceptionDataProvider(): array
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
                'exceptionMessage' => 'Argument "individualRates" must contain only IndividualRates objects',
            ],
        ];
    }

    /**
     * @dataProvider exceptionDataProvider
     */
    public function testSetIndividualRatesException(array $individualRates, string $exceptionMessage): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage($exceptionMessage);

        (new ReportSettingsTemplateConfig())->setIndividualRates($individualRates);
    }

    public function testToArray(): void
    {
        $this->assertSame($this->data, (new ReportSettingsTemplateConfig($this->data))->toArray());
    }
}
