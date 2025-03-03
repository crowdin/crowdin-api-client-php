<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\NetRate;
use CrowdinApiClient\Model\NetRateSchemes;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class NetRateSchemesTest extends TestCase
{
    public $data = [
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
    ];

    /**
     * @var NetRateSchemes
     */
    public $netRateSchemes;

    public function testLoadData(): void
    {
        $this->netRateSchemes = new NetRateSchemes($this->data);
        $this->checkData();
    }

    /**
     * @depends testLoadData
     */
    public function testSetData(): void
    {
        $this->netRateSchemes = new NetRateSchemes();
        $this->netRateSchemes->setTmMatch(
            array_map(static function (array $rate): NetRate {
                return new NetRate($rate);
            }, $this->data['tmMatch'])
        );
        $this->netRateSchemes->setMtMatch(
            array_map(static function (array $rate): NetRate {
                return new NetRate($rate);
            }, $this->data['mtMatch'])
        );
        $this->netRateSchemes->setAiMatch(
            array_map(static function (array $rate): NetRate {
                return new NetRate($rate);
            }, $this->data['aiMatch'])
        );
        $this->netRateSchemes->setSuggestionMatch(
            array_map(static function (array $rate): NetRate {
                return new NetRate($rate);
            }, $this->data['suggestionMatch'])
        );

        $this->assertEquals(
            $this->data['tmMatch'],
            array_map(static function (NetRate $rate): array {
                return $rate->toArray();
            }, $this->netRateSchemes->getTmMatch())
        );
        $this->assertEquals(
            $this->data['mtMatch'],
            array_map(static function (NetRate $rate): array {
                return $rate->toArray();
            }, $this->netRateSchemes->getMtMatch())
        );
        $this->assertEquals(
            $this->data['aiMatch'],
            array_map(static function (NetRate $rate): array {
                return $rate->toArray();
            }, $this->netRateSchemes->getAiMatch())
        );
        $this->assertEquals(
            $this->data['suggestionMatch'],
            array_map(static function (NetRate $rate): array {
                return $rate->toArray();
            }, $this->netRateSchemes->getSuggestionMatch())
        );
    }

    public function checkData(): void
    {
        $this->assertEquals(
            $this->data['tmMatch'],
            array_map(static function (NetRate $rate): array {
                return $rate->toArray();
            }, $this->netRateSchemes->getTmMatch())
        );
        $this->assertEquals(
            $this->data['mtMatch'],
            array_map(static function (NetRate $rate): array {
                return $rate->toArray();
            }, $this->netRateSchemes->getMtMatch())
        );
        $this->assertEquals(
            $this->data['aiMatch'],
            array_map(static function (NetRate $rate): array {
                return $rate->toArray();
            }, $this->netRateSchemes->getAiMatch())
        );
        $this->assertEquals(
            $this->data['suggestionMatch'],
            array_map(static function (NetRate $rate): array {
                return $rate->toArray();
            }, $this->netRateSchemes->getSuggestionMatch())
        );
    }

    public function tmMatchExceptionDataProvider(): array
    {
        return [
            'empty' => [
                'tmMatch' => [],
                'exceptionMessage' => 'Argument "tmMatch" cannot be empty',
            ],
            'invalidType' => [
                'tmMatch' => [
                    [],
                ],
                'exceptionMessage' => 'Argument "tmMatch" must contain only NetRate objects',
            ],
        ];
    }

    /**
     * @dataProvider tmMatchExceptionDataProvider
     */
    public function testSetTmMatchException(array $tmMatch, string $exceptionMessage): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage($exceptionMessage);

        (new NetRateSchemes())->setTmMatch($tmMatch);
    }

    public function mtMatchExceptionDataProvider(): array
    {
        return [
            'empty' => [
                'mtMatch' => [],
                'exceptionMessage' => 'Argument "mtMatch" cannot be empty',
            ],
            'invalidType' => [
                'mtMatch' => [
                    [],
                ],
                'exceptionMessage' => 'Argument "mtMatch" must contain only NetRate objects',
            ],
        ];
    }

    /**
     * @dataProvider mtMatchExceptionDataProvider
     */
    public function testSetMtMatchException(array $mtMatch, string $exceptionMessage): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage($exceptionMessage);

        (new NetRateSchemes())->setMtMatch($mtMatch);
    }

    public function aiMatchExceptionDataProvider(): array
    {
        return [
            'empty' => [
                'aiMatch' => [],
                'exceptionMessage' => 'Argument "aiMatch" cannot be empty',
            ],
            'invalidType' => [
                'aiMatch' => [
                    [],
                ],
                'exceptionMessage' => 'Argument "aiMatch" must contain only NetRate objects',
            ],
        ];
    }

    /**
     * @dataProvider aiMatchExceptionDataProvider
     */
    public function testSetAiMatchException(array $aiMatch, string $exceptionMessage): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage($exceptionMessage);

        (new NetRateSchemes())->setAiMatch($aiMatch);
    }

    public function suggestionMatchExceptionDataProvider(): array
    {
        return [
            'empty' => [
                'suggestionMatch' => [],
                'exceptionMessage' => 'Argument "suggestionMatch" cannot be empty',
            ],
            'invalidType' => [
                'suggestionMatch' => [
                    [],
                ],
                'exceptionMessage' => 'Argument "suggestionMatch" must contain only NetRate objects',
            ],
        ];
    }

    /**
     * @dataProvider suggestionMatchExceptionDataProvider
     */
    public function testSetSuggestionMatchException(array $suggestionMatch, string $exceptionMessage): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage($exceptionMessage);

        (new NetRateSchemes())->setSuggestionMatch($suggestionMatch);
    }

    public function testToArray(): void
    {
        $this->assertSame($this->data, (new NetRateSchemes($this->data))->toArray());
    }
}
