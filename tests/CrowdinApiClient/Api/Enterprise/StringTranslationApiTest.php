<?php

namespace CrowdinApiClient\Tests\Api\Enterprise;

use CrowdinApiClient\Model\StringTranslation;
use CrowdinApiClient\Model\StringTranslationApproval;
use CrowdinApiClient\Model\Vote;
use CrowdinApiClient\ModelCollection;

class StringTranslationApiTest extends AbstractTestApi
{
    public function testList()
    {
        $this->mockRequest([
            'path' => '/projects/2/translations',
            'method' => 'get',
            'response' => '{
              "data": [
                {
                  "data": {
                    "id": 190695,
                    "text": "Цю стрічку перекладено",
                    "pluralCategoryName": "few",
                    "user": {
                      "id": 19,
                      "login": "john_doe"
                    },
                    "rating": 10
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

        $stringTranslations = $this->crowdin->stringTranslation->list(2);
        $this->assertInstanceOf(ModelCollection::class, $stringTranslations);
        $this->assertCount(1, $stringTranslations);
        $this->assertInstanceOf(StringTranslation::class, $stringTranslations[0]);
        $this->assertEquals(190695, $stringTranslations[0]->getId());
    }

    public function testGet()
    {
        $this->mockRequestGet('/projects/2/translations/190695', '{
              "data": {
                "id": 190695,
                "text": "Цю стрічку перекладено",
                "pluralCategoryName": "few",
                "user": {
                  "id": 19,
                  "login": "john_doe"
                },
                "rating": 10
              }
            }');

        $stringTranslation = $this->crowdin->stringTranslation->get(2, 190695);
        $this->assertInstanceOf(StringTranslation::class, $stringTranslation);
        $this->assertEquals(190695, $stringTranslation->getId());
    }

    public function testDelete()
    {
        $this->mockRequestDelete('/projects/2/translations/190695');
        $this->crowdin->stringTranslation->delete(2, 190695);
    }

    public function create()
    {
        $params = [
            'stringId' => 35434,
            'languageId' => 'uk',
            'text' => 'Цю стрічку перекладено',
            'pluralCategoryName' => 'few',
        ];

        $this->mockRequest([
            'path' => '',
            'method' => 'post',
            'body' => $params,
            'response' => '{
              "data": {
                "id": 190695,
                "text": "Цю стрічку перекладено",
                "pluralCategoryName": "few",
                "user": {
                  "id": 19,
                  "login": "john_doe"
                },
                "rating": 10
              }
            }'
        ]);

        $stringTranslation = $this->crowdin->stringTranslation->create(2, $params);
        $this->assertInstanceOf(StringTranslation::class, $stringTranslation);
        $this->assertEquals(190695, $stringTranslation->getId());
    }

    public function testRestore()
    {
        $this->mockRequest([
           'path' => '/projects/2/translations/190695',
           'method' => 'put',
           'response' => '{
                  "data": {
                    "id": 190695,
                    "text": "Цю стрічку перекладено",
                    "pluralCategoryName": "few",
                    "user": {
                      "id": 19,
                      "login": "john_doe"
                    },
                    "rating": 10
                  }
                }'
        ]);

        $stringTranslation = $this->crowdin->stringTranslation->restore(2, 190695);
        $this->assertInstanceOf(StringTranslation::class, $stringTranslation);
        $this->assertEquals(190695, $stringTranslation->getId());
    }

    public function testCreate()
    {
        $params = [
            'stringId' => 35434,
            'languageId' => 'uk',
            'text' => 'Цю стрічку перекладено',
            'pluralCategoryName' => 'few',
        ];

        $this->mockRequest([
            'path' => '/projects/2/translations',
            'method' => 'post',
            'body' => $params,
            'response' => '{
                  "data": {
                    "id": 190695,
                    "text": "Цю стрічку перекладено",
                    "pluralCategoryName": "few",
                    "user": {
                      "id": 19,
                      "login": "john_doe"
                    },
                    "rating": 10
                  }
                }',
        ]);

        $stringTranslation = $this->crowdin->stringTranslation->create(2, $params);
        $this->assertInstanceOf(StringTranslation::class, $stringTranslation);
        $this->assertEquals(190695, $stringTranslation->getId());
    }

    public function testListApproval()
    {
        $this->mockRequest([
            'path' => '/projects/2/approvals',
            'method' => 'get',
            'response' => '{
                  "data": [
                    {
                      "data": {
                        "id": 190695,
                        "user": {
                          "id": 19,
                          "login": "john_doe"
                        },
                        "translationId": 190695,
                        "stringId": 2345,
                        "languageId": "uk",
                        "workflowStepId": 122,
                        "createdAt": "2019-09-19T12:42:12+00:00"
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

        $stringTranslationApprovals = $this->crowdin->stringTranslation->listApprovals(2);

        $this->assertInstanceOf(ModelCollection::class, $stringTranslationApprovals);
        $this->assertCount(1, $stringTranslationApprovals);
        $this->assertInstanceOf(StringTranslationApproval::class, $stringTranslationApprovals[0]);
        $this->assertEquals(190695, $stringTranslationApprovals[0]->getId());
    }

    public function testCreateApproval()
    {
        $params = ['translationId' => 200];

        $this->mockRequest([
            'path' => '/projects/2/approvals',
            'body' => $params,
            'method' => 'post',
            'response' => '{
                  "data": {
                    "id": 190695,
                    "user": {
                      "id": 19,
                      "login": "john_doe"
                    },
                    "translationId": 190695,
                    "stringId": 2345,
                    "languageId": "uk",
                    "workflowStepId": 122,
                    "createdAt": "2019-09-19T12:42:12+00:00"
                  }
                }'
        ]);

        $approval = $this->crowdin->stringTranslation->createApproval(2, $params);
        $this->assertInstanceOf(StringTranslationApproval::class, $approval);
        $this->assertEquals(190695, $approval->getId());
    }

    public function testGetApproval()
    {
        $this->mockRequestGet('/projects/2/approvals/190695', '{
              "data": {
                "id": 190695,
                "user": {
                  "id": 19,
                  "login": "john_doe"
                },
                "translationId": 190695,
                "stringId": 2345,
                "languageId": "uk",
                "workflowStepId": 122,
                "createdAt": "2019-09-19T12:42:12+00:00"
              }
        }');

        $stringTranslationApproval = $this->crowdin->stringTranslation->getApproval(2, 190695);
        $this->assertInstanceOf(StringTranslationApproval::class, $stringTranslationApproval);
        $this->assertEquals(190695, $stringTranslationApproval->getId());
    }

    public function testDeleteApproval()
    {
        $this->mockRequestDelete('/projects/2/approvals/190695');
        $this->crowdin->stringTranslation->deleteApproval(2, 190695);
    }

    public function testListVote()
    {
        $this->mockRequest([
            'path' => '/projects/2/votes',
            'method' => 'get',
            'response' => '{
                  "data": [
                    {
                      "data": {
                        "id": 6643,
                        "user": {
                          "id": 19,
                          "login": "john_doe"
                        },
                        "translationId": 19069345,
                        "votedAt": "2019-09-19T12:42:12+00:00",
                        "mark": "up"
                      }
                    }
                  ],
                  "pagination": [
                    {
                      "offset": 0,
                      "limit": 0
                    }
                  ]
                }',
        ]);

        $votes = $this->crowdin->stringTranslation->listVotes(2);
        $this->assertInstanceOf(ModelCollection::class, $votes);
        $this->assertCount(1, $votes);
        $this->assertInstanceOf(Vote::class, $votes[0]);
        $this->assertEquals(6643, $votes[0]->getId());
    }

    public function testCreateVote()
    {
        $params = [
            'mark' => 'up',
            'translationId' => 653412
        ];

        $this->mockRequest([
            'path' => '/projects/2/votes',
            'method' => 'post',
            'body' => $params,
            'response' => '{
              "data": {
                "id": 6643,
                "user": {
                  "id": 19,
                  "login": "john_doe"
                },
                "translationId": 19069345,
                "votedAt": "2019-09-19T12:42:12+00:00",
                "mark": "up"
              }
            }'
        ]);

        $vote = $this->crowdin->stringTranslation->createVote(2, $params);
        $this->assertInstanceOf(Vote::class, $vote);
        $this->assertEquals(6643, $vote->getId());
    }

    public function testGetAndUpdateVote()
    {
        $this->mockRequestGet('/projects/2/votes/6643', '{
          "data": {
            "id": 6643,
            "user": {
              "id": 19,
              "login": "john_doe"
            },
            "translationId": 19069345,
            "votedAt": "2019-09-19T12:42:12+00:00",
            "mark": "up"
          }
        }');
        $vote = $this->crowdin->stringTranslation->getVote(2, 6643);
        $this->assertInstanceOf(Vote::class, $vote);
        $this->assertEquals(6643, $vote->getId());
    }

    public function testDeleteVote()
    {
        $this->mockRequestDelete('/projects/2/votes/6643');
        $this->crowdin->stringTranslation->deleteVote(2, 6643);
    }
}
