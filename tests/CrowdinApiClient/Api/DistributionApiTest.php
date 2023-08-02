<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\Distribution;
use CrowdinApiClient\Model\DistributionRelease;
use CrowdinApiClient\ModelCollection;

class DistributionApiTest extends AbstractTestApi
{
    public function testList()
    {
        $this->mockRequest([
            'path' => '/projects/2/distributions',
            'method' => 'get',
            'response' => '{
                  "data": [
                    {
                      "data": {
                        "hash": "e-4326c06be14321dd967b161a",
                        "exportMode": "bundle",
                        "name": "Test Distribution",
                        "fileIds": [
                          1
                        ],
                        "bundleIds": [
                          1
                        ],
                        "createdAt": "2019-09-23T09:04:29+00:00",
                        "updatedAt": "2019-09-23T09:04:29+00:00"
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

        $distributions = $this->crowdin->distribution->list(2);
        $this->assertInstanceOf(ModelCollection::class, $distributions);
        $this->assertCount(1, $distributions);
        $this->assertInstanceOf(Distribution::class, $distributions[0]);
        $this->assertEquals('e-4326c06be14321dd967b161a', $distributions[0]->getHash());
    }

    public function testCreate()
    {
        $params = [
            'name' => 'Test Distribution',
            'fileIds' =>
                [
                    0 => 0,
                ],
        ];

        $this->mockRequest([
            'path' => '/projects/2/distributions',
            'method' => 'post',
            'body' => $params,
            'response' => '{
              "data": {
                "hash": "e-4326c06be14321dd967b161a",
                "name": "Test Distribution",
                "exportMode": "bundle",
                "fileIds": [
                  1
                ],
                "bundleIds": [
                  1
                ],
                "createdAt": "2019-09-23T09:04:29+00:00",
                "updatedAt": "2019-09-23T09:04:29+00:00"
              }
            }'

        ]);

        $distribution = $this->crowdin->distribution->create(2, $params);
        $this->assertInstanceOf(Distribution::class, $distribution);
        $this->assertEquals('Test Distribution', $distribution->getName());
        $this->assertEquals("e-4326c06be14321dd967b161a", $distribution->getHash());
    }

    public function testGetAndUpdate()
    {
        $this->mockRequestGet('/projects/2/distributions/e-4326c06be14321dd967b161a', '{
              "data": {
                "hash": "e-4326c06be14321dd967b161a",
                "name": "Test Distribution",
                "exportMode": "bundle",
                "fileIds": [
                  1
                ],
                "bundleIds": [
                  1
                ],
                "createdAt": "2019-09-23T09:04:29+00:00",
                "updatedAt": "2019-09-23T09:04:29+00:00"
              }
          }');

        $distribution = $this->crowdin->distribution->get(2, 'e-4326c06be14321dd967b161a');
        $this->assertInstanceOf(Distribution::class, $distribution);
        $this->assertEquals('e-4326c06be14321dd967b161a', $distribution->getHash());

        $this->mockRequestPath('/projects/2/distributions/e-4326c06be14321dd967b161a', '{
              "data": {
                "hash": "e-4326c06be14321dd967b161a",
                "name": "test edit",
                "exportMode": "bundle",
                "fileIds": [
                  1
                ],
                "bundleIds": [
                  1
                ],
                "createdAt": "2019-09-23T09:04:29+00:00",
                "updatedAt": "2019-09-23T09:04:29+00:00"
              }
        }');

        $distribution->setName('test edit');
        $distribution = $this->crowdin->distribution->update(2, $distribution);
        $this->assertInstanceOf(Distribution::class, $distribution);
        $this->assertEquals('e-4326c06be14321dd967b161a', $distribution->getHash());
        $this->assertEquals('test edit', $distribution->getName());
    }

    public function testDelete()
    {
        $this->mockRequestDelete('/projects/2/distributions/e-4326c06be14321dd967b161a');
        $this->crowdin->distribution->delete(2, 'e-4326c06be14321dd967b161a');
    }

    public function testRelease()
    {
        $this->mockRequest([
            'path' => '/projects/2/distributions/e-4326c06be14321dd967b161a/release',
            'method' => 'post',
            'response' => '{
              "data": {
                "status": "success",
                "progress": 0,
                "currentLanguageId": 1,
                "currentFileId": 1,
                "date": "2019-09-23T09:04:29+00:00"
              }
            }'

        ]);

        $distributionRelease = $this->crowdin->distribution->release(2, 'e-4326c06be14321dd967b161a');
        $this->assertInstanceOf(DistributionRelease::class, $distributionRelease);
        $this->assertEquals('success', $distributionRelease->getStatus());
        $this->assertEquals(1, $distributionRelease->getCurrentFileId());
    }

    public function testGetRelease()
    {
        $this->mockRequestGet('/projects/2/distributions/e-4326c06be14321dd967b161a/release', '{
             "data": {
                "status": "success",
                "progress": 0,
                "currentLanguageId": 1,
                "currentFileId": 1,
                "date": "2019-09-23T09:04:29+00:00"
              }
          }');

        $distributionRelease = $this->crowdin->distribution->getRelease(2, 'e-4326c06be14321dd967b161a');
        $this->assertInstanceOf(DistributionRelease::class, $distributionRelease);
        $this->assertEquals('success', $distributionRelease->getStatus());
        $this->assertEquals(1, $distributionRelease->getCurrentLanguageId());
    }
}
