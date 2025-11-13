<?php

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\StringComment;
use CrowdinApiClient\ModelCollection;

class StringCommentApiTest extends AbstractTestApi
{
    public function testList()
    {
        $this->mockRequest([
            'path' => '/projects/1/comments',
            'method' => 'get',
            'response' => '{
              "data": [
                {
                  "data": {
                    "id": 2,
                    "text": "@BeMyEyes  Please provide more details on where the text will be used",
                    "userId": 6,
                    "stringId": 742,
                    "user": {
                      "id": 12,
                      "username": "john_smith",
                      "fullName": "John Smith",
                      "avatarUrl": ""
                    },
                    "string": {
                      "id": 123,
                      "text": "HTML page example",
                      "type": "text",
                      "hasPlurals": false,
                      "isIcu": false,
                      "context": "Document Title\\r\\nXPath: /html/head/title",
                      "fileId": 22
                    },
                    "languageId": "bg",
                    "type": "issue",
                    "issueType": "source_mistake",
                    "issueStatus": "unresolved",
                    "resolverId": 6,
                    "resolver": {
                      "id": 12,
                      "username": "john_smith",
                      "fullName": "John Smith",
                      "avatarUrl": ""
                    },
                    "resolvedAt": "2019-09-20T11:05:24+00:00",
                    "createdAt": "2019-09-20T11:05:24+00:00"
                  }
                }
              ],
              "pagination": {
                "offset": 0,
                "limit": 25
              }
            }'
        ]);

        $comments = $this->crowdin->stringComment->list(1);

