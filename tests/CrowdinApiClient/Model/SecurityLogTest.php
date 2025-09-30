<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\SecurityLog;
use PHPUnit\Framework\TestCase;

class SecurityLogTest extends TestCase
{
    /**
     * @var SecurityLog
     */
    public $securityLog;

    public $data = [
        'id' => 2,
        'event' => 'Some event',
        'info' => 'Some info',
        'userId' => 4,
        'location' => 'USA',
        'ipAddress' => '127.0.0.1',
        'deviceName' => 'MacOs on MacBook',
        'createdAt' => '2019-09-19T15:10:43+00:00',
    ];

    public function testLoadData()
    {
        $this->securityLog = new SecurityLog($this->data);
        $this->checkData();
    }

    public function checkData()
    {
        $this->assertEquals($this->data['id'], $this->securityLog->getId());
        $this->assertEquals($this->data['event'], $this->securityLog->getEvent());
        $this->assertEquals($this->data['info'], $this->securityLog->getInfo());
        $this->assertEquals($this->data['userId'], $this->securityLog->getUserId());
        $this->assertEquals($this->data['location'], $this->securityLog->getLocation());
        $this->assertEquals($this->data['ipAddress'], $this->securityLog->getIpAddress());
        $this->assertEquals($this->data['deviceName'], $this->securityLog->getDeviceName());
        $this->assertEquals($this->data['createdAt'], $this->securityLog->getCreatedAt());
    }
}
