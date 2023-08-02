<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\Distribution;
use PHPUnit\Framework\TestCase;

class DistributionTest extends TestCase
{
    /**
     * @var array
     */
    public $data = [
        'hash' => 'e-4326c06be14321dd967b161a',
        'exportMode' => 'bundle',
        'name' => 'Test Distribution',
        'fileIds' => [1, 2, 3],
        'bundleIds' => [1],
        'createdAt' => '2019-09-19T14:14:00+00:00',
        'updatedAt' => '2019-09-19T14:14:00+00:00',
    ];

    /**
     * @var Distribution
     */
    public $distribution;

    public function testLoadData()
    {
        $this->distribution = new Distribution($this->data);
        $this->checkData();
    }

    public function testSetData()
    {
        $this->distribution = new Distribution();
        $this->distribution->setHash($this->data['hash']);
        $this->distribution->setName($this->data['name']);
        $this->distribution->setFileIds($this->data['fileIds']);
        $this->distribution->setExportMode($this->data['exportMode']);
        $this->distribution->setBundleIds($this->data['bundleIds']);

        $this->assertEquals($this->data['hash'], $this->distribution->getHash());
        $this->assertEquals($this->data['name'], $this->distribution->getName());
        $this->assertEquals($this->data['fileIds'], $this->distribution->getFileIds());
        $this->assertEquals($this->data['exportMode'], $this->distribution->getExportMode());
        $this->assertEquals($this->data['bundleIds'], $this->distribution->getBundleIds());
    }

    public function checkData()
    {
        $this->assertEquals($this->data['hash'], $this->distribution->getHash());
        $this->assertEquals($this->data['name'], $this->distribution->getName());
        $this->assertEquals($this->data['fileIds'], $this->distribution->getFileIds());
        $this->assertEquals($this->data['exportMode'], $this->distribution->getExportMode());
        $this->assertEquals($this->data['bundleIds'], $this->distribution->getBundleIds());
        $this->assertEquals($this->data['createdAt'], $this->distribution->getCreatedAt());
        $this->assertEquals($this->data['updatedAt'], $this->distribution->getUpdatedAt());
    }
}
