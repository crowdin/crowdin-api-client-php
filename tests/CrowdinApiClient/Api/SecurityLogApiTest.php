<?php

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\SecurityLog;
use CrowdinApiClient\ModelCollection;

class SecurityLogApiTest extends AbstractTestApi
{
    public function testList()
    {
        $this->mockRequestGet('/users/4/security-logs', '{
          "data": [
            {
              "data": {
                "id": 2,
                "event": "Some event",
                "info": "Some info",
                "userId": 4,
                "location": "USA",
                "ipAddress": "127.0.0.1",
                "deviceName": "MacOs on MacBook",
                "createdAt": "2019-09-19T15:10:43+00:00"
              }
            }
          ],
          "pagination": {
            "offset": 0,
            "limit": 25
          }
        }');

        $securityLogs = $this->crowdin->securityLog->listUserSecurityLogs(4);
        $this->assertInstanceOf(ModelCollection::class, $securityLogs);
        $this->assertCount(1, $securityLogs);

        /** @var SecurityLog $securityLog */
        $securityLog = $securityLogs[0];
        $this->assertInstanceOf(SecurityLog::class, $securityLog);
        $this->assertEquals(2, $securityLog->getId());
        $this->assertEquals('Some event', $securityLog->getEvent());
        $this->assertEquals('Some info', $securityLog->getInfo());
        $this->assertEquals(4, $securityLog->getUserId());
        $this->assertEquals('USA', $securityLog->getLocation());
        $this->assertEquals('127.0.0.1', $securityLog->getIpAddress());
        $this->assertEquals('MacOs on MacBook', $securityLog->getDeviceName());
        $this->assertEquals('2019-09-19T15:10:43+00:00', $securityLog->getCreatedAt());
    }

    public function testGet()
    {
        $this->mockRequestGet('/users/4/security-logs/2', '{
          "data": {
            "id": 2,
            "event": "Some event",
            "info": "Some info",
            "userId": 4,
            "location": "USA",
            "ipAddress": "127.0.0.1",
            "deviceName": "MacOs on MacBook",
            "createdAt": "2019-09-19T15:10:43+00:00"
          }
        }');

        $securityLog = $this->crowdin->securityLog->getUserSecurityLog(4, 2);
        $this->assertInstanceOf(SecurityLog::class, $securityLog);
        $this->assertEquals(2, $securityLog->getId());
        $this->assertEquals('Some event', $securityLog->getEvent());
        $this->assertEquals('Some info', $securityLog->getInfo());
        $this->assertEquals(4, $securityLog->getUserId());
        $this->assertEquals('USA', $securityLog->getLocation());
        $this->assertEquals('127.0.0.1', $securityLog->getIpAddress());
        $this->assertEquals('MacOs on MacBook', $securityLog->getDeviceName());
        $this->assertEquals('2019-09-19T15:10:43+00:00', $securityLog->getCreatedAt());
    }
}
