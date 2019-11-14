<?php

namespace Crowdin\Tests\Api;

use Crowdin\Model\MachineTranslationEngine;

class MachineTranslationEngineApiTest extends AbstractTestApi
{
    public function testList()
    {
        $this->mockRequest([
            'path' => '/mts',
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

        $machineTranslationEngines = $this->crowdin->machineTranslationEngine->list(2);
        $this->assertIsArray($machineTranslationEngines);
        $this->assertCount(1, $machineTranslationEngines);
        $this->assertInstanceOf(MachineTranslationEngine::class, $machineTranslationEngines[0]);
    }
}
