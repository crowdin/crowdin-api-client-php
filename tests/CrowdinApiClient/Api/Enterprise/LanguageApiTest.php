<?php

namespace CrowdinApiClient\Tests\Api\Enterprise;

use CrowdinApiClient\Model\Language;
use CrowdinApiClient\ModelCollection;

class LanguageApiTest extends AbstractTestApi
{
    public function testList()
    {
        $this->mockRequest([
            'uri' => 'https://organization_domain.crowdin.com/api/v2/languages',
            'method' => 'get',
            'response' => '{
                  "data": [
                    {
                      "data": {
                        "id": "es",
                        "name": "Spanish",
                        "editorCode": "es",
                        "twoLettersCode": "es",
                        "threeLettersCode": "spa",
                        "locale": "es-ES",
                        "androidCode": "es-rES",
                        "osxCode": "es.lproj",
                        "osxLocale": "es",
                        "pluralCategoryNames": [
                          "one"
                        ],
                        "pluralRules": "(n != 1)",
                        "pluralExamples": [
                          "0, 2-999; 1.2, 2.07..."
                        ],
                        "textDirection": "ltr",
                        "dialectOf": "string"
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

        $languages = $this->crowdin->language->list();
        $this->assertInstanceOf(ModelCollection::class, $languages);
        $this->assertCount(1, $languages);
        $this->assertInstanceOf(Language::class, $languages[0]);
    }

    public function testCreate()
    {
        $this->mockRequest([
            'uri' => 'https://organization_domain.crowdin.com/api/v2/languages',
            'method' => 'post',
            'response' => '{
              "data": {
                "id": "es",
                "name": "Spanish",
                "editorCode": "es",
                "twoLettersCode": "es",
                "threeLettersCode": "spa",
                "locale": "es-ES",
                "androidCode": "es-rES",
                "osxCode": "es.lproj",
                "osxLocale": "es",
                "pluralCategoryNames": [
                  "one"
                ],
                "pluralRules": "(n != 1)",
                "pluralExamples": [
                  "0, 2-999; 1.2, 2.07..."
                ],
                "textDirection": "ltr",
                "dialectOf": "string"
              }
            }'
        ]);

        $language = $this->crowdin->language->create([
            'name' => 'CustomLanguage',
            'code' => 'es-2',
            'localeCode' => 'es',
            'twoLettersCode' => 'aa',
            'threeLettersCode' => 'spa',
            'textDirection' => 'ltr',
            'pluralCategoryNames' => ['one', 'other'],
        ]);

        $this->assertInstanceOf(Language::class, $language);
        $this->assertEquals('es', $language->getId());
    }

    public function testGetUpdate()
    {
        $this->mockRequestGet('/languages/es', '{
              "data": {
                "id": "es",
                "name": "Spanish",
                "editorCode": "es",
                "twoLettersCode": "es",
                "threeLettersCode": "spa",
                "locale": "es-ES",
                "androidCode": "es-rES",
                "osxCode": "es.lproj",
                "osxLocale": "es",
                "pluralCategoryNames": [
                  "one"
                ],
                "pluralRules": "(n != 1)",
                "pluralExamples": [
                  "0, 2-999; 1.2, 2.07..."
                ],
                "textDirection": "ltr",
                "dialectOf": "string"
              }
        }');

        $language = $this->crowdin->language->get('es');

        $this->assertInstanceOf(Language::class, $language);
        $this->assertEquals('es', $language->getId());

        $language->setName('edit test');

        $this->mockRequestPath('/languages/es', '{
              "data": {
                "id": "es",
                "name": "Spanish",
                "editorCode": "es",
                "twoLettersCode": "es",
                "threeLettersCode": "spa",
                "locale": "es-ES",
                "androidCode": "es-rES",
                "osxCode": "es.lproj",
                "osxLocale": "es",
                "pluralCategoryNames": [
                  "one"
                ],
                "pluralRules": "(n != 1)",
                "pluralExamples": [
                  "0, 2-999; 1.2, 2.07..."
                ],
                "textDirection": "ltr",
                "dialectOf": "string"
              }
        }');

        $this->crowdin->language->update($language);

        $this->assertInstanceOf(Language::class, $language);
        $this->assertEquals('es', $language->getId());
        $this->assertEquals('edit test', $language->getName());
    }

    public function testDelete()
    {
        $this->mockRequestDelete('/languages/es');
        $this->crowdin->language->delete('es');
    }
}
