<?php

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\Vote;

class VoteApiTest extends AbstractTestApi
{
    public function testList()
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

        $votes = $this->crowdin->vote->list(2);
        $this->assertIsArray($votes);
        $this->assertCount(1, $votes);
        $this->assertInstanceOf(Vote::class, $votes[0]);
        $this->assertEquals(6643, $votes[0]->getId());
    }

    public function testCreate()
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

        $vote = $this->crowdin->vote->create(2, $params);
        $this->assertInstanceOf(Vote::class, $vote);
        $this->assertEquals(6643, $vote->getId());
    }

    public function testGet()
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
        $vote = $this->crowdin->vote->get(2, 6643);
        $this->assertInstanceOf(Vote::class, $vote);
        $this->assertEquals(6643, $vote->getId());
    }

    public function testDelete()
    {
        $this->mockRequestDelete('/projects/2/votes/6643');
        $this->crowdin->vote->delete(2, 6643);
    }
}
