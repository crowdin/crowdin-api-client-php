<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\Dictionary;
use CrowdinApiClient\ModelCollection;

class DictionaryApiTest extends AbstractTestApi
{
    public function testList(): void
    {
        $this->mockRequestGet(
            '/projects/2/dictionaries?languageIds=uk%2Cde',
            json_encode([
                'data' => [
                    [
                        'data' => [
                            'languageId' => 'uk',
                            'words' => ['Crowdin', 'localization'],
                        ],
                    ],
                ],
                'pagination' => [
                    'offset' => 0,
                    'limit' => 25,
                ],
            ])
        );

        $dictionaries = $this->crowdin->dictionary->list(2, ['languageIds' => 'uk,de']);

        $this->assertInstanceOf(ModelCollection::class, $dictionaries);
        $this->assertCount(1, $dictionaries);
        $this->assertInstanceOf(Dictionary::class, $dictionaries[0]);
        $this->assertEquals('uk', $dictionaries[0]->getLanguageId());
    }

    public function testUpdate(): void
    {
        $data = [
            ['op' => 'add', 'path' => '/words/0', 'value' => 'Crowdin'],
            ['op' => 'remove', 'path' => '/words/1'],
        ];

        $this->mockRequest([
            'path' => '/projects/2/dictionaries/uk',
            'method' => 'patch',
            'body' => json_encode($data),
            'response' => json_encode([
                'data' => [
                    'languageId' => 'uk',
                    'words' => ['Crowdin'],
                ],
            ]),
        ]);

        $dictionary = $this->crowdin->dictionary->update(2, 'uk', $data);

        $this->assertInstanceOf(Dictionary::class, $dictionary);
        $this->assertEquals(['Crowdin'], $dictionary->getWords());
    }
}
