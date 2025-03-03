<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\ReportSettingsTemplate;
use CrowdinApiClient\Model\ReportSettingsTemplateConfig;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class ReportSettingsTemplateTest extends TestCase
{
    public $data = [
        'id' => 12,
        'name' => 'Default template',
        'currency' => 'UAH',
        'unit' => 'words',
        'config' => [
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
        ],
        'isPublic' => true,
        'isGlobal' => true,
        'createdAt' => '2025-01-23T15:23:11+00:00',
        'updatedAt' => '2025-01-23T15:35:49+00:00',
    ];

    /**
     * @var ReportSettingsTemplate
     */
    public $reportSettingsTemplate;

    public function testLoadData(): void
    {
        $this->reportSettingsTemplate = new ReportSettingsTemplate($this->data);
        $this->checkData();
    }

    /**
     * @depends testLoadData
     */
    public function testSetData(): void
    {
        $this->reportSettingsTemplate = new ReportSettingsTemplate();
        $this->reportSettingsTemplate->setName($this->data['name']);
        $this->reportSettingsTemplate->setCurrency($this->data['currency']);
        $this->reportSettingsTemplate->setUnit($this->data['unit']);
        $this->reportSettingsTemplate->setConfig(new ReportSettingsTemplateConfig($this->data['config']));
        $this->reportSettingsTemplate->setIsPublic($this->data['isPublic']);

        $this->assertEquals($this->data['name'], $this->reportSettingsTemplate->getName());
        $this->assertEquals($this->data['currency'], $this->reportSettingsTemplate->getCurrency());
        $this->assertEquals($this->data['unit'], $this->reportSettingsTemplate->getUnit());
        $this->assertEquals($this->data['config'], $this->reportSettingsTemplate->getConfig()->toArray());
        $this->assertEquals($this->data['isPublic'], $this->reportSettingsTemplate->getIsPublic());
    }

    public function checkData(): void
    {
        $this->assertEquals($this->data['id'], $this->reportSettingsTemplate->getId());
        $this->assertEquals($this->data['name'], $this->reportSettingsTemplate->getName());
        $this->assertEquals($this->data['currency'], $this->reportSettingsTemplate->getCurrency());
        $this->assertEquals($this->data['unit'], $this->reportSettingsTemplate->getUnit());
        $this->assertEquals($this->data['config'], $this->reportSettingsTemplate->getConfig()->toArray());
        $this->assertEquals($this->data['isPublic'], $this->reportSettingsTemplate->getIsPublic());
        $this->assertEquals($this->data['isGlobal'], $this->reportSettingsTemplate->getIsGlobal());
        $this->assertEquals($this->data['createdAt'], $this->reportSettingsTemplate->getCreatedAt());
        $this->assertEquals($this->data['updatedAt'], $this->reportSettingsTemplate->getUpdatedAt());
    }

    public function testSetCurrencyException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Argument "currency" must be one of the following values: ');

        (new ReportSettingsTemplate())->setCurrency('invalid');
    }

    public function testSetUnitException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Argument "unit" must be one of the following values: ');

        (new ReportSettingsTemplate())->setUnit('invalid');
    }

    public function testToArray(): void
    {
        $this->assertSame($this->data, (new ReportSettingsTemplate($this->data))->toArray());
    }
}
