<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model;


use CrowdinApiClient\Model\DistributionRelease;
use PHPUnit\Framework\TestCase;

class DistributionReleaseTest extends TestCase
{
    /**
     * @var array
     */
    public $data = [
        'status' => 'success',
        'progress' => 0,
        'currentLanguageId' => "en",
        'currentFileId' => 1,
        'date' => '2019-09-19T14:14:00+00:00',
    ];

    /**
     * @var DistributionRelease
     */
    public $distributionRelease;

    public function testLoadData()
    {
        $this->distributionRelease = new DistributionRelease($this->data);
        $this->checkData();
    }

    public function testSetData()
    {
        $this->distributionRelease = new DistributionRelease();
        $this->distributionRelease->setStatus($this->data['status']);
        $this->distributionRelease->setProgress($this->data['progress']);
        $this->distributionRelease->setCurrentLanguageId($this->data['currentLanguageId']);
        $this->distributionRelease->setCurrentFileId($this->data['currentFileId']);

        $this->assertEquals($this->data['status'], $this->distributionRelease->getStatus());
        $this->assertEquals($this->data['progress'], $this->distributionRelease->getProgress());
        $this->assertEquals($this->data['currentLanguageId'], $this->distributionRelease->getCurrentLanguageId());
        $this->assertEquals($this->data['currentFileId'], $this->distributionRelease->getCurrentFileId());
    }

    public function checkData()
    {
        $this->assertEquals($this->data['status'], $this->distributionRelease->getStatus());
        $this->assertEquals($this->data['progress'], $this->distributionRelease->getProgress());
        $this->assertEquals($this->data['currentLanguageId'], $this->distributionRelease->getCurrentLanguageId());
        $this->assertEquals($this->data['currentFileId'], $this->distributionRelease->getCurrentFileId());
        $this->assertEquals($this->data['date'], $this->distributionRelease->getDate());
    }

}
