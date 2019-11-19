<?php

namespace CrowdinApiClient\Tests\Http;

use CrowdinApiClient\Http\ResponseDecorator\ResponseArrayDecorator;
use CrowdinApiClient\Http\ResponseDecorator\ResponseDecoratorInterface;
use CrowdinApiClient\Http\ResponseDecorator\ResponseModelDecorator;
use CrowdinApiClient\Http\ResponseDecorator\ResponseModelListDecorator;
use CrowdinApiClient\Model\DownloadFile;
use PHPUnit\Framework\TestCase;

/**
 * Class ResponseDecoratorTest
 * @package CrowdinApiClient\Tests\Http
 */
class ResponseDecoratorTest extends TestCase
{
    /**
     * @var array
     */
    public $dataItem = [
        'url' => 'https://foo.com',
        'expireIn' => '2019-09-20T10:31:21+00:00'
    ];

    public function testModelDecorator()
    {
        $modelDecorate = new ResponseModelDecorator(DownloadFile::class);

        $this->assertInstanceOf(ResponseDecoratorInterface::class, $modelDecorate);

        $downloadFile = $modelDecorate->decorate($this->dataItem);

        $this->assertInstanceOf(DownloadFile::class, $downloadFile);
        $this->assertEquals($this->dataItem['url'], $downloadFile->getUrl());
    }

    public function testModelListDecorator()
    {
        $modelDecorate = new ResponseModelListDecorator(DownloadFile::class);

        $this->assertInstanceOf(ResponseModelListDecorator::class, $modelDecorate);

        $downloadFiles = $modelDecorate->decorate([['data' => $this->dataItem]]);

        $this->assertIsArray($downloadFiles);
        $this->assertCount(1, $downloadFiles);
        $this->assertInstanceOf(DownloadFile::class, $downloadFiles[0]);
        $this->assertEquals($this->dataItem['url'], $downloadFiles[0]->getUrl());
    }

    public function testArrayDecorator()
    {
        $arrayDecorate = new ResponseArrayDecorator();

        $this->assertInstanceOf(ResponseArrayDecorator::class, $arrayDecorate);

        $dataArray = $arrayDecorate->decorate([$this->dataItem]);

        $this->assertIsArray($dataArray);
        $this->assertCount(1, $dataArray);
        $this->assertContains($this->dataItem, $dataArray);
    }
}
