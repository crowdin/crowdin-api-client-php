<?php

namespace CrowdinApiClient\Tests\Http\ResponseDecorator;

use CrowdinApiClient\Http\ResponseDecorator\ResponseDecoratorInterface;
use CrowdinApiClient\Http\ResponseDecorator\ResponseModelDecorator;
use CrowdinApiClient\Model\DownloadFile;
use PHPUnit\Framework\TestCase;

class ResponseModelDecoratorTest extends TestCase
{
    public function testDecorate()
    {
        $response = [
            'data' => [
                'url' => 'https://foo.com',
                'expireIn' => '2019-09-20T10:31:21+00:00',
            ],
        ];
        $decorator = new ResponseModelDecorator(DownloadFile::class);

        $this->assertInstanceOf(ResponseDecoratorInterface::class, $decorator);

        $model = $decorator->decorate($response);

        $this->assertInstanceOf(DownloadFile::class, $model);
        $this->assertEquals($response['data']['url'], $model->getUrl());
    }
}
