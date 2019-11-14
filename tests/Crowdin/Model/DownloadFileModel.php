<?php

namespace Crowdin\Tests\Model;

use Crowdin\Model\DownloadFile;
use PHPUnit\Framework\TestCase;

/**
 * Class DownloadFileModel
 * @package Crowdin\Tests\Model
 */
class DownloadFileModel extends TestCase
{
    /**
     * @var array
     */
    public $data = [
        'url' => 'https://production-enterprise-importer.downloads.crowdin.com/992000002/2/14.xliff?response-content-disposition=attachment%3B%20filename%3D%22APP.xliff%22&X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAIGJKLQV66ZXPMMEA%2F20190920%2Fus-east-1%2Fs3%2Faws4_request&X-Amz-Date=20190920T093121Z&X-Amz-SignedHeaders=host&X-Amz-Expires=3600&X-Amz-Signature=439ebd69a1b7e4c23e6d17891a491c94f832e0c82e4692dedb35a6cd1e624b62',
        'expireIn' => '2019-09-20T10:31:21+00:00',
    ];

    /**
     * @var DownloadFile
     */
    public $downloadFile;

    public function setUp()
    {
        parent::setUp();
        $this->downloadFile = new DownloadFile($this->data);
    }

    /**
     * @test
     */
    public function testLoadData()
    {
        $this->assertEquals($this->data['url'], $this->downloadFile->getUrl());
        $this->assertEquals($this->data['expireIn'], $this->downloadFile->getExpireIn());
    }
}