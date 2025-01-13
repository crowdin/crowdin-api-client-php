<?php

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\Screenshot;
use CrowdinApiClient\Model\Tag;
use CrowdinApiClient\ModelCollection;

class ScreenshotApiTest extends AbstractTestApi
{
    public function testList()
    {
        $this->mockRequest([
            'path' => '/projects/2/screenshots',
            'method' => 'get',
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
                    "createdAt": "2019-09-23T09:29:19+00:00",
                    "updatedAt": "2019-09-23T09:29:19+00:00",
                    "labelIds": [100, 200]
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

        $screenshots = $this->crowdin->screenshot->list(2);

        $this->assertInstanceOf(ModelCollection::class, $screenshots);
        $this->assertCount(1, $screenshots);
        $this->assertInstanceOf(Screenshot::class, $screenshots[0]);
        $this->assertEquals(2, $screenshots[0]->getId());
    }

    public function testCreate()
    {
        $params = [
            'storageId' => 71,
            'name' => 'translate_with_siri.jpg',
        ];

        $this->mockRequest([
            'path' => '/projects/2/screenshots',
            'method' => 'post',
            'body' => json_encode($params),
            'response' => '{
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
                    "createdAt": "2019-09-23T09:29:19+00:00",
                    "updatedAt": "2019-09-23T09:29:19+00:00",
                    "labelIds": [100, 200]
                  }
                }'
        ]);

        $screenshot = $this->crowdin->screenshot->create(2, $params);
        $this->assertInstanceOf(Screenshot::class, $screenshot);
        $this->assertEquals(2, $screenshot->getId());
    }

    public function testGetAndUpdate()
    {
        $this->mockRequestGet('/projects/2/screenshots/2', '{
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
                "createdAt": "2019-09-23T09:29:19+00:00",
                "updatedAt": "2019-09-23T09:29:19+00:00",
                "labelIds": [100, 200]
              }
            }');

        $screenshot = $this->crowdin->screenshot->get(2, 2);
        $this->assertInstanceOf(Screenshot::class, $screenshot);
        $this->assertEquals(2, $screenshot->getId());

        $this->mockRequestPatch('/projects/2/screenshots/2', '{
              "data": {
                "id": 2,
                "userId": 6,
                "url": "https://production-enterprise-screenshots.downloads.crowdin.com/992000002/6/2/middle.jpg?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAIGJKLQV66ZXPMMEA%2F20190923%2Fus-east-1%2Fs3%2Faws4_request&X-Amz-Date=20190923T093016Z&X-Amz-SignedHeaders=host&X-Amz-Expires=120&X-Amz-Signature=8df06f57594f7d1804b7c037629f6916224415e9b935c4f6619fbe002fb25e73",
                "name": "test_edit.jpg",
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
                "createdAt": "2019-09-23T09:29:19+00:00",
                "updatedAt": "2019-09-23T09:29:19+00:00",
                "labelIds": [100, 200]
              }
            }');

        $screenshot->setName('test_edit.jpg');

        $screenshot = $this->crowdin->screenshot->update(2, $screenshot);
        $this->assertInstanceOf(Screenshot::class, $screenshot);
        $this->assertEquals(2, $screenshot->getId());
        $this->assertEquals('test_edit.jpg', $screenshot->getName());
    }

    public function testReplace()
    {
        $params = [
            'storageId' => 0,
            'name' => 'string'
        ];

        $this->mockRequest([
            'path' => '/projects/2/screenshots/2',
            'method' => 'put',
            'body' => json_encode($params),
            'response' => '{
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
                "createdAt": "2019-09-23T09:29:19+00:00",
                "updatedAt": "2019-09-23T09:29:19+00:00",
                "labelIds": [100, 200]
              }
            }'
        ]);

        $screenshot = $this->crowdin->screenshot->replace(2, 2, 0, 'string');
        $this->assertInstanceOf(Screenshot::class, $screenshot);
        $this->assertEquals(2, $screenshot->getId());
    }

    public function testDelete()
    {
        $this->mockRequestDelete('/projects/2/screenshots/2');
        $this->crowdin->screenshot->delete(2, 2);
    }

    public function testCreateTag()
    {
        $params = [
            0 =>
                [
                    'stringId' => 0,
                    'position' =>
                        [
                            'x' => 0,
                            'y' => 0,
                            'width' => 0,
                            'height' => 0,
                        ],
                ],
        ];

        $this->mockRequest([
            'path' => '/projects/2/screenshots/2/tags',
            'method' => 'post',
            'body' => json_encode($params),
            'response' => '{
                  "data": {
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
                }'
        ]);

        $tag = $this->crowdin->screenshot->addTag(2, 2, $params);
        $this->assertInstanceOf(Tag::class, $tag);
        $this->assertEquals(98, $tag->getId());
    }

    public function testListTags()
    {
        $this->mockRequestGet('/projects/2/screenshots/2/tags', '{
              "data": [
                {
                  "data": {
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
                }
              ],
              "pagination": [
                {
                  "offset": 0,
                  "limit": 0
                }
              ]
        }');

        $tags = $this->crowdin->screenshot->tags(2, 2);

        $this->assertInstanceOf(ModelCollection::class, $tags);
        $this->assertCount(1, $tags);
        $this->assertInstanceOf(Tag::class, $tags[0]);
        $this->assertEquals(98, $tags[0]->getId());
    }

    public function testClearTag()
    {
        $this->mockRequestDelete('/projects/2/screenshots/2/tags');
        $this->crowdin->screenshot->clearTags(2, 2);
    }

    public function testGetAndUpdateTag()
    {
        $this->mockRequestGet('/projects/2/screenshots/2/tags/98', '{
              "data": {
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
            }');

        $tag = $this->crowdin->screenshot->getTag(2, 2, 98);
        $this->assertInstanceOf(Tag::class, $tag);
        $this->assertEquals(98, $tag->getId());

        $this->mockRequestPatch('/projects/2/screenshots/2/tags/98', '{
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
                        "stringId": 22,
                        "position": {
                          "x": 474,
                          "y": 147,
                          "width": 490,
                          "height": 99
                        },
                        "createdAt": "2019-09-23T09:35:31+00:00"
                      }
                    ],
                    "createdAt": "2019-09-23T09:29:19+00:00",
                    "updatedAt": "2019-09-23T09:29:19+00:00"
                  }
                }');

        $tag->setStringId(22);
        $screenshot = $this->crowdin->screenshot->updateTag(2, $tag);

        $this->assertInstanceOf(Screenshot::class, $screenshot);
        $this->assertEquals(22, $screenshot->getTags()[0]['stringId']);
    }

    public function testDeleteTag()
    {
        $this->mockRequestDelete('/projects/2/screenshots/2/tags/98');
        $this->crowdin->screenshot->deleteTag(2, 2, 98);
    }

    public function testReplaceTags()
    {
        $params = [
            0 =>
                [
                    'stringId' => 0,
                    'position' =>
                        [
                            'x' => 0,
                            'y' => 0,
                            'width' => 0,
                            'height' => 0,
                        ],
                ],
        ];

        $this->mockRequest([
            'path' => '/projects/2/screenshots/2/tags',
            'method' => 'put',
            'body' => json_encode($params)
        ]);

        $this->crowdin->screenshot->replaceTags(2, 2, $params);
    }
}