        $this->assertInstanceOf(ModelCollection::class, $comments);
        $this->assertCount(1, $comments);
        $this->assertInstanceOf(StringComment::class, $comments[0]);
        $this->assertEquals(2, $comments[0]->getId());
    }

    public function testCreate()
    {
        $params = [
            'text' => '@BeMyEyes  Please provide more details on where the text will be used',
            'stringId' => 742,
            'targetLanguageId' => 'en',
            'type' => 'comment'
        ];

        $this->mockRequest([
            'path' => '/projects/1/comments',
            'method' => 'post',
            'body' => json_encode($params),
            'response' => '{
              "data": {
                "id": 2,
                "text": "@BeMyEyes  Please provide more details on where the text will be used",
                "userId": 6,
                "stringId": 742,
                "user": {
                  "id": 12,
                  "username": "john_smith",
                  "fullName": "John Smith",
                  "avatarUrl": ""
                },
                "string": {
                  "id": 123,
                  "text": "HTML page example",
                  "type": "text",
                  "hasPlurals": false,
                  "isIcu": false,
                  "context": "Document Title\\r\\nXPath: /html/head/title",
                  "fileId": 22
                },
                "languageId": "en",
                "type": "comment",
                "issueType": null,
                "issueStatus": null,
                "resolverId": null,
                "resolver": {},
                "resolvedAt": null,
                "createdAt": "2019-09-20T11:05:24+00:00"
              }
            }'
        ]);

        $stringComment = $this->crowdin->stringComment->create(1, $params);
        $this->assertInstanceOf(StringComment::class, $stringComment);
        $this->assertEquals(2, $stringComment->getId());
        $this->assertEquals('en', $stringComment->getLanguageId());
        $this->assertEquals('comment', $stringComment->getType());
        $this->assertEquals(null, $stringComment->getIssueType());
        $this->assertEquals(null, $stringComment->getIssueStatus());
        $this->assertEquals(null, $stringComment->getResolverId());
        $this->assertEquals([], $stringComment->getResolver());
    }

    public function testGetAndUpdate()
    {
        $this->mockRequestGet('/projects/8/comments/2', '{
              "data": {
                "id": 2,
                "text": "@BeMyEyes  Please provide more details on where the text will be used",
                "userId": 6,
                "stringId": 742,
                "user": {
                  "id": 12,
                  "username": "john_smith",
                  "fullName": "John Smith",
                  "avatarUrl": ""
                },
                "string": {
                  "id": 123,
                  "text": "HTML page example",
                  "type": "text",
                  "hasPlurals": false,
                  "isIcu": false,
                  "context": "Document Title\\r\\nXPath: /html/head/title",
                  "fileId": 22
                },
                "languageId": "bg",
                "type": "issue",
                "issueType": "source_mistake",
                "issueStatus": "unresolved",
                "resolverId": 6,
                "resolver": {
                  "id": 12,
                  "username": "john_smith",
                  "fullName": "John Smith",
                  "avatarUrl": ""
                },
                "resolvedAt": "2019-09-20T11:05:24+00:00",
                "createdAt": "2019-09-20T11:05:24+00:00"
              }
            }'
        );

        $stringComment = $this->crowdin->stringComment->get(8, 2);

        $this->assertInstanceOf(StringComment::class, $stringComment);
        $this->assertEquals(2, $stringComment->getId());

        $stringComment->setText('edit test');
        $this->mockRequestPatch('/projects/8/comments/2', '{
              "data": {
                "id": 2,
                "text": "edit test",
                "userId": 6,
                "stringId": 742,
                "user": {
                  "id": 12,
                  "username": "john_smith",
                  "fullName": "John Smith",
                  "avatarUrl": ""
                },
                "string": {
                  "id": 123,
                  "text": "HTML page example",
                  "type": "text",
                  "hasPlurals": false,
                  "isIcu": false,
                  "context": "Document Title\\r\\nXPath: /html/head/title",
                  "fileId": 22
                },
                "languageId": "bg",
                "type": "issue",
                "issueType": "source_mistake",
                "issueStatus": "unresolved",
                "resolverId": 6,
                "resolver": {
                  "id": 12,
                  "username": "john_smith",
                  "fullName": "John Smith",
                  "avatarUrl": ""
                },
                "resolvedAt": "2019-09-20T11:05:24+00:00",
                "createdAt": "2019-09-20T11:05:24+00:00"
              }
            }');

        $stringComment = $this->crowdin->stringComment->update(8, $stringComment);

        $this->assertInstanceOf(StringComment::class, $stringComment);
        $this->assertEquals(2, $stringComment->getId());
        $this->assertEquals('edit test', $stringComment->getText());
    }

    public function testDelete()
    {
        $this->mockRequestDelete('/projects/1/comments/1');
        $this->crowdin->stringComment->delete(1, 1);
    }

    public function testBatchOperations()
    {
        $this->mockRequest([
            'path' => '/projects/1/comments',
            'method' => 'patch',
            'response' => '{
              "data": [
                {
                  "data": {
                    "id": 2,
                    "text": "Updated comment text",
                    "userId": 6,
                    "stringId": 742,
                    "user": {
                      "id": 12,
                      "username": "john_smith",
                      "fullName": "John Smith",
                      "avatarUrl": ""
                    },
                    "string": {
                      "id": 123,
                      "text": "HTML page example",
                      "type": "text",
                      "hasPlurals": false,
                      "isIcu": false,
                      "context": "Document Title\\r\\nXPath: /html/head/title",
                      "fileId": 22
                    },
                    "languageId": "bg",
                    "type": "issue",
                    "issueType": "source_mistake",
                    "issueStatus": "resolved",
                    "resolverId": 6,
                    "resolver": {
                      "id": 12,
                      "username": "john_smith",
                      "fullName": "John Smith",
                      "avatarUrl": ""
                    },
                    "resolvedAt": "2019-09-20T11:05:24+00:00",
                    "createdAt": "2019-09-20T11:05:24+00:00"
                  }
                }
              ]
            }'
        ]);

        $batchResult = $this->crowdin->stringComment->batchOperations(1, [
            [
                'op' => 'replace',
                'path' => '/2/text',
                'value' => 'Updated comment text'
            ],
            [
                'op' => 'replace',
                'path' => '/2/issueStatus',
                'value' => 'resolved'
            ]
        ]);

        $this->assertInstanceOf(StringComment::class, $batchResult);
    }
}
