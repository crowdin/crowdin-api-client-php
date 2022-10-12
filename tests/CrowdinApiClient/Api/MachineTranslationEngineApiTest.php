<?php

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\MachineTranslationEngine;
use CrowdinApiClient\ModelCollection;

class MachineTranslationEngineApiTest extends AbstractTestApi
{
    public function testList()
    {
        $this->mockRequest([
            'path' => '/mts?groupId=2',
            'method' => 'get',
            'response' => '{
              "data": [
                {
                  "data": {
                    "id": 2,
                    "groupId": 2,
                    "name": "Crowdin Translate (beta)",
                    "type": "crowdin",
                    "credentials": {
                      "crowdin_nmt": 1,
                      "crowdin_nmt_multi_translations": 1
                    },
                    "projectIds": [
                      1
                    ]
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

        $machineTranslationEngines = $this->crowdin->machineTranslationEngine->list(['groupId' => 2]);

        $this->assertInstanceOf(ModelCollection::class, $machineTranslationEngines);
        $this->assertCount(1, $machineTranslationEngines);
        $this->assertInstanceOf(MachineTranslationEngine::class, $machineTranslationEngines[0]);
    }

    public function testGet()
    {
        $this->mockRequestGet('/mts/2', '{
              "data": {
                "id": 2,
                "groupId": 2,
                "name": "Crowdin Translate (beta)",
                "type": "crowdin",
                "credentials": {
                  "crowdin_nmt": 1,
                  "crowdin_nmt_multi_translations": 1
                },
                "projectIds": [
                  1
                ]
              }
            }');

        $machineTranslationEngine = $this->crowdin->machineTranslationEngine->get(2);
        $this->assertInstanceOf(MachineTranslationEngine::class, $machineTranslationEngine);
        $this->assertEquals(2, $machineTranslationEngine->getId());
    }
}
