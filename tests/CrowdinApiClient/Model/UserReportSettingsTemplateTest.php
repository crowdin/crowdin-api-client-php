<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\ReportSettingsTemplateConfig;
use CrowdinApiClient\Model\UserReportSettingsTemplate;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class UserReportSettingsTemplateTest extends TestCase
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
            'calculateInternalMatches' => true,
            'includePreTranslatedStrings' => true,
            'excludeApprovalsForEditedTranslations' => true,
            'preTranslatedStringsCategorizationAdjustment' => true,
        ],
        'createdAt' => '2025-01-23T15:23:11+00:00',
        'updatedAt' => '2025-01-23T15:35:49+00:00',
    ];

    public function testLoadData(): void
    {
        $template = new UserReportSettingsTemplate($this->data);

        $this->assertEquals($this->data['id'], $template->getId());
        $this->assertEquals($this->data['name'], $template->getName());
        $this->assertEquals($this->data['currency'], $template->getCurrency());
        $this->assertEquals($this->data['unit'], $template->getUnit());
        $this->assertInstanceOf(ReportSettingsTemplateConfig::class, $template->getConfig());
        $this->assertEquals($this->data['config'], $template->getConfig()->toArray());
        $this->assertEquals($this->data['createdAt'], $template->getCreatedAt());
        $this->assertEquals($this->data['updatedAt'], $template->getUpdatedAt());
    }

    public function testSetData(): void
    {
        $template = new UserReportSettingsTemplate($this->data);

        $config = $template->getConfig();
        $config->setCalculateInternalMatches(false);

        $template->setName('New name');
        $template->setCurrency('GBP');
        $template->setUnit('strings');
        $template->setConfig($config);

        $this->assertEquals('New name', $template->getName());
        $this->assertEquals('GBP', $template->getCurrency());
        $this->assertEquals('strings', $template->getUnit());
        $this->assertFalse($template->getConfig()->getCalculateInternalMatches());
    }

    public function testSetInvalidCurrency(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $template = new UserReportSettingsTemplate($this->data);
        $template->setCurrency('INVALID');
    }

    public function testSetInvalidUnit(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $template = new UserReportSettingsTemplate($this->data);
        $template->setUnit('INVALID');
    }

    public function testToArray(): void
    {
        $this->assertEquals($this->data, (new UserReportSettingsTemplate($this->data))->toArray());
    }
}
