<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\IndividualRates;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class IndividualRatesTest extends TestCase
{
    public $data = [
        'languageIds' => ['uk'],
        'userIds' => [8],
        'fullTranslation' => 0.1,
        'proofread' => 0.12,
    ];

    /**
     * @var IndividualRates
     */
    public $individualRates;

    public function testLoadData(): void
    {
        $this->individualRates = new IndividualRates($this->data);
        $this->checkData();
    }

    /**
     * @depends testLoadData
     */
    public function testSetData(): void
    {
        $this->individualRates = new IndividualRates();
        $this->individualRates->setLanguageIds($this->data['languageIds']);
        $this->individualRates->setUserIds($this->data['userIds']);
        $this->individualRates->setFullTranslation($this->data['fullTranslation']);
        $this->individualRates->setProofread($this->data['proofread']);

        $this->assertEquals($this->data['languageIds'], $this->individualRates->getLanguageIds());
        $this->assertEquals($this->data['userIds'], $this->individualRates->getUserIds());
        $this->assertEquals($this->data['fullTranslation'], $this->individualRates->getFullTranslation());
        $this->assertEquals($this->data['proofread'], $this->individualRates->getProofread());
    }

    public function checkData(): void
    {
        $this->assertEquals($this->data['languageIds'], $this->individualRates->getLanguageIds());
        $this->assertEquals($this->data['userIds'], $this->individualRates->getUserIds());
        $this->assertEquals($this->data['fullTranslation'], $this->individualRates->getFullTranslation());
        $this->assertEquals($this->data['proofread'], $this->individualRates->getProofread());
    }

    public function languageIdsExceptionDataProvider(): array
    {
        return [
            'empty' => [
                'languageIds' => [],
                'exceptionMessage' => 'Argument "languageIds" cannot be empty',
            ],
            'invalidType' => [
                'languageIds' => [
                    [],
                ],
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

        (new IndividualRates())->setLanguageIds($languageIds);
    }

    public function userIdsExceptionDataProvider(): array
    {
        return [
            'empty' => [
                'userIds' => [],
                'exceptionMessage' => 'Argument "userIds" cannot be empty',
            ],
            'invalidType' => [
                'userIds' => [
                    [],
                ],
                'exceptionMessage' => 'Argument "userIds" must be an array of integers',
            ],
        ];
    }

    /**
     * @dataProvider userIdsExceptionDataProvider
     */
    public function testSetUserIdsException(array $userIds, string $exceptionMessage): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage($exceptionMessage);

        (new IndividualRates())->setUserIds($userIds);
    }

    public function testToArray(): void
    {
        $this->assertSame($this->data, (new IndividualRates($this->data))->toArray());
    }
}
