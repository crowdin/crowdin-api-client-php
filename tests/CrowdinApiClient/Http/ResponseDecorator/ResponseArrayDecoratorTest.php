<?php

namespace CrowdinApiClient\Tests\Http\ResponseDecorator;

use CrowdinApiClient\Http\ResponseDecorator\ResponseArrayDecorator;
use CrowdinApiClient\Http\ResponseDecorator\ResponseDecoratorInterface;
use PHPUnit\Framework\TestCase;

class ResponseArrayDecoratorTest extends TestCase
{
    public function dataProvider(): array
    {
        return [
            'success' => [
                'response' => [
                    'data' => [
                        'url' => 'https://foo.com',
                        'expireIn' => '2019-09-20T10:31:21+00:00',
                    ],
                ],
                'expected' => [
                    'url' => 'https://foo.com',
                    'expireIn' => '2019-09-20T10:31:21+00:00',
                ],
            ],
            'validationError' => [
                'response' => [
                    'errors' => [
                        [
                            'error' => [
                                'key' => 'limit',
                                'errors' => [
                                    [
                                        'code' => 'intValInvalid',
                                        'message' => 'Invalid type given. Integer expected',
                                    ],

                                ],
                            ],
                        ],
                    ],
                ],
                'expected' => [
                    'errors' => [
                        [
                            'error' => [
                                'key' => 'limit',
                                'errors' => [
                                    [
                                        'code' => 'intValInvalid',
                                        'message' => 'Invalid type given. Integer expected',
                                    ],

                                ],
                            ],
                        ],
                    ],
                ],
            ],
            'unauthorizedError' => [
                'response' => [
                    'error' => [
                        'message' => 'Unauthorized',
                        'code' => 401,
                    ],
                ],
                'expected' => [
                    'error' => [
                        'message' => 'Unauthorized',
                        'code' => 401,
                    ],
                ],
            ],
        ];
    }

    /**
     * @dataProvider dataProvider
     */
    public function testDecorate(array $response, array $expected)
    {
        $decorator = new ResponseArrayDecorator();

        $this->assertInstanceOf(ResponseDecoratorInterface::class, $decorator);

        $array = $decorator->decorate($response);

        $this->assertIsArray($array);
        $this->assertEquals($expected, $array);
    }
}
