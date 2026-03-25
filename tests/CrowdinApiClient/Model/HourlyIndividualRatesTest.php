<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\HourlyIndividualRates;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class HourlyIndividualRatesTest extends TestCase
{
    public $data = [
        'languageIds' => ['en', 'uk', 'de'],
        'userIds' => [1, 2, 3],
        'hourly' => 0.1,
    ];

    public function testLoadData(): void
    {
        $individualRates = new HourlyIndividualRates($this->data);
        $this->assertEquals($this->data['languageIds'], $individualRates->getLanguageIds());
        $this->assertEquals($this->data['userIds'], $individualRates->getUserIds());
        $this->assertEquals($this->data['hourly'], $individualRates->getHourly());
    }

    public function testSetData(): void
    {
        $languageIds = ['en', 'uk', 'de', 'fr'];
        $userIds = [8];
        $hourly = 0.2;

        $individualRates = new HourlyIndividualRates($this->data);
        $individualRates->setLanguageIds($languageIds);
        $individualRates->setUserIds($userIds);
        $individualRates->setHourly($hourly);

        $this->assertEquals($languageIds, $individualRates->getLanguageIds());
        $this->assertEquals($userIds, $individualRates->getUserIds());
        $this->assertEquals($hourly, $individualRates->getHourly());
    }

    public function testToArray(): void
    {
        $individualRates = new HourlyIndividualRates($this->data);
        $result = $individualRates->toArray();

        $this->assertArrayHasKey('languageIds', $result);
        $this->assertArrayHasKey('userIds', $result);
        $this->assertArrayHasKey('hourly', $result);
        $this->assertEquals($this->data['languageIds'], $result['languageIds']);
        $this->assertEquals($this->data['userIds'], $result['userIds']);
        $this->assertEquals($this->data['hourly'], $result['hourly']);
    }

    public function languageIdsExceptionDataProvider(): array
    {
        return [
            'empty' => [
                'languageIds' => [],
                'exceptionMessage' => 'Argument "languageIds" cannot be empty',
            ],
            'invalidType' => [
                'languageIds' => [1, 2, 3],
                'exceptionMessage' => 'Argument "languageIds" must be an array of strings',
            ],
        ];
    }

    /**
     * @dataProvider languageIdsExceptionDataProvider
     */
    public function testSetLanguageIdsException(array $languageIds, string $exceptionMessage): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage($exceptionMessage);

        $individualRates = new HourlyIndividualRates();
        $individualRates->setLanguageIds($languageIds);
    }

    public function userIdsExceptionDataProvider(): array
    {
        return [
            'empty' => [
                'userIds' => [],
                'exceptionMessage' => 'Argument "userIds" cannot be empty',
            ],
            'invalidType' => [
                'userIds' => ['123'],
                'exceptionMessage' => 'Argument "userIds" must be an array of integers',
            ]
        ];
    }

    /**
     * @dataProvider userIdsExceptionDataProvider
     */
    public function testSetUserIdsException(array $userIds, string $exceptionMessage): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage($exceptionMessage);

        $individualRates = new HourlyIndividualRates();
        $individualRates->setUserIds($userIds);
    }
}
