<?php

namespace Crowdin\Tests\Api;

use Crowdin\Model\Vote;

class VoteApiTest extends AbstractTestApi
{
    public function testList()
    {
        $this->mockRequestTest([
           'uri' => 'https://organization_domain.crowdin.com/api/v2/projects/2/votes',
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
}
