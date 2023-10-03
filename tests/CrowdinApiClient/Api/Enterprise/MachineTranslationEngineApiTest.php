<?php

namespace CrowdinApiClient\Tests\Api\Enterprise;

use CrowdinApiClient\Model\MachineTranslationEngine;

class MachineTranslationEngineApiTest extends AbstractTestApi
{
    public function testCreate()
    {
        $params = [
            'name' => 'string',
            'type' => 'google',
            'credentials' =>
                [
                    0 =>
                        [
                            'apiKey' => 'string',
                        ],
                ],
            'groupId' => 0,
        ];

        $this->mockRequest([
            'path' => '/mts',
            'method' => 'post',
            'body' => json_encode($params),
            'response' => '{
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
            }'
        ]);

        $machineTranslationEngine = $this->crowdin->machineTranslationEngine->create($params);
        $this->assertInstanceOf(MachineTranslationEngine::class, $machineTranslationEngine);
        $this->assertEquals(2, $machineTranslationEngine->getId());
    }

    public function testGetAndUpdate()
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

        $machineTranslationEngine->setName('test edit');

        $this->mockRequestPath('/mts/2', '{
              "data": {
                "id": 2,
                "groupId": 2,
                "name": "test edit",
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

        $machineTranslationEngine = $this->crowdin->machineTranslationEngine->update($machineTranslationEngine);
        $this->assertInstanceOf(MachineTranslationEngine::class, $machineTranslationEngine);
        $this->assertEquals(2, $machineTranslationEngine->getId());
        $this->assertEquals('test edit', $machineTranslationEngine->getName());
    }

    public function testDelete()
    {
        $this->mockRequestDelete('/mts/2');
        $this->crowdin->machineTranslationEngine->delete(2);
    }
}
