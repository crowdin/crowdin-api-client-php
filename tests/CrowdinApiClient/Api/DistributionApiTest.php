<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\Distribution;
use CrowdinApiClient\Model\DistributionRelease;
use CrowdinApiClient\ModelCollection;

class DistributionApiTest extends AbstractTestApi
{
    public function testList(): void
    {
        $this->mockRequest([
            'path' => '/projects/2/distributions',
            'method' => 'get',
            'response' => json_encode([
                'data' => [
                    [
                        'data' => [
                            'hash' => 'e-4326c06be14321dd967b161a',
                            'exportMode' => 'bundle',
                            'name' => 'Test Distribution',
                            'fileIds' => [1],
                            'bundleIds' => [1],
                            'createdAt' => '2019-09-23T09:04:29+00:00',
                            'updatedAt' => '2019-09-23T09:04:29+00:00',
                        ],
                    ],
                ],
                'pagination' => [
                    [
                        'offset' => 0,
                        'limit' => 0,
                    ],
                ],
            ]),
        ]);

        $distributions = $this->crowdin->distribution->list(2);

        $this->assertInstanceOf(ModelCollection::class, $distributions);
        $this->assertCount(1, $distributions);
        $this->assertInstanceOf(Distribution::class, $distributions[0]);
        $this->assertEquals('e-4326c06be14321dd967b161a', $distributions[0]->getHash());
    }

    public function testCreate(): void
    {
        $params = [
            'name' => 'Test Distribution',
            'fileIds' => [0],
        ];

        $this->mockRequest([
            'path' => '/projects/2/distributions',
            'method' => 'post',
            'body' => json_encode($params),
            'response' => json_encode([
                'data' => [
                    'hash' => 'e-4326c06be14321dd967b161a',
                    'name' => 'Test Distribution',
                    'exportMode' => 'bundle',
                    'fileIds' => [1],
                    'bundleIds' => [1],
                    'createdAt' => '2019-09-23T09:04:29+00:00',
                    'updatedAt' => '2019-09-23T09:04:29+00:00',
                ],
            ]),
        ]);

        $distribution = $this->crowdin->distribution->create(2, $params);

        $this->assertInstanceOf(Distribution::class, $distribution);
        $this->assertEquals('Test Distribution', $distribution->getName());
        $this->assertEquals("e-4326c06be14321dd967b161a", $distribution->getHash());
    }

    public function testGetAndUpdate(): void
    {
        $this->mockRequestGet(
            '/projects/2/distributions/e-4326c06be14321dd967b161a',
            json_encode([
                'data' => [
                    'hash' => 'e-4326c06be14321dd967b161a',
                    'name' => 'Test Distribution',
                    'exportMode' => 'bundle',
                    'fileIds' => [1],
                    'bundleIds' => [1],
                    'createdAt' => '2019-09-23T09:04:29+00:00',
                    'updatedAt' => '2019-09-23T09:04:29+00:00',
                ],
            ])
        );

        $distribution = $this->crowdin->distribution->get(2, 'e-4326c06be14321dd967b161a');

        $this->assertInstanceOf(Distribution::class, $distribution);
        $this->assertEquals('e-4326c06be14321dd967b161a', $distribution->getHash());

        $this->mockRequestPatch(
            '/projects/2/distributions/e-4326c06be14321dd967b161a',
            json_encode([
                'data' => [
                    'hash' => 'e-4326c06be14321dd967b161a',
                    'name' => 'test edit',
                    'exportMode' => 'bundle',
                    'fileIds' => [1],
                    'bundleIds' => [1],
                    'createdAt' => '2019-09-23T09:04:29+00:00',
                    'updatedAt' => '2019-09-23T09:04:29+00:00',
                ],
            ])
        );

        $distribution->setName('test edit');
        $distribution = $this->crowdin->distribution->update(2, $distribution);

        $this->assertInstanceOf(Distribution::class, $distribution);
        $this->assertEquals('e-4326c06be14321dd967b161a', $distribution->getHash());
        $this->assertEquals('test edit', $distribution->getName());
    }

    public function testDelete(): void
    {
        $this->mockRequestDelete('/projects/2/distributions/e-4326c06be14321dd967b161a');
        $this->crowdin->distribution->delete(2, 'e-4326c06be14321dd967b161a');
    }

    public function testRelease(): void
    {
        $this->mockRequest([
            'path' => '/projects/2/distributions/e-4326c06be14321dd967b161a/release',
            'method' => 'post',
            'response' => json_encode([
                'data' => [
                    'status' => 'success',
                    'progress' => 0,
                    'currentLanguageId' => 1,
                    'currentFileId' => 1,
                    'date' => '2019-09-23T09:04:29+00:00',
                ],
            ]),
        ]);

        $distributionRelease = $this->crowdin->distribution->release(2, 'e-4326c06be14321dd967b161a');

        $this->assertInstanceOf(DistributionRelease::class, $distributionRelease);
        $this->assertEquals('success', $distributionRelease->getStatus());
        $this->assertEquals(1, $distributionRelease->getCurrentFileId());
    }

    public function testGetRelease(): void
    {
        $this->mockRequestGet(
            '/projects/2/distributions/e-4326c06be14321dd967b161a/release',
            json_encode([
                'data' => [
                    'status' => 'success',
                    'progress' => 0,
                    'currentLanguageId' => 1,
                    'currentFileId' => 1,
                    'date' => '2019-09-23T09:04:29+00:00',
                ],
            ])
        );

        $distributionRelease = $this->crowdin->distribution->getRelease(2, 'e-4326c06be14321dd967b161a');

        $this->assertInstanceOf(DistributionRelease::class, $distributionRelease);
        $this->assertEquals('success', $distributionRelease->getStatus());
        $this->assertEquals(1, $distributionRelease->getCurrentLanguageId());
    }
}
