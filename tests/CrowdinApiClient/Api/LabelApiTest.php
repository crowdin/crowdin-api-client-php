<?php

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\Label;
use CrowdinApiClient\Model\Screenshot;
use CrowdinApiClient\ModelCollection;

class LabelApiTest extends AbstractTestApi
{
    public function testList()
    {
        $this->mockRequest([
            'path' => '/projects/2/labels',
            'method' => 'get',
            'response' => '{
              "data": [
                {
                  "data": {
                    "id": 4,
                    "projectId": 2,
                    "title": "main"
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

        $labels = $this->crowdin->label->list(2);

        $this->assertInstanceOf(ModelCollection::class, $labels);
        $this->assertCount(1, $labels);
        $this->assertInstanceOf(Label::class, $labels[0]);
        $this->assertEquals(4, $labels[0]->getId());
    }

    public function testGetAndUpdate()
    {
        $this->mockRequestGet('/projects/2/labels/34', '{
                  "data": {
                    "id": 34,
                    "projectId": 2,
                    "title": "develop-master"
                  }
            }');

        $label = $this->crowdin->label->get(2, 34);

        $this->assertInstanceOf(Label::class, $label);
        $this->assertEquals(34, $label->getId());

        $label->setTitle('edit-test');

        $this->mockRequestPath('/projects/2/labels/34', '{
                  "data": {
                    "id": 34,
                    "projectId": 2,
                    "name": "edit-test"
                  }
            }');

        $this->crowdin->label->update($label);
        $this->assertInstanceOf(Label::class, $label);
        $this->assertEquals(34, $label->getId());
        $this->assertEquals('edit-test', $label->getTitle());
    }

    public function testCreate()
    {
        $params = [
            'title' => 'develop-master',
        ];

        $this->mockRequest([
            'path' => '/projects/2/labels',
            'method' => 'post',
            'body' => json_encode($params),
            'response' => '{
                  "data": {
                    "id": 34,
                    "projectId": 2,
                    "title": "develop-master"
                  }
                }'
        ]);

        $label = $this->crowdin->label->create(2, $params);
        $this->assertInstanceOf(Label::class, $label);
        $this->assertEquals(34, $label->getId());
    }

    public function testDelete()
    {
        $this->mockRequestDelete('/projects/2/labels/34');
        $this->crowdin->label->delete(2, 34);
    }

    public function testAssignScreenshots()
    {
        $params = [
            'screenshotIds' => ['2'],
        ];

        $this->mockRequest([
            'path' => '/projects/2/labels/34/screenshots',
            'method' => 'post',
            'body' => json_encode($params),
            'response' => '{
                    "data": [
                        {
                            "data": {
                                "id": 2,
                                "userId": 6,
                                "url": "https://production-enterprise-screenshots.downloads.crowdin.com/992000002/6/2/middle.jpg?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAIGJKLQV66ZXPMMEA%2F20190923%2Fus-east-1%2Fs3%2Faws4_request&X-Amz-Date=20190923T093016Z&X-Amz-SignedHeaders=host&X-Amz-Expires=120&X-Amz-Signature=8df06f57594f7d1804b7c037629f6916224415e9b935c4f6619fbe002fb25e73",
                                "name": "translate_with_siri.jpg",
                                "size": {
                                    "width": 267,
                                    "height": 176
                                },
                                "tagsCount": 0,
                                "tags": [
                                    {
                                        "id": 98,
                                        "screenshotId": 2,
                                        "stringId": 2822,
                                        "position": {
                                            "x": 474,
                                            "y": 147,
                                            "width": 490,
                                            "height": 99
                                        },
                                        "createdAt": "2019-09-23T09:35:31+00:00"
                                    }
                                ],
                                "labels": [
                                    1
                                ],
                                "createdAt": "2019-09-23T09:29:19+00:00",
                                "updatedAt": "2019-09-23T09:29:19+00:00"
                            }
                        }
                    ],
                    "pagination": {
                        "offset": 0,
                        "limit": 25
                    }
                }'
        ]);

        $screenshots = $this->crowdin->label->assignScreenshots(2, 34, $params);
        $this->assertInstanceOf(ModelCollection::class, $screenshots);
        $this->assertCount(1, $screenshots);
        $this->assertInstanceOf(Screenshot::class, $screenshots[0]);
        $this->assertEquals(2, $screenshots[0]->getId());
    }

    public function testUnassignScreenshots()
    {
        $params = [
            'screenshotIds' => ['2'],
        ];

        $this->mockRequest([
            'path' => '/projects/2/labels/34/screenshots',
            'method' => 'delete',
            'body' => json_encode($params),
            'response' => '{
                  "data": [
                    {
                      "data": {
                        "id": 2,
                        "userId": 6,
                        "url": "https://production-enterprise-screenshots.downloads.crowdin.com/992000002/6/2/middle.jpg?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAIGJKLQV66ZXPMMEA%2F20190923%2Fus-east-1%2Fs3%2Faws4_request&X-Amz-Date=20190923T093016Z&X-Amz-SignedHeaders=host&X-Amz-Expires=120&X-Amz-Signature=8df06f57594f7d1804b7c037629f6916224415e9b935c4f6619fbe002fb25e73",
                        "name": "translate_with_siri.jpg",
                        "size": {
                          "width": 267,
                          "height": 176
                        },
                        "tagsCount": 0,
                        "tags": [
                          {
                            "id": 98,
                            "screenshotId": 2,
                            "stringId": 2822,
                            "position": {
                              "x": 474,
                              "y": 147,
                              "width": 490,
                              "height": 99
                            },
                            "createdAt": "2019-09-23T09:35:31+00:00"
                          }
                        ],
                        "labels": [
                          1
                        ],
                        "createdAt": "2019-09-23T09:29:19+00:00",
                        "updatedAt": "2019-09-23T09:29:19+00:00"
                      }
                    }
                  ],
                  "pagination": {
                    "offset": 0,
                    "limit": 25
                  }
                }'
        ]);

        $screenshots = $this->crowdin->label->unassignScreenshots(2, 34, $params);
        $this->assertInstanceOf(ModelCollection::class, $screenshots);
        $this->assertCount(1, $screenshots);
        $this->assertInstanceOf(Screenshot::class, $screenshots[0]);
        $this->assertEquals(2, $screenshots[0]->getId());
    }
}
