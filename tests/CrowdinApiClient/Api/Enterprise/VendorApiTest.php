<?php

namespace CrowdinApiClient\Tests\Api\Enterprise;

use CrowdinApiClient\Model\Vendor;
use CrowdinApiClient\ModelCollection;

class VendorApiTest extends AbstractTestApi
{
    public function testList()
    {
        $this->mockRequest([
           'path' => '/vendors',
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
        $this->assertInstanceOf(ModelCollection::class, $vendors);
        $this->assertCount(1, $vendors);
        $this->assertInstanceOf(Vendor::class, $vendors[0]);
        $this->assertEquals(52760, $vendors[0]->getId());
    }
}
