<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\Issue;
use CrowdinApiClient\ModelCollection;

class IssueApiTest extends AbstractTestApi
{
    /**
     * @test
     */
    public function testListReportedIssues()
    {
        $this->mockRequestGet('/projects/1/issues', '{
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
                        "type": "source_mistake",
                        "status": "unresolved",
                        "createdAt": "2019-09-20T11:05:24+00:00"
                    }
                }
            ],
            "pagination": {
                "offset": 0,
                "limit": 25
            }
        }');

        $issues = $this->crowdin->issue->listReportedIssues(1);

        $this->assertInstanceOf(ModelCollection::class, $issues);
        $this->assertCount(1, $issues);
        $this->assertInstanceOf(Issue::class, $issues[0]);
        $this->assertEquals(2, $issues[0]->getId());
    }

    public function testGetAndUpdate()
    {
        $this->mockRequestGet('/projects/1/issues', '{
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
                            "context": "Document Title",
                            "fileId": 22
                        },
                        "languageId": "bg",
                        "type": "source_mistake",
                        "status": "unresolved",
                        "createdAt": "2019-09-20T11:05:24+00:00"
                    }
                }
            ],
            "pagination": {
                "offset": 0,
                "limit": 25
            }
        }');

        $issues = $this->crowdin->issue->listReportedIssues(1);

        /** @var Issue $issue */
        $issue = $issues[0];
        $this->assertInstanceOf(Issue::class, $issue);
        $this->assertEquals(2, $issue->getId());

        $this->mockRequestPatch('/projects/1/issues/2', '{
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
                    "context": "Document Title",
                    "fileId": 22
                },
                "languageId": "bg",
                "type": "source_mistake",
                "status": "resolved",
                "createdAt": "2019-09-20T11:05:24+00:00"
            }
        }');

        $issue->setStatus('resolved');
        $issue = $this->crowdin->issue->update(1, $issue);
        $this->assertInstanceOf(Issue::class, $issue);
        $this->assertEquals(2, $issue->getId());
        $this->assertEquals('resolved', $issue->getStatus());
        $this->assertEquals('source_mistake', $issue->getType());
    }
}
