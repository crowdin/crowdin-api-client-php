<?php

namespace Crowdin\Tests\Api;

use Crowdin\Model\Vendor;

class VendorApiTest extends AbstractTestApi
{
    public function testList()
    {
        $this->mockRequestTest([
           'uri' => 'https://organization_domain.crowdin.com/api/v2/vendors',
           'method' => 'get',
           'response' => '{
              "data": [
                {
                  "data": {
                    "id": 52760,
                    "name": "John Smith Translation Agency",
                    "description": "John Smith Translation Agency provides services for software and game localization as well as translation into 70+ languages.",
                    "status": "pending"
                  }
                }
              ],
              "pagination": [
                {
                  "offset": 0,
                  "limit": 0
                }
              ]
            }'
        ]);

        $vendors = $this->crowdin->vendor->list();
        $this->assertIsArray($vendors);
        $this->assertCount(1, $vendors);
        $this->assertInstanceOf(Vendor::class, $vendors[0]);
        $this->assertEquals(52760, $vendors[0]->getId());
    }
}
