<?php

namespace CrowdinApiClient\Tests\Api\Enterprise;

use CrowdinApiClient\Model\AiTranslation;

class AiApiTest extends AbstractTestApi
{
    public function testTranslateStrings(): void
    {
        $params = [
            'strings' => ['Some text to translate!'],
            'targetLanguageId' => 'uk',
        ];

        $this->mockRequest([
            'path' => '/ai/translate',
            'method' => 'post',
            'body' => json_encode($params),
            'response' => '{
              "data": {
                "sourceLanguageId": "en",
                "targetLanguageId": "uk",
                "translations": [
                  "Перекладений текст 1"
                ]
              }
            }',
        ]);

        $aiTranslation = $this->crowdin->ai->translateStrings($params);
        $this->assertInstanceOf(AiTranslation::class, $aiTranslation);
        $this->assertEquals('en', $aiTranslation->getSourceLanguageId());
        $this->assertEquals('uk', $aiTranslation->getTargetLanguageId());
        $this->assertEquals(['Перекладений текст 1'], $aiTranslation->getTranslations());
    }
}
