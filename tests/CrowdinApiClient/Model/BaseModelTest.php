<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\BaseModel;
use PHPUnit\Framework\TestCase;

class BaseModelTest extends TestCase
{
    public static function nullableHelperProvider(): array
    {
        return [
            'bool: missing' => ['nullableBool', [], null],
            'bool: null' => ['nullableBool', ['value' => null], null],
            'bool: false is kept' => ['nullableBool', ['value' => false], false],
            'bool: cast' => ['nullableBool', ['value' => 1], true],

            'int: missing' => ['nullableInt', [], null],
            'int: null' => ['nullableInt', ['value' => null], null],
            'int: zero is kept' => ['nullableInt', ['value' => 0], 0],
            'int: cast' => ['nullableInt', ['value' => '5'], 5],

            'float: missing' => ['nullableFloat', [], null],
            'float: null' => ['nullableFloat', ['value' => null], null],
            'float: zero is kept' => ['nullableFloat', ['value' => 0.0], 0.0],
            'float: cast' => ['nullableFloat', ['value' => 2], 2.0],

            'string: missing' => ['nullableString', [], null],
            'string: null' => ['nullableString', ['value' => null], null],
            'string: empty is kept' => ['nullableString', ['value' => ''], ''],
            'string: "0" is kept' => ['nullableString', ['value' => '0'], '0'],
            'string: cast' => ['nullableString', ['value' => 5], '5'],

            'array: missing' => ['nullableArray', [], null],
            'array: null' => ['nullableArray', ['value' => null], null],
            'array: empty is kept' => ['nullableArray', ['value' => []], []],
            'array: cast' => ['nullableArray', ['value' => 'en'], ['en']],
        ];
    }

    /**
     * @dataProvider nullableHelperProvider
     */
    public function testNullableHelpers(string $helper, array $data, $expected): void
    {
        $model = new class($data) extends BaseModel {
            public function call(string $helper)
            {
                return $this->{$helper}('value');
            }
        };

        $this->assertSame($expected, $model->call($helper));
    }
}
