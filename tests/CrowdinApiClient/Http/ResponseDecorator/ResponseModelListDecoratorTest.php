<?php

namespace CrowdinApiClient\Tests\Http\ResponseDecorator;

use CrowdinApiClient\Http\ResponseDecorator\ResponseDecoratorInterface;
use CrowdinApiClient\Http\ResponseDecorator\ResponseModelListDecorator;
use CrowdinApiClient\Model\DownloadFile;
use CrowdinApiClient\ModelCollection;
use PHPUnit\Framework\TestCase;

class ResponseModelListDecoratorTest extends TestCase
{
    public function dataProvider(): array
    {
        return [
            'listWithPagination' => [
                'response' => [
                    'data' => [
                        [
                            'data' => [
                                'url' => 'https://foo.com',
                                'expireIn' => '2019-09-20T10:31:21+00:00',
                            ],
                        ],
                    ],
                    'pagination' => [
                        'offset' => 0,
                        'limit' => 25,
                    ],
                ],
                'modelName' => DownloadFile::class,
            ],
            'listWithoutPagination' => [
                'response' => [
                    'data' => [
                        [
                            'data' => [
                                'url' => 'https://foo.com',
                                'expireIn' => '2019-09-20T10:31:21+00:00',
                            ],
                        ],
                    ],
                ],
                'modelName' => DownloadFile::class,
            ],
        ];
    }

    /**
     * @dataProvider dataProvider
     */
    public function testDecorate(array $response, string $modelName)
    {
        $decorator = new ResponseModelListDecorator($modelName);

        $this->assertInstanceOf(ResponseDecoratorInterface::class, $decorator);

        $modelCollection = $decorator->decorate($response);

        $this->assertInstanceOf(ModelCollection::class, $modelCollection);
        $this->assertCount(1, $modelCollection);
        $this->assertInstanceOf($modelName, $modelCollection[0]);
        $this->assertEquals($response['data'][0]['data']['url'], $modelCollection[0]->getUrl());
    }
}
