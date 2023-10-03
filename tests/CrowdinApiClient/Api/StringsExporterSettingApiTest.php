<?php

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\StringsExporterSetting;
use CrowdinApiClient\ModelCollection;

class StringsExporterSettingApiTest extends AbstractTestApi
{
    public function testList()
    {
        $this->mockRequest([
          'path' => '/projects/2/strings-exporter-settings',
          'method' => 'get',
          'response' => '{
              "data": [
                {
                  "data": {
                    "id": 2,
                    "format": "android",
                    "settings": {
                      "convertPlaceholders": false
                    },
                    "createdAt": "2019-09-19T15:10:43+00:00",
                    "updatedAt": "2019-09-19T15:10:46+00:00"
                  }
                }
              ],
              "pagination": {
                "offset": 0,
                "limit": 25
              }
            }'
        ]);

        $data = $this->crowdin->stringsExporterSetting->list(2);

        $this->assertInstanceOf(ModelCollection::class, $data);
        $this->assertCount(1, $data);
        /**
         * @var StringsExporterSetting $stringsExporterSetting
         */
        $stringsExporterSetting = $data[0];
        $this->assertInstanceOf(StringsExporterSetting::class, $stringsExporterSetting);

        $this->assertEquals(2, $stringsExporterSetting->getId());
        $this->assertEquals('android', $stringsExporterSetting->getFormat());
    }

    public function testGet()
    {
        $this->mockRequestGet(
            '/projects/2/strings-exporter-settings/2',
            '{
          "data": {
            "id": 2,
            "format": "android",
            "settings": {
              "convertPlaceholders": false
            },
            "createdAt": "2019-09-19T15:10:43+00:00",
            "updatedAt": "2019-09-19T15:10:46+00:00"
          }
        }'
        );

        $stringsExporterSetting = $this->crowdin->stringsExporterSetting->get(2, 2);

        $this->assertInstanceOf(StringsExporterSetting::class, $stringsExporterSetting);

        $this->assertEquals(2, $stringsExporterSetting->getId());
        $this->assertEquals('android', $stringsExporterSetting->getFormat());
    }

    public function testCreate()
    {
        $params = [
          'format' => 'android',
          "settings" => [
            "convertPlaceholders" => false
          ]
        ];

        $this->mockRequest([
          'path' => '/projects/2/strings-exporter-settings',
          'method' => 'post',
          'body' => $params,
          'response' => '{
              "data": {
                "id": 2,
                "format": "android",
                "settings": {
                  "convertPlaceholders": false
                },
                "createdAt": "2019-09-19T15:10:43+00:00",
                "updatedAt": "2019-09-19T15:10:46+00:00"
              }
            }'
        ]);

        $stringsExporterSetting = $this->crowdin->stringsExporterSetting->create(2, $params);

        $this->assertInstanceOf(StringsExporterSetting::class, $stringsExporterSetting);
        $this->assertEquals(2, $stringsExporterSetting->getId());
        $this->assertEquals('android', $stringsExporterSetting->getFormat());
    }

    public function testDelete()
    {
        $this->mockRequest([
          'path' => '/projects/2/strings-exporter-settings/2',
          'method' => 'delete',
        ]);

        $this->crowdin->stringsExporterSetting->delete(2, 2);
    }

    public function testGetAndUpdate()
    {
        $this->mockRequestGet('/projects/2/strings-exporter-settings/2', '{
      "data": {
        "id": 2,
        "format": "android",
        "settings": {
          "convertPlaceholders": false
        },
        "createdAt": "2019-09-19T15:10:43+00:00",
        "updatedAt": "2019-09-19T15:10:46+00:00"
      }
    }');

        $stringsExporterSetting = $this->crowdin->stringsExporterSetting->get(2, 2);

        $this->assertInstanceOf(StringsExporterSetting::class, $stringsExporterSetting);
        $this->assertEquals(2, $stringsExporterSetting->getId());
        $this->assertEquals('android', $stringsExporterSetting->getFormat());

        $stringsExporterSetting->setFormat('macosx');

        $this->mockRequestPath('/projects/2/strings-exporter-settings/2', '{
      "data": {
        "id": 2,
        "format": "macosx",
        "settings": {
          "convertPlaceholders": false
        },
        "createdAt": "2019-09-19T15:10:43+00:00",
        "updatedAt": "2019-09-19T15:10:46+00:00"
      }
    }');

        $stringsExporterSetting = $this->crowdin->stringsExporterSetting->update(2, $stringsExporterSetting);
        $this->assertInstanceOf(StringsExporterSetting::class, $stringsExporterSetting);
        $this->assertEquals(2, $stringsExporterSetting->getId());
        $this->assertEquals('macosx', $stringsExporterSetting->getFormat());
    }
}
